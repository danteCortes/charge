<?php

namespace App\Src\Domain\ColumnAssignment\Entities;

use App\Src\Domain\ColumnAssignment\ValueObjects\ColumnAssignmentId;
use App\Src\Domain\ColumnAssignment\ValueObjects\ColumnName;
use App\Src\Domain\ColumnAssignment\ValueObjects\ImportFileId;
use App\Src\Domain\ColumnAssignment\ValueObjects\SystemFieldId;

class ColumnAssignment
{
    private function __construct(
        private readonly ?ColumnAssignmentId $id,
        private readonly ImportFileId $importFileId,
        private readonly ColumnName $columnName,
        private readonly SystemFieldId $systemFieldId,
    ) {}

    public static function create(
        ?ColumnAssignmentId $id,
        ImportFileId $importFileId,
        ColumnName $columnName,
        SystemFieldId $systemFieldId,
    ): self {
        return new self(
            $id,
            $importFileId,
            $columnName,
            $systemFieldId,
        );
    }

    public function id(): ?ColumnAssignmentId
    {
        return $this->id;
    }

    public function importFileId(): ImportFileId
    {
        return $this->importFileId;
    }

    public function columnName(): ColumnName
    {
        return $this->columnName;
    }

    public function systemFieldId(): SystemFieldId
    {
        return $this->systemFieldId;
    }
}
