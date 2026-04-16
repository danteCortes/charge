<?php

namespace App\Src\Infrastructure\Company\Persistence\Implements;

use App\Src\Domain\Company\Repositories\CompanyRepository;
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
}
