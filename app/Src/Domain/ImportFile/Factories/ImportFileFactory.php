<?php

namespace App\Src\Domain\ImportFile\Factories;

use App\Src\Domain\ImportFile\Entities\ImportFile;
use App\Src\Domain\ImportFile\Enums\DecimalSeparator;
use App\Src\Domain\ImportFile\Enums\FileDelimiter;
use App\Src\Domain\ImportFile\Enums\FileEncoding;
use App\Src\Domain\ImportFile\Enums\FileFormat;
use App\Src\Domain\ImportFile\Enums\FirstRowHeaders;
use App\Src\Domain\ImportFile\ValueObjects\FileId;
use App\Src\Domain\ImportFile\ValueObjects\FileName;
use App\Src\Domain\ImportFile\ValueObjects\FileSize;
use App\Src\Domain\ImportFile\ValueObjects\ProcessConfigId;
use App\Src\Domain\ImportFile\ValueObjects\Spreadsheet;
use App\Src\Domain\ImportFile\ValueObjects\StoragePath;
use App\Src\Domain\ImportFile\ValueObjects\Key;
use App\Src\Domain\ImportFile\ValueObjects\Position;
use App\Src\Domain\ImportFile\ValueObjects\ValidRows;
use App\Src\Domain\ImportFile\ValueObjects\DuplicatedRows;
use App\Src\Domain\ImportFile\ValueObjects\ErrorRows;

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
        ?string $spreadsheet,
        string $processConfig,
        bool $firstRowHeaders,
        ?string $key,
        ?int $position,
        int $validRows,
        int $duplicatedRows,
        int $errorRows,
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
            $spreadsheet ? Spreadsheet::create($spreadsheet) : null,
            ProcessConfigId::create($processConfig),
            $firstRowHeaders ? FirstRowHeaders::YES : FirstRowHeaders::NO,
            $key ? Key::create($key) : null,
            $position ? Position::create($position) : null,
            ValidRows::create($validRows),
            DuplicatedRows::create($duplicatedRows),
            ErrorRows::create($errorRows),
        );
    }
}
