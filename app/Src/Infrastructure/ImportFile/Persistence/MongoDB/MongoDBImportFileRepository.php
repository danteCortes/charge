<?php

namespace App\Src\Infrastructure\ImportFile\Persistence\MongoDB;

use App\Src\Domain\ImportFile\Entities\ImportFile;
use App\Src\Domain\ImportFile\Repositories\ImportFileRepository;
use App\Src\Infrastructure\ImportFile\Persistence\Mappers\ImportFileMapper;

final class MongoDBImportFileRepository implements ImportFileRepository
{
    public function store(ImportFile $entity): ImportFile
    {
        $model = ImportFileMapper::toModel($entity);
        $model->save();

        return ImportFileMapper::toEntity($model);
    }

    public function update(ImportFile $entity): ImportFile
    {
        $model = ImportFileMapper::toModel($entity);
        $model->save();

        return ImportFileMapper::toEntity($model);
    }
}
