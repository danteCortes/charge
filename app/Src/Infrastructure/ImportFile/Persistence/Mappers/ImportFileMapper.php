<?php

namespace App\Src\Infrastructure\ImportFile\Persistence\Mappers;

use App\Src\Domain\ImportFile\Entities\ImportFile;
use App\Src\Domain\ImportFile\Factories\ImportFileFactory;
use App\Src\Infrastructure\ImportFile\Persistence\Models\ImportFileModel;

final class ImportFileMapper
{
    public static function toModel(ImportFile $entity): ImportFileModel
    {
        $model = $entity->id() ? ImportFileModel::find($entity->id()->value()) : new ImportFileModel;

        $data = [
            'fileName' => $entity->fileName()->value(),
            'fileFormat' => $entity->fileFormat()->value,
            'fileSize' => $entity->fileSize()->value(),
            'storagePath' => $entity->storagePath()->value(),
            'decimalSeparator' => $entity->decimalSeparator()->value,
            'fileEncoding' => $entity->fileEncoding()->value,
            'fileDelimiter' => $entity->fileDelimiter()->value,
            'spreadsheet' => $entity->spreadsheet()->value(),
            'processConfig' => $entity->processConfig()->value(),
            'firstRowHeaders' => $entity->isFirstRowHeaders(),
            'key' => $entity->key()->value(),
            'position' => $entity->position()->value(),
            'validRows' => $entity->validRows()->value(),
            'duplicatedRows' => $entity->duplicatedRows()->value(),
            'errorRows' => $entity->errorRows()->value(),
        ];

        $model = $model->fill($data);

        return $model;
    }

    public static function toEntity(ImportFileModel $model): ImportFile
    {
        return ImportFileFactory::fromPrimitives(
            $model->_id,
            $model->fileName,
            $model->fileFormat,
            $model->fileSize,
            $model->storagePath,
            $model->decimalSeparator,
            $model->fileEncoding,
            $model->fileDelimiter,
            $model->spreadsheet,
            $model->processConfig,
            $model->firstRowHeaders,
            $model->key,
            $model->position,
            $model->validRows,
            $model->duplicatedRows,
            $model->errorRows,
        );
    }
}
