<?php

namespace App\Src\Application\ImportFile\Responses;

use App\Src\Domain\ImportFile\ValueObjects\FilePreview;

class FilePreviewResponse
{
    public function __construct(
        public array $columns,
        public array $rows,
    ) {}

    public static function fromDomain(FilePreview $preview): self
    {
        return new self(
            columns: $preview->columns(),
            rows: $preview->rows(),
        );
    }
}
