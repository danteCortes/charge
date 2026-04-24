<?php

namespace App\Src\Infrastructure\ImportFile\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Src\Application\ImportFile\DTOs\ImportFileDTO;
use App\Src\Application\ImportFile\UseCases\DeleteImportFileUseCase;
use App\Src\Application\ImportFile\UseCases\GenerateFilePreviewUseCase;
use App\Src\Application\ImportFile\UseCases\GetColumnAssignmentByImportFileUseCase;
use App\Src\Application\ImportFile\UseCases\StoreImportFilesUseCase;
use App\Src\Application\ImportFile\UseCases\UpdateImportFileUseCase;
use App\Src\Infrastructure\ImportFile\Http\Requests\StoreImportFileRequest;
use App\Src\Infrastructure\ImportFile\Http\Requests\UpdateImportFileRequest;
use App\Src\Infrastructure\ImportFile\Persistence\Models\ImportFileModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportFileController extends Controller
{
    public function __construct(
        private StoreImportFilesUseCase $storeImportFilesUseCase,
        private UpdateImportFileUseCase $updateImportFilesUseCase,
        private GenerateFilePreviewUseCase $generateFilePreviewUseCase,
        private DeleteImportFileUseCase $deleteImportFileUseCase,
        private GetColumnAssignmentByImportFileUseCase $getColumnAssignmentByImportFileUseCase,
    ) {}

    public function store(StoreImportFileRequest $request): JsonResponse
    {
        $response = [];
        foreach ($request->file('files') as $file) {
            $path = $file->store('imports');

            $dto = ImportFileDTO::create(
                $file->getClientOriginalname(),
                strtoupper($file->getClientOriginalExtension()),
                $file->getSize(),
                $path,
                null,
                null,
                null,
                null,
                $request->process_config,
                true,
                null,
                null,
                0,
                0,
                0,
            );

            $response[] = $this->storeImportFilesUseCase->execute($dto);
        }

        return response()->json([
            'message' => 'Archivos procesados',
            'data' => $response,
        ]);
    }

    public function update(UpdateImportFileRequest $request, string $id): JsonResponse
    {
        $dto = ImportFileDTO::create(
            $request->input('fileName'),
            $request->input('fileFormat'),
            $request->input('fileSize'),
            $request->input('storagePath'),
            $request->input('decimalSeparator'),
            $request->input('fileEncoding'),
            $request->input('fileDelimiter'),
            $request->input('spreadsheet'),
            $request->input('processConfig'),
            $request->input('firstRowHeaders'),
            $request->input('key'),
            $request->input('position'),
            $request->input('validRows'),
            $request->input('duplicatedRows'),
            $request->input('errorRows'),
        );
        $response = $this->updateImportFilesUseCase->execute($dto, $id);

        return response()->json([
            'message' => 'Archivo modificado',
            'data' => $response,
        ]);
    }

    public function preview(string $id): JsonResponse
    {
        $result = $this->generateFilePreviewUseCase->execute($id);

        return response()->json($result);
    }

    public function delete(string $id): JsonResponse
    {
        $response = $this->deleteImportFileUseCase->execute($id);

        if (Storage::disk('private')->exists($response->storagePath)) {
            Storage::disk('private')->delete($response->storagePath);
        }

        return response()->json('El archivo fué eliminado con éxito.');
    }

    public function spreadsheets(string $id): JsonResponse
    {
        $model = ImportFileModel::find($id);

        // Obtener la ruta completa usando Storage
        $fullPath = Storage::disk('private')->path($model->storagePath);

        // Verificar si existe
        if (! Storage::disk('private')->exists($model->storagePath)) {
            return response()->json([
                'error' => 'El archivo no existe',
            ], 404);
        }

        $reader = IOFactory::createReaderForFile($fullPath);
        $spreadsheet = $reader->load($fullPath);
        $sheetNames = $spreadsheet->getSheetNames();

        return response()->json($sheetNames);
    }

    public function columnAssignments(string $id): JsonResponse
    {
        $response = $this->getColumnAssignmentByImportFileUseCase->execute($id);

        return response()->json($response);
    }

    // Recibe cada fragmento y lo guarda en disco temporal
    public function receiveChunk(Request $request)
    {
        $uploadId = $request->upload_id;
        $index = (int) $request->chunk_index;

        $request->file('chunk')->storeAs(
            "chunks/{$uploadId}",
            "part_{$index}"
        );

        return response()->json(['ok' => true]);
    }

    // Ensambla los chunks, sube a S3 y dispara el Job
    public function completeUpload(Request $request)
    {
        $uploadId = $request->upload_id;
        $filename = $request->filename;

        // 1. Ensambla
        $finalPath = $this->assembleChunks($uploadId, $filename);

        // 2. Tamaño real del archivo ensamblado
        $fileSize = filesize($finalPath);
        $ext = strtoupper(pathinfo($filename, PATHINFO_EXTENSION));

        // 3. Sube a S3 (en producción) o queda en local (desarrollo)
        $storagePath = "imports/{$uploadId}/{$filename}";
        // Storage::disk('s3')->put($storagePath, fopen($finalPath, 'r'));

        // 4. Guarda metadatos con tu DTO
        $dto = ImportFileDTO::create(
            $filename,
            $ext,
            $fileSize,        // ✅ tamaño real post-ensamblado
            $storagePath,
            null,
            null,
            null,
            null,
            $request->process_config,
            true,
            null,
            null,
            0,
            0,
            0,
        );

        $response = $this->storeImportFilesUseCase->execute($dto);

        // 5. Limpieza
        Storage::deleteDirectory("private/chunks/{$uploadId}");

        return response()->json(['data' => $response]);
    }

    private function assembleChunks(string $uploadId, string $filename): string
    {
        $chunkDir = storage_path("app/private/chunks/{$uploadId}");
        $finalDir = storage_path("app/private/imports/{$uploadId}");
        $finalPath = "{$finalDir}/{$filename}";

        if (! is_dir($finalDir)) {
            mkdir($finalDir, 0755, true);
        }

        $output = fopen($finalPath, 'wb');
        $files = glob("{$chunkDir}/part_*");

        usort($files, fn ($a, $b) => (int) explode('_', basename($a))[1] <=>
            (int) explode('_', basename($b))[1]
        );

        foreach ($files as $chunk) {
            $in = fopen($chunk, 'rb');
            stream_copy_to_stream($in, $output);
            fclose($in);
        }

        fclose($output);

        return $finalPath;
    }
}
