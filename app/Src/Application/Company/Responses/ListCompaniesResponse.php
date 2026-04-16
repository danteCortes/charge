<?php

namespace App\Src\Application\Company\Responses;

final class ListCompaniesResponse
{
    /**
     * @param ComapnyResponse[]
     */
    public function __construct(
        public readonly array $companies,
    ) {}
}
