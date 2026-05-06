<?php

namespace App\Src\Application\Country\UseCases;

use App\Src\Application\Country\Responses\CountryResponse;
use App\Src\Application\Country\Responses\ListCountriesResponse;
use App\Src\Domain\Country\Repositories\CountryRepository;

class ListCountriesUseCase
{
    private function __construct(
        private readonly CountryRepository $repository,
    ) {}

    public static function create(CountryRepository $repository): self
    {
        return new self($repository);
    }

    public function execute(): ListCountriesResponse
    {
        $entities = $this->repository->list();

        return ListCountriesResponse::create(
            array_map(
                fn ($entity) => CountryResponse::create(
                    $entity->id()?->value(),
                    $entity->name()->value(),
                    $entity->alpha2()->value(),
                    $entity->alpha3()->value(),
                ),
                $entities
            )
        );
    }
}
