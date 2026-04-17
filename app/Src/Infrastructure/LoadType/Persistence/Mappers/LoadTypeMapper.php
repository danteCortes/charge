<?php

namespace App\Src\Infrastructure\LoadType\Persistence\Mappers;

use App\Src\Domain\LoadType\Entities\LoadType;
use App\Src\Domain\LoadType\Factories\LoadTypeFactory;
use App\Src\Infrastructure\LoadType\Persistence\Models\LoadTypeModel;

final class LoadTypeMapper
{
    public static function toModel(LoadType $entity): LoadTypeModel
    {
        $model = $entity->id() ? LoadTypeModel::find($entity->id()->value()) : new LoadTypeModel;
        $model->name;

        return $model;
    }

    public static function toEntity(LoadTypeModel $model): LoadType
    {
        return LoadTypeFactory::fromPrimitives(
            $model->id,
            $model->name
        );
    }
}
