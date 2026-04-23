<?php

namespace App\Src\Infrastructure\ColumnAssignment\Persistence\Mappers;

use App\Src\Domain\ColumnAssignment\Entities\ColumnAssignment;
use App\Src\Domain\ColumnAssignment\Factories\ColumnAssignmentFactory;
use App\Src\Infrastructure\ColumnAssignment\Persistence\Models\ColumnAssignmentModel;

final class ColumnAssignmentMapper
{
    public static function toModel(ColumnAssignment $entity): ColumnAssignmentModel
    {
        $model = $entity->id() ? ColumnAssignmentModel::find($entity->id()->value()) : new ColumnAssignmentModel;

        $data = [
            'import_file_id' => $entity->importFileId()->value(),
            'column_name' => $entity->columnName()->value(),
            'system_field_id' => $entity->systemFieldId()->value(),
        ];

        $model = $model->fill($data);

        return $model;
    }

    public static function toEntity(ColumnAssignmentModel $model): ColumnAssignment
    {
        return ColumnAssignmentFactory::fromPrimitives(
            $model->_id,
            $model->import_file_id,
            $model->column_name,
            $model->system_field_id,
        );
    }
}
