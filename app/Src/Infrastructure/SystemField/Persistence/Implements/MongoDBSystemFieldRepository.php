<?php

namespace App\Src\Infrastructure\SystemField\Persistence\Implements;

use App\Src\Domain\SystemField\Repositories\SystemFieldRepository;
use App\Src\Infrastructure\SystemField\Persistence\Mappers\SystemFieldMapper;
use App\Src\Infrastructure\SystemField\Persistence\Models\SystemFieldModel;

class MongoDBSystemFieldRepository implements SystemFieldRepository
{
    /**
     * @return App\Src\Domain\SystemField\Entities\SystemField[]
     */
    public function list(): array
    {
        $systemFields = SystemFieldModel::all()
            ->map(fn ($model) => SystemFieldMapper::toEntity($model))
            ->all();

        return $systemFields;
    }
}
