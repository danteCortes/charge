<?php

namespace App\Src\Application\LoadType\UseCases;

use App\Src\Application\LoadType\Responses\ListLoadTypesResponse;
use App\Src\Application\LoadType\Responses\LoadTypeResponse;
use App\Src\Domain\LoadType\Repositories\LoadTypeRepository;

class ListLoadTypesUseCase
{
    private function __construct(
        private readonly LoadTypeRepository $repository,
    ) {}

    public static function create(LoadTypeRepository $repository): self
    {
        return new self($repository);
    }

    public function execute(): ListLoadTypesResponse
    {
        $loadTypes = $this->repository->list();

        $loadTypeResponses = [];
        foreach ($loadTypes as $loadType) {
            $loadTypeResponses[] = LoadTypeResponse::create(
                $loadType->id()?->value(),
                $loadType->name()->value()
            );
        }

        return ListLoadTypesResponse::create($loadTypeResponses);
    }
}
