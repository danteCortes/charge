<?php

namespace App\Src\Infrastructure\Company\Persistence\Implements;

use App\Src\Domain\Company\Repositories\CompanyRepository;
use App\Src\Domain\Company\ValueObjects\CountryId;
use App\Src\Infrastructure\Company\Persistence\Mappers\CompanyMapper;
use App\Src\Infrastructure\Company\Persistence\Models\CompanyModel;

class MongoDBCompanyRepository implements CompanyRepository
{
    /**
     * @return Company[]
     */
    public function list(): array
    {
        $list = CompanyModel::all()
            ->map(fn ($company) => CompanyMapper::toEntity($company))
            ->all();

        return $list;
    }

    /**
     * @param CountryId
     * @return Company[]
     */
    public function getCompaniesByCountryId(CountryId $countryId): array
    {
        $list = CompanyModel::where('country_id', $countryId->value())
            ->get()
            ->map(fn ($company) => CompanyMapper::toEntity($company))
            ->all();

        return $list;
    }
}
