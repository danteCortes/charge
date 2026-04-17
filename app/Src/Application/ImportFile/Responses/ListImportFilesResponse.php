<?php

namespace App\Src\Application\ImportFile\Responses;

final class ListImportFilesResponse
{
    private function __construct(
        public readonly array $importFiles
    ) {}

    public static function create(
        array $importFiles
    ): self {
        return new self(
            $importFiles
        );
    }
}
