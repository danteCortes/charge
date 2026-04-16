<?php

namespace App\Src\Infrastructure\Persistence\Mappers;

use App\Src\Domain\Entities\ImportFile;
use App\Src\Domain\Factories\ImportFileFactory;
use App\Src\Infrastructure\Persistence\Models\ImportFileModel;

final class ImportFileMapper
{
    public static function toModel(ImportFile $entity): ImportFileModel
    {
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
        ];

        if ($entity->id()) {
            $data['id'] = $entity->id()->value();
        }
        $model = new ImportFileModel;
        $model->fill($data);

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
        );
    }
}
