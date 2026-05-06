<?php

namespace App\Src\Domain\Company\Repositories;

use App\Src\Domain\Company\Entities\Company;
use App\Src\Domain\Company\ValueObjects\CountryId;

interface CompanyRepository
{
    /**
     * @return Company[]
     */
    public function list(): array;

    /**
     * @param CountryId
     * @return Company[]
     */
    public function getCompaniesByCountryId(CountryId $countryId): array;
}
