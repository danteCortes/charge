<?php

namespace App\Src\Domain\Country\Repositories;

use App\Src\Domain\Country\ValueObjects\CountryId;

interface CountryRepository
{
    /**
     * @return Country[]
     */
    public function list(): array;

    /**
     * @return App\Src\Domain\Company\Entities\Company[]
     */
    public function companies(CountryId $id): array;
}
