<?php

namespace App\Src\Infrastructure\ColumnAssignment\Persistence\Implements;

use App\Src\Domain\ColumnAssignment\Entities\ColumnAssignment;
use App\Src\Domain\ColumnAssignment\Repositories\ColumnAssignmentRepository;
use App\Src\Domain\ColumnAssignment\ValueObjects\ColumnAssignmentId;
use App\Src\Infrastructure\ColumnAssignment\Persistence\Mappers\ColumnAssignmentMapper;
use App\Src\Infrastructure\ColumnAssignment\Persistence\Models\ColumnAssignmentModel;

class MongoDBColumnAssignmentRepository implements ColumnAssignmentRepository
{
    public function save(ColumnAssignment $entity): ColumnAssignment
    {
        $model = ColumnAssignmentMapper::toModel($entity);
        $model->save();

        return ColumnAssignmentMapper::toEntity($model);
    }

    public function findById(ColumnAssignmentId $id): ?ColumnAssignment
    {
        $model = ColumnAssignmentModel::find($id->value());

        return $model ? ColumnAssignmentMapper::toEntity($model) : null;
    }
}
