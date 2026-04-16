<?php

namespace App\Src\Application\ImportFile\DTOs;

final class ImportFileDTO
{
    private function __construct(
        public readonly string $fileName,
        public readonly string $fileFormat,
        public readonly int $fileSize,
        public readonly string $storagePath,
        public readonly string $processConfig,
        public readonly ?string $decimalSeparator,
        public readonly ?string $fileEncoding,
        public readonly ?string $fileDelimiter,
        public readonly ?string $spreadsheet,
        public readonly bool $firstRowHeaders,
    ) {}

    public static function create(
        string $fileName,
        string $fileFormat,
        int $fileSize,
        string $storagePath,
        string $processConfig,
        ?string $decimalSeparator,
        ?string $fileEncoding,
        ?string $fileDelimiter,
        ?string $spreadsheet,
        bool $firstRowHeaders,
    ): self {
        return new self(
            $fileName,
            $fileFormat,
            $fileSize,
            $storagePath,
            $processConfig,
            $decimalSeparator,
            $fileEncoding,
            $fileDelimiter,
            $spreadsheet,
            $firstRowHeaders,
        );
    }
}
