<?php

namespace App\Src\Domain\ImportFile\Factories;

use App\Src\Domain\ImportFile\Entities\ImportFile;
use App\Src\Domain\ImportFile\Enums\DecimalSeparator;
use App\Src\Domain\ImportFile\Enums\FileDelimiter;
use App\Src\Domain\ImportFile\Enums\FileEncoding;
use App\Src\Domain\ImportFile\Enums\FileFormat;
use App\Src\Domain\ImportFile\Enums\FileStatus;
use App\Src\Domain\ImportFile\Enums\FirstRowHeaders;
use App\Src\Domain\ImportFile\Enums\Spreadsheet;
use App\Src\Domain\ImportFile\ValueObjects\FileId;
use App\Src\Domain\ImportFile\ValueObjects\FileName;
use App\Src\Domain\ImportFile\ValueObjects\FileSize;
use App\Src\Domain\ImportFile\ValueObjects\ProcessConfigId;
use App\Src\Domain\ImportFile\ValueObjects\StoragePath;

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
        string $fileStatus,
        string $processConfig,
        bool $firstRowHeaders,
    ): ImportFile {
        return ImportFile::create(
            $id ? FileId::create($id) : null,
            FileName::create($fileName),
            FileFormat::fromString($fileFormat),
            FileSize::create($fileSize),
            StoragePath::create($storagePath),
            $decimalSeparator ? DecimalSeparator::fromString($decimalSeparator) : null,
            $fileEncoding ? FileEncoding::fromString($fileEncoding) : null,
            $fileDelimiter ? FileDelimiter::fromString($fileDelimiter) : null,
            $spreadsheet ? Spreadsheet::fromString($spreadsheet) : null,
            FileStatus::fromString($fileStatus),
            ProcessConfigId::create($processConfig),
            $firstRowHeaders ? FirstRowHeaders::YES : FirstRowHeaders::NO
        );
    }
}
