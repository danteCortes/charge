<?php

namespace App\Src\Domain\ImportFile\Entities;

use App\Src\Domain\ImportFile\Enums\DecimalSeparator;
use App\Src\Domain\ImportFile\Enums\FileDelimiter;
use App\Src\Domain\ImportFile\Enums\FileEncoding;
use App\Src\Domain\ImportFile\Enums\FileFormat;
use App\Src\Domain\ImportFile\Enums\FileStatus;
use App\Src\Domain\ImportFile\Enums\FirstRowHeaders;
use App\Src\Domain\ImportFile\ValueObjects\FileId;
use App\Src\Domain\ImportFile\ValueObjects\FileName;
use App\Src\Domain\ImportFile\ValueObjects\FileSize;
use App\Src\Domain\ImportFile\ValueObjects\ProcessConfigId;
use App\Src\Domain\ImportFile\ValueObjects\Spreadsheet;
use App\Src\Domain\ImportFile\ValueObjects\StoragePath;

final class ImportFile
{
    private function __construct(
        private readonly ?FileId $id,
        private readonly FileName $fileName,
        private readonly FileFormat $fileFormat,
        private readonly FileSize $fileSize,
        private readonly StoragePath $storagePath,
        private readonly ?DecimalSeparator $decimalSeparator,
        private readonly ?FileEncoding $fileEncoding,
        private readonly ?FileDelimiter $fileDelimiter,
        private readonly ?Spreadsheet $spreadsheet,
        private readonly FileStatus $fileStatus,
        private readonly ProcessConfigId $processConfig,
        private readonly FirstRowHeaders $firstRowHeaders,
    ) {}

    public static function create(
        ?FileId $id,
        FileName $fileName,
        FileFormat $fileFormat,
        FileSize $fileSize,
        StoragePath $storagePath,
        ?DecimalSeparator $decimalSeparator,
        ?FileEncoding $fileEncoding,
        ?FileDelimiter $fileDelimiter,
        ?Spreadsheet $spreadsheet,
        FileStatus $fileStatus,
        ProcessConfigId $processConfig,
        FirstRowHeaders $firstRowHeaders,
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
            $fileStatus,
            $processConfig,
            $firstRowHeaders,
        );
    }

    public function id(): ?FileId
    {
        return $this->id;
    }

    public function fileName(): FileName
    {
        return $this->fileName;
    }

    public function fileFormat(): FileFormat
    {
        return $this->fileFormat;
    }

    public function fileSize(): FileSize
    {
        return $this->fileSize;
    }

    public function storagePath(): StoragePath
    {
        return $this->storagePath;
    }

    public function decimalSeparator(): ?DecimalSeparator
    {
        return $this->decimalSeparator;
    }

    public function fileEncoding(): ?FileEncoding
    {
        return $this->fileEncoding;
    }

    public function fileDelimiter(): ?FileDelimiter
    {
        return $this->fileDelimiter;
    }

    public function spreadsheet(): ?Spreadsheet
    {
        return $this->spreadsheet;
    }

    public function fileStatus(): FileStatus
    {
        return $this->fileStatus;
    }

    public function processConfig(): ProcessConfigId
    {
        return $this->processConfig;
    }

    public function isFirstRowHeaders(): bool
    {
        return $this->firstRowHeaders === FirstRowHeaders::YES;
    }

    public function process(): void
    {
        $this->fileStatus = FileStatus::PROCESS;
    }

    public function ready(): void
    {
        $this->fileStatus = FileStatus::READY;
    }
}
