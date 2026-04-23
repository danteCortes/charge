<?php

namespace App\Src\Domain\ColumnAssignment\Factories;

use App\Src\Domain\ColumnAssignment\Entities\ColumnAssignment;
use App\Src\Domain\ColumnAssignment\ValueObjects\ColumnAssignmentId;
use App\Src\Domain\ColumnAssignment\ValueObjects\ColumnName;
use App\Src\Domain\ColumnAssignment\ValueObjects\ImportFileId;
use App\Src\Domain\ColumnAssignment\ValueObjects\SystemFieldId;

class ColumnAssignmentFactory
{
    public static function fromPrimitives(
        ?string $id,
        string $importFileId,
        string $columnName,
        string $systemFieldId,
    ): ColumnAssignment {
        return ColumnAssignment::create(
            $id ? ColumnAssignmentId::create($id) : null,
            ImportFileId::create($importFileId),
            ColumnName::create($columnName),
            SystemFieldId::create($systemFieldId),
        );
    }
}
