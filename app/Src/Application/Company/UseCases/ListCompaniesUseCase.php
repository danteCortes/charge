<?php

namespace App\Src\Application\Company\UseCases;

use App\Src\Application\Company\Responses\CompanyResponse;
use App\Src\Application\Company\Responses\ListCompaniesResponse;
use App\Src\Domain\Company\Repositories\CompanyRepository;

class ListCompaniesUseCase
{
    public function __construct(
        private readonly CompanyRepository $repository,
    ) {}

    public function execute(): ListCompaniesResponse
    {

        $companies = $this->repository->list();

        $companyResponse = [];

        foreach ($companies as $company) {
            $companyResponse[] = new CompanyResponse(
                $company->id()->value(),
                $company->countryId()->value(),
                $company->code()->value(),
                $company->name()->value(),
                $company->responsible()->value(),
                $company->status()->isActive(),
            );
        }

        return new ListCompaniesResponse($companyResponse);
    }
}
