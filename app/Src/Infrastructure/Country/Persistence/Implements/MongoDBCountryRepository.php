<?php

namespace App\Src\Infrastructure\Country\Persistence\Implements;

use App\Src\Domain\Country\Entities\Country;
use App\Src\Domain\Country\Repositories\CountryRepository;
use App\Src\Domain\Country\ValueObjects\CountryId;
use App\Src\Infrastructure\Company\Persistence\Mappers\CompanyMapper;
use App\Src\Infrastructure\Country\Persistence\Mappers\CountryMapper;
use App\Src\Infrastructure\Country\Persistence\Models\CountryModel;

class MongoDBCountryRepository implements CountryRepository
{
    /**
     * @return Country[]
     */
    public function list(): array
    {
        $entities = CountryModel::all()
            ->map(fn ($model) => CountryMapper::toEntity($model))
            ->all();

        return $entities;
    }

    /**
     * @return App\Src\Domain\Company\Entities\Company[]
     */
    public function companies(CountryId $id): array
    {
        $model = CountryModel::findOrFail($id->value());

        \Log::info($model->companies);

        return $model->companies->map(fn ($companyModel) => CompanyMapper::toEntity($companyModel))->all();
    }
}
