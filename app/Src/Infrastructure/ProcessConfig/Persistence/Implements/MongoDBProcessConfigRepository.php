<?php

namespace App\Src\Infrastructure\ProcessConfig\Persistence\Implements;

use App\Src\Domain\ProcessConfig\Entities\ProcessConfig;
use App\Src\Domain\ProcessConfig\Repositories\ProcessConfigRepository;
use App\Src\Domain\ProcessConfig\ValueObjects\ProcessConfigId;
use App\Src\Infrastructure\ImportFile\Persistence\Mappers\ImportFileMapper;
use App\Src\Infrastructure\ProcessConfig\Persistence\Mappers\ProcessConfigMapper;
use App\Src\Infrastructure\ProcessConfig\Persistence\Models\ProcessConfigModel;

class MongoDBProcessConfigRepository implements ProcessConfigRepository
{
    public function save(ProcessConfig $entity): ProcessConfig
    {
        $model = ProcessConfigMapper::toModel($entity);
        $model->save();

        return ProcessConfigMapper::toEntity($model);
    }

    public function findById(ProcessConfigId $id): ?ProcessConfig
    {
        $model = ProcessConfigModel::find($id->value());

        return $model ? ProcessConfigMapper::toEntity($model) : null;
    }

    public function files(ProcessConfigId $id): array
    {
        $model = ProcessConfigModel::find($id->value());

        $entities = [];
        foreach ($model->files as $file) {
            $entities[] = ImportFileMapper::toEntity($file);
        }

        return $entities;
    }
}
