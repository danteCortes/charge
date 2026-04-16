<?php

namespace App\Src\Domain\Company\Repositories;

use App\Src\Domain\Company\Entities\Company;

interface CompanyRepository
{
    /**
     * @return Company[]
     */
    public function list(): array;
}
