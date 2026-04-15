<?php

namespace App\Src\Infrastructure\Persistence\MongoDB;

use App\Src\Domain\Repositories\ImportFileRepository;
use App\Src\Infrastructure\Persistence\Mappers\ImportFileMapper;

final class MongoDBImportFileRepository implements ImportFileRepository
{
    /**
     * @param ImportFile[] $files
     */
    public function store(array $files): string
    {
        foreach($files as $importFile)
        {
            $model = ImportFileMapper::toModel($importFile);
            $model->save();
        }

        return "Archivos guardados correctamente.";
    }
}
