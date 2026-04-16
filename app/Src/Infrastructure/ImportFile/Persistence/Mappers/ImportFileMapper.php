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
            'name' => $entity->fileName()->value(),
            'format' => $entity->fileFormat()->value,
            'size' => $entity->fileSize()->value(),
            'path' => $entity->storagePath()->value(),
            'separator' => $entity->decimalSeparator()?->value,
            'encoding' => $entity->fileEncoding()?->value,
            'delimiter' => $entity->fileDelimiter()?->value,
            'spreadsheet' => $entity->spreadsheet()?->value,
            'status' => $entity->fileStatus()->value,
            'process_config_id' => $entity->processConfig()->value(),
            'first_row_headers' => $entity->isFirstRowHeaders(),
        ];

        $model = $model->fill($data);

        return $model;
    }

    public static function toEntity(ImportFileModel $model): ImportFile
    {
        return ImportFileFactory::fromPrimitives(
            $model->_id,
            $model->name,
            $model->format,
            $model->size,
            $model->path,
            $model->separator,
            $model->encoding,
            $model->delimiter,
            $model->spreadsheet,
            $model->status,
            $model->process_config_id,
            $model->first_row_headers,
        );
    }
}
