<?php

namespace App\Src\Domain\ColumnAssignment\Repositories;

use App\Src\Domain\ColumnAssignment\Entities\ColumnAssignment;
use App\Src\Domain\ColumnAssignment\ValueObjects\ColumnAssignmentId;

interface ColumnAssignmentRepository
{
    public function save(ColumnAssignment $entity): ColumnAssignment;

    public function findById(ColumnAssignmentId $id): ?ColumnAssignment;
}
