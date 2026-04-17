<?php

namespace App\Src\Infrastructure\Layout\Persistence\Implements;

use App\Src\Domain\Layout\Entities\Layout;
use App\Src\Domain\Layout\Repositories\LayoutRepository;
use App\Src\Infrastructure\Layout\Persistence\Mappers\LayoutMapper;
use App\Src\Infrastructure\Layout\Persistence\Models\LayoutModel;

class MongoDBLayoutRepository implements LayoutRepository
{
    /**
     * @return Layout[]
     */
    public function list(): array
    {
        $layouts = LayoutModel::all()
            ->map(fn ($layout) => LayoutMapper::toEntity($layout))
            ->all();

        return $layouts;
    }
}
