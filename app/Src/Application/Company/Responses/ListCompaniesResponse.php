<?php

namespace App\Src\Application\Company\Responses;

final class ListCompaniesResponse
{
    /**
     * @param CompanyResponse[]
     */
    public function __construct(
        public readonly array $companies,
    ) {}
}
