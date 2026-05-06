<?php

namespace App\Src\Infrastructure\ProcessConfig\Persistence\Mappers;

use App\Src\Domain\ProcessConfig\Entities\ProcessConfig;
use App\Src\Domain\ProcessConfig\Factories\ProcessConfigFactory;
use App\Src\Infrastructure\ProcessConfig\Persistence\Models\ProcessConfigModel;

final class ProcessConfigMapper
{
    public static function toModel(ProcessConfig $entity): ProcessConfigModel
    {
        $model = $entity->id() ? ProcessConfigModel::find($entity->id()->value()) : new ProcessConfigModel;

        $data = [
            'company_id' => $entity->company()->value(),
            'layout_id' => $entity->layout()->value(),
            'process_type' => $entity->processType()->value,
            'responsible' => $entity->responsible()->value(),
            'template_name' => $entity->templateName()?->value(),
            'start_date' => $entity->startDate()?->value(),
            'records' => $entity->records()->value(),
            'status' => $entity->status()->value,
        ];

        $model = $model->fill($data);

        return $model;
    }

    public static function toEntity(ProcessConfigModel $model): ProcessConfig
    {
        return ProcessConfigFactory::fromPrimitives(
            $model->_id,
            $model->company_id,
            $model->layout_id,
            $model->process_type,
            $model->responsible,
            $model->template_name,
            $model->start_date,
            $model->records,
            $model->status,
        );
    }
}
