<?php

namespace App\Src\Infrastructure\Country\Persistence\Mappers;

use App\Src\Domain\Country\Entities\Country;
use App\Src\Domain\Country\Factories\CountryFactory;
use App\Src\Infrastructure\Country\Persistence\Models\CountryModel;

final class CountryMapper
{
    public static function toModel(Country $entity): CountryModel
    {
        $model = $entity->id() ? CountryModel::find($entity->id()->value()) : new CountryModel;

        $data = [
            'name' => $entity->name()->value(),
            'alpha2' => $entity->alpha2()->value(),
            'alpha3' => $entity->alpha3()->value(),
        ];

        return $model->fill($data);
    }

    public static function toEntity(CountryModel $model): Country
    {
        return CountryFactory::fromPrimitives(
            $model->_id,
            $model->name,
            $model->alpha2,
            $model->alpha3,
        );
    }
}
