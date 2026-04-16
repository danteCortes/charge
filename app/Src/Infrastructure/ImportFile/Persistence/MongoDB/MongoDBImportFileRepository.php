<?php

namespace App\Src\Infrastructure\ImportFile\Persistence\MongoDB;

use App\Src\Domain\ImportFile\Entities\ImportFile;
use App\Src\Domain\ImportFile\Repositories\ImportFileRepository;
use App\Src\Domain\ImportFile\ValueObjects\FileId;
use App\Src\Infrastructure\ImportFile\Persistence\Mappers\ImportFileMapper;
use App\Src\Infrastructure\ImportFile\Persistence\Models\ImportFileModel;

final class MongoDBImportFileRepository implements ImportFileRepository
{
    public function store(ImportFile $entity): ImportFile
    {
        $model = ImportFileMapper::toModel($entity);
        $model->save();

        return ImportFileMapper::toEntity($model);
    }

    public function findById(FileId $id): ImportFile
    {
        $model = ImportFileModel::find($id->value());

        return ImportFileMapper::toEntity($model);
    }
}
