<?php

namespace App\Src\Infrastructure\ImportFile\Persistence\Implements;

use App\Src\Domain\ImportFile\Entities\ImportFile;
use App\Src\Domain\ImportFile\Enums\FileFormat;
use App\Src\Domain\ImportFile\Repositories\FilePreviewGenerator;
use App\Src\Domain\ImportFile\ValueObjects\FilePreview;
use Illuminate\Support\Facades\Storage;

class CsvPreviewGenerator implements FilePreviewGenerator
{
    public function supports(FileFormat $format): bool
    {
        return in_array($format, [
            FileFormat::CSV,
            FileFormat::TXT,
        ]);
    }

    public function preview(ImportFile $file): FilePreview
    {
        $relativePath = $file->storagePath()->value();
        $path = Storage::disk('local')->path($relativePath);
        $delimiter = $file->fileDelimiter()?->value ?? ',';
        $encoding = $file->fileEncoding()?->value;
        $hasHeader = $file->isFirstRowHeaders();
        $limit = 3;

        if (! file_exists($path)) {
            throw new \RuntimeException("El archivo no existe: {$path}");
        }

        $handle = fopen($path, 'r');

        if (! $handle) {
            throw new \RuntimeException('No se pudo abrir el archivo');
        }
        $line = fgets($handle);

        if ($line === false) {
            return FilePreview::create([], []);
        }
        if (trim($line) === '') {
            return FilePreview::create([], []);
        }

        $line = $this->convertToUtf8($line, $encoding);
        $firstRow = str_getcsv($line, $delimiter, '"', '\\');

        $columns = [];
        $rows = [];

        if ($hasHeader) {
            $columns = $firstRow;
        } else {
            $columns = $this->generateColumns(count($firstRow));
            $rows[] = $this->normalizeRow($firstRow, count($columns));
        }

        while (($line = fgets($handle)) !== false && count($rows) < $limit) {
            $line = $this->convertToUtf8($line, $encoding);

            $data = str_getcsv($line, $delimiter, '"', '\\');
            $data = $this->normalizeRow($data, count($columns));

            $rows[] = $data;
        }

        fclose($handle);

        return FilePreview::create($columns, $rows);
    }

    private function convertToUtf8(string $value, ?string $encoding): string
    {
        if (! $encoding || strtoupper($encoding) === 'UTF-8') {
            return $value;
        }

        return mb_convert_encoding($value, 'UTF-8', $encoding);
    }

    private function generateColumns(int $count): array
    {
        $columns = [];

        for ($i = 0; $i < $count; $i++) {
            $columns[] = 'col_'.($i + 1);
        }

        return $columns;
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
