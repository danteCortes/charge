<?php

namespace App\Src\Application\Company\UseCases;

use App\Src\Application\Company\Responses\CompanyResponse;
use App\Src\Application\Company\Responses\ListCompaniesResponse;
use App\Src\Domain\Company\Repositories\CompanyRepository;
use App\Src\Domain\Company\ValueObjects\CountryId;

class GetCompaniesByCountryIdUseCase
{
    private function __construct(
        private readonly CompanyRepository $repository,
    ) {}

    public static function create(CompanyRepository $repository): self
    {
        return new self($repository);
    }

    public function execute(string $countryId): ListCompaniesResponse
    {
        $companies = $this->repository->getCompaniesByCountryId(CountryId::create($countryId));

        return new ListCompaniesResponse(array_map(
            fn ($company) => new CompanyResponse(
                $company->id()?->value(),
                $company->countryId()->value(),
                $company->code()->value(),
                $company->name()->value(),
                $company->fantasyName()->value(),
                $company->responsible()->value(),
                $company->status()->isActive(),
            ),
            $companies
        ));
    }
}
