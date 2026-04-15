<?php

namespace App\Src\Domain\Factories;

use App\Src\Domain\Entities\ImportFile;
use App\Src\Domain\Enums\DecimalSeparator;
use App\Src\Domain\Enums\FileFormat;
use App\Src\Domain\Enums\FileEncoding;
use App\Src\Domain\Enums\FileStatus;
use App\Src\Domain\Enums\FileDelimiter;
use App\Src\Domain\Enums\Spreadsheet;
use App\Src\Domain\ValueObjects\FileId;
use App\Src\Domain\ValueObjects\FileName;
use App\Src\Domain\ValueObjects\FileSize;
use App\Src\Domain\ValueObjects\StoragePath;

final class ImportFileFactory
{
    public static function fromPrimitives(
        ?string $id,
        string $fileName,
        string $fileFormat,
        int $fileSize,
        string $storagePath,
        ?string $decimalSeparator,
        ?string $fileEncoding,
        ?string $fileDelimiter,
        ?int $spreadsheet,
        string $fileStatus;
    ): ImportFile
    {
        return ImportFile::create(
            $id ? FileId::create($id) : null,
            FileName::create($fileName),
            FileFormat::fromString($fileFormat),
            FileSize::create($fileSize),
            StoragePath::create($storagePath),
            $decimalSeparator ? DecimalSeparator::fromString($decimalSeparator) : null,
            $fileEncoding ? FileEncoding::fromString($fileEncoding) : null,
            $fileDelimiter ? FileDelimiter::fromString($fileDelimiter): null,
            $spreadsheet ? Spreadsheet::fromString($spreadsheet) : null,
            FileStatus::fromString($fileStatus)
        );
    }
}