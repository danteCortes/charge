<?php

namespace App\Src\Infrastructure\SystemField\Persistence\Mappers;

use App\Src\Domain\SystemField\Entities\SystemField;
use App\Src\Domain\SystemField\Factories\SystemFieldFactory;
use App\Src\Infrastructure\SystemField\Persistence\Models\SystemFieldModel;

final class SystemFieldMapper
{
    public static function toModel(SystemField $entity): SystemFieldModel
    {
        $model = $entity->id() ? SystemFieldModel::find($entity->id()->value()) : new SystemFieldModel;
        $data = [
            'name' => $entity->name()->value(),
            'description' => $entity->description()?->value(),
            'required' => $entity->isRequired(),
        ];

        $model = $model->fill($data);

        return $model;
    }

    public static function toEntity(SystemFieldModel $model): SystemField
    {
        return SystemFieldFactory::fromPrimitives(
            $model->_id,
            $model->name,
            $model->description,
            $model->required ? true : false
        );
    }
}
