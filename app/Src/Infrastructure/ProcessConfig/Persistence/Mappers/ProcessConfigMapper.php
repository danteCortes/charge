<?php

namespace App\Src\Infrastructure\ProcessConfig\Persistence\Mappers;

use App\Src\Domain\ProcessConfig\Entities\ProcessConfig;
use App\Src\Domain\ProcessConfig\Factories\ProcessConfigFactory;
use App\Src\Infrastructure\ProcessConfig\Persistence\Models\ProcessConfigModel;

final class ProcessConfigMapper
{
    public static function toModel(ProcessConfig $entity): ProcessConfigModel
    {
        $model = new ProcessConfigModel;

        $data = [
            'company_id' => $entity->company()?->value(),
            'load_type_id' => $entity->loadType()?->value(),
            'layout_id' => $entity->layout()?->value(),
            'responsible' => $entity->responsible()?->value(),
            'process_type' => $entity->processType()?->value,
        ];

        if ($entity->id()) {
            $data['id'] = $entity->id()->value();
        }

        $model = $model->fill($data);

        return $model;
    }

    public static function toEntity(ProcessConfigModel $model): ProcessConfig
    {
        return ProcessConfigFactory::fromPrimitives(
            $model->_id,
            $model->company_id,
            $model->load_type_id,
            $model->process_type,
            $model->layout_id,
            $model->responsible,
        );
    }
}
