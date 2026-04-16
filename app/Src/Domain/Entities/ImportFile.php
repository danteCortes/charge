<?php

namespace App\Src\Domain\Entities;

use App\Src\Domain\Enums\DecimalSeparator;
use App\Src\Domain\Enums\FileDelimiter;
use App\Src\Domain\Enums\FileEncoding;
use App\Src\Domain\Enums\FileFormat;
use App\Src\Domain\Enums\FileStatus;
use App\Src\Domain\Enums\Spreadsheet;
use App\Src\Domain\ValueObjects\FileId;
use App\Src\Domain\ValueObjects\FileName;
use App\Src\Domain\ValueObjects\FileSize;
use App\Src\Domain\ValueObjects\StoragePath;
use App\Src\Domain\ValueObjects\ProcessConfigId;

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
        private readonly ProcessConfigId $processConfig
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
        ProcessConfigId $processConfig
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
            $processConfig
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
}
