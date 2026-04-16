<?php

namespace App\Src\Application\DTOs;

final class ImportFileDTO
{
    private function __construct(
        public readonly string $fileName,
        public readonly string $fileFormat,
        public readonly int $fileSize,
        public readonly string $storagePath
    ) {}

    public static function create(
        string $fileName,
        string $fileFormat,
        int $fileSize,
        string $storagePath
    ): self {
        return new self($fileName, $fileFormat, $fileSize, $storagePath);
    }
}
