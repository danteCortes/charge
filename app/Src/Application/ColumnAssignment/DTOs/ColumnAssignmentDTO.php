<?php

namespace App\Src\Application\ColumnAssignment\DTOs;

final class ColumnAssignmentDTO
{
    private function __construct(
        public readonly string $importFileId,
        public readonly string $columnName,
        public readonly string $systemFieldId,
    ) {}

    public static function create(
        string $importFileId,
        string $columnName,
        string $systemFieldId,
    ): self {
        return new self(
            $importFileId,
            $columnName,
            $systemFieldId,
        );
    }
}
