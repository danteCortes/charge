<?php

namespace App\Src\Application\Country\UseCases;

use App\Src\Application\Company\Responses\CompanyResponse;
use App\Src\Application\Company\Responses\ListCompaniesResponse;
use App\Src\Domain\Country\Repositories\CountryRepository;
use App\Src\Domain\Country\ValueObjects\CountryId;

class GetCompaniesByCountryIdUseCase
{
    private function __construct(
        private readonly CountryRepository $repository,
    ) {}

    public static function create(CountryRepository $repository): self
    {
        return new self($repository);
    }

    public function execute(string $id): ListCompaniesResponse
    {
        $entities = $this->repository->companies(CountryId::create($id));

        return new ListCompaniesResponse(
            array_map(
                fn ($entity) => new CompanyResponse(
                    $entity->id()?->value(),
                    $entity->countryId()->value(),
                    $entity->code()->value(),
                    $entity->name()->value(),
                    $entity->fantasyName()->value(),
                    $entity->responsible()->value(),
                    $entity->status()->isActive(),
                ),
                $entities
            )
        );
    }
}
