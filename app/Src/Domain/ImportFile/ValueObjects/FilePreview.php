<?php

namespace App\Src\Domain\ImportFile\ValueObjects;

final class FilePreview
{
    private function __construct(
        private readonly array $columns,
        private readonly array $rows,
    ) {}

    public static function create(
        array $columns,
        array $rows,
    ): self {
        return new self($columns, $rows);
    }

    public function columns(): array
    {
        return $this->columns;
    }

    public function rows(): array
    {
        return $this->rows;
    }
}
