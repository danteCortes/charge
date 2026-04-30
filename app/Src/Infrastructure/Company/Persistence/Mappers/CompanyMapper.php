<?php

namespace App\Src\Infrastructure\Company\Persistence\Mappers;

use App\Src\Domain\Company\Entities\Company;
use App\Src\Domain\Company\Factories\CompanyFactory;
use App\Src\Infrastructure\Company\Persistence\Models\CompanyModel;

final class CompanyMapper
{
    public static function toModel(Company $entity): CompanyModel
    {
        $model = $entity->id() ? CompanyModel::find($rntity->id()->value()) : new CompanyModel;
        $model->country_id = $entity->countryId()->value();
        $model->code = $entity->code()->value();
        $model->name = $entity->name()->value();
        $model->responsible = $entity->responsible()->value();
        $model->status = $entity->status()->isActive();

        return $model;
    }

    public static function toEntity(CompanyModel $model): Company
    {
        return CompanyFactory::fromPrimitives(
            $model->_id,
            $model->country_id,
            $model->code,
            $model->name,
            $model->responsible,
            $model->status,
        );
    }
}
