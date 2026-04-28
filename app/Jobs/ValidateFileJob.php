<?php

namespace App\Jobs;

use App\Src\Infrastructure\ImportFile\Persistence\Models\ImportFileModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;
use OpenSpout\Reader\XLSX\Reader;

class ValidateFileJob implements ShouldQueue
{
    use Queueable;

    public $timeout = 7200;

    public $tries = 1;

    /**
     * Create a new job instance.
     */
    public function __construct(private string $importFileId) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $importFile = ImportFileModel::find($this->importFileId);
        $importFile->update(['status' => 'processing']);

        // Descarga el stream directo desde S3 (sin cargar en RAM)
        $stream = Storage::disk('private')->readStream($importFile->storagePath);

        $ext = pathinfo($importFile->fileName, PATHINFO_EXTENSION);

        match ($ext) {
            'csv', 'txt' => $this->processCsv($stream, $importFile),
            'xlsx' => $this->processXlsx($importFile),
        };

        $importFile->update(['status' => 'validated']);
    }

    private function processCsv($stream, ImportFileModel $importFile)
    {
        $headers = fgetcsv($stream);

        $columnAssignments = ColumnAssignment::where('import_file_id', $importFile->id)->get();

        // $requiredCols = $importFile->required_columns; // configurable

        // $valid = $errors = $duplicates = 0;
        // $seenHashes = [];  // En producción: reemplazar por Redis Set
        // $batch = [];

        // while (($row = fgetcsv($stream)) !== false) {
        //     $mapped = array_combine($headers, $row);

        //     // Validar campos requeridos vacíos
        //     foreach ($requiredCols as $col) {
        //         if (empty(trim($mapped[$col] ?? ''))) {
        //             $errors++;
        //             continue 2;
        //         }
        //     }

        //     // Detectar duplicados
        //     $hash = md5(implode('|', $mapped));
        //     if (isset($seenHashes[$hash])) {
        //         $duplicates++;
        //         continue;
        //     }
        //     $seenHashes[$hash] = true;
        //     $valid++;

        //     // Batch insert cada 1000 filas
        //     $batch[] = $mapped;
        //     if (count($batch) >= 1000) {
        //         DB::table('import_rows')->insert($batch);
        //         $batch = [];

        //         // Guarda progreso en DB (para el polling del frontend)
        //         $importFile->update(['rows_processed' => $valid + $errors + $duplicates]);
        //     }
        // }

        // if (!empty($batch)) DB::table('import_rows')->insert($batch);

        // $importFile->update([
        //     'valid_rows'      => $valid,
        //     'error_rows'      => $errors,
        //     'duplicated_rows' => $duplicates,
        // ]);
    }

    private function processXlsx(ImportFile $importFile)
    {
        // OpenSpout lee en streaming, no carga todo en RAM
        // composer require openspout/openspout
        $tmpPath = tempnam(sys_get_temp_dir(), 'xlsx_');
        file_put_contents($tmpPath, Storage::disk('private')->get($importFile->storagePath));

        $reader = Reader::createFromFile($tmpPath);
        $reader->open($tmpPath);

        foreach ($reader->getSheetIterator() as $sheet) {
            foreach ($sheet->getRowIterator() as $row) {
                // igual que el CSV...
            }
            break; // solo primera hoja
        }

        $reader->close();
        unlink($tmpPath);
    }
}
