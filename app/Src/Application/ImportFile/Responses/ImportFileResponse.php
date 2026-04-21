<?php

namespace App\Src\Application\ImportFile\Responses;

final class ImportFileResponse
{
    private function __construct(
        public readonly ?string $id,
        public readonly string $fileName,
        public readonly string $fileFormat,
        public readonly int $fileSize,
        public readonly string $storagePath,
        public readonly ?string $decimalSeparator,
        public readonly ?string $fileEncoding,
        public readonly ?string $fileDelimiter,
        public readonly ?string $spreadsheet,
        public readonly string $processConfig,
        public readonly bool $firstRowHeaders,
        public readonly ?string $key,
        public readonly ?int $position,
        public readonly int $validRows,
        public readonly int $duplicatedRows,
        public readonly int $errorRows,
    ) {}

    public static function create(
        ?string $id,
        string $fileName,
        string $fileFormat,
        int $fileSize,
        string $storagePath,
        ?string $decimalSeparator,
        ?string $fileEncoding,
        ?string $fileDelimiter,
        ?string $spreadsheet,
        string $processConfig,
        bool $firstRowHeaders,
        ?string $key,
        ?int $position,
        int $validRows,
        int $duplicatedRows,
        int $errorRows,
    ): self {
        return new self(
            $id,
            $fileName,
            $fileFormat,
            $fileSize,
            $storagePath,
            $decimalSeparator,
            $fileEncoding,
            $fileDelimiter,
            $spreadsheet,
            $processConfig,
            $firstRowHeaders,
            $key,
            $position,
            $validRows,
            $duplicatedRows,
            $errorRows,
        );
    }
}
