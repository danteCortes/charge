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
        public readonly string $processConfig,
        public readonly ?string $decimalSeparator,
        public readonly ?string $fileEncoding,
        public readonly ?string $fileDelimiter,
        public readonly ?string $spreadsheet,
        public readonly bool $firstRowHeaders,
        public readonly string $fileStatus,
    ) {}

    public static function create(
        ?string $id,
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
        string $fileStatus,
    ): self {
        return new self(
            $id,
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
            $fileStatus,
        );
    }
}
