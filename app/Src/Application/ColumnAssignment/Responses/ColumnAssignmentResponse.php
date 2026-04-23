<?php

namespace App\Src\Application\ColumnAssignment\Responses;

final class ColumnAssignmentResponse
{
    private function __construct(
        public readonly string $id,
        public readonly string $import_file_id,
        public readonly string $column_name,
        public readonly string $system_field_id,
    ) {}

    public static function create(
        string $id,
        string $import_file_id,
        string $column_name,
        string $system_field_id,
    ): self {
        return new self(
            $id,
            $import_file_id,
            $column_name,
            $system_field_id,
        );
    }
}
