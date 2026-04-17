<?php

namespace App\Src\Infrastructure\Layout\Persistence\Mappers;

use App\Src\Domain\Layout\Entities\Layout;
use App\Src\Domain\Layout\Factories\LayoutFactory;
use App\Src\Infrastructure\Layout\Persistence\Models\LayoutModel;

final class LayoutMapper
{
    public static function toModel(Layout $entity): LayoutModel
    {
        $model = $entity->id() ? LayoutModel::find($entity->id()->value()) : new LayoutModel;
        $model->name = $entity->name()->value();

        return $model;
    }

    public static function toEntity(LayoutModel $model): Layout
    {
        return LayoutFactory::fromPrimitives(
            $model->_id,
            $model->name
        );
    }
}
