<?php

namespace App\Src\Infrastructure\LoadType\Persistence\Implements;

use App\Src\Domain\LoadType\Repositories\LoadTypeRepository;
use App\Src\Infrastructure\LoadType\Persistence\Mappers\LoadTypeMapper;
use App\Src\Infrastructure\LoadType\Persistence\Models\LoadTypeModel;

class MongoDBLoadTypeRepository implements LoadTypeRepository
{
    /**
     * @return App\Src\Domain\LoadType\Entities\LoadType[]
     */
    public function list(): array
    {
        $loadTypes = LoadTypeModel::all()
            ->map(fn ($loadType) => LoadTypeMapper::toEntity($loadType))
            ->all();

        return $loadTypes;
    }
}
