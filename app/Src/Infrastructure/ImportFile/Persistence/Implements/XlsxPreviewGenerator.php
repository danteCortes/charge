<?php

namespace App\Src\Infrastructure\ImportFile\Persistence\Implements;

use App\Src\Domain\ImportFile\Entities\ImportFile;
use App\Src\Domain\ImportFile\Enums\FileFormat;
use App\Src\Domain\ImportFile\Repositories\FilePreviewGenerator;
use App\Src\Domain\ImportFile\ValueObjects\FilePreview;
use PhpOffice\PhpSpreadsheet\IOFactory;

class XlsxPreviewGenerator implements FilePreviewGenerator
{
    public function supports(FileFormat $format): bool
    {
        return $format->isSpreadsheet();
    }

    public function preview(ImportFile $file): FilePreview
    {
        $relativePath = $file->storagePath()->value();
        $path = storage_path('app/private/'.$relativePath);

        if (! file_exists($path)) {
            throw new \RuntimeException("El archivo no existe: {$path}");
        }

        $sheetName = $file->spreadsheet()?->value();
        $hasHeader = $file->isFirstRowHeaders();
        $limit = 3;

        $spreadsheet = IOFactory::load($path);

        $sheet = $sheetName
            ? $spreadsheet->getSheetByName($sheetName)
            : $spreadsheet->getActiveSheet();

        if (! $sheet) {
            throw new \RuntimeException("La hoja {$sheetName} no existe");
        }

        $rowsData = $sheet->toArray();

        if (empty($rowsData)) {
            return FilePreview::create([], []);
        }

        $columns = [];
        $rows = [];

        $firstRow = $rowsData[0];

        if ($hasHeader) {
            $columns = $firstRow;
            $dataRows = array_slice($rowsData, 1);
        } else {
            $columns = $this->generateColumns(count($firstRow));
            $dataRows = $rowsData;
        }

        foreach ($dataRows as $row) {
            if (count($rows) >= $limit) {
                break;
            }

            $rows[] = $this->normalizeRow($row, count($columns));
        }

        return FilePreview::create($columns, $rows);
    }

    private function generateColumns(int $count): array
    {
        return array_map(fn ($i) => 'col_'.($i + 1), range(0, $count - 1));
    }

    private function normalizeRow(array $row, int $expected): array
    {
        $current = count($row);

        if ($current < $expected) {
            return array_pad($row, $expected, null);
        }

        if ($current > $expected) {
            return array_slice($row, 0, $expected);
        }

        return $row;
    }
}
