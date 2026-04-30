<?php

namespace App\Src\Application\ProcessConfig\UseCases;

use App\Src\Application\ProcessConfig\DTOs\ListProcessDTO;
use App\Src\Application\ProcessConfig\Responses\ListProcessResponse;
use App\Src\Domain\ProcessConfig\Repositories\ProcessConfigRepository;
use App\Src\Shared\Domain\ValueObjects\Page;
use App\Src\Shared\Domain\ValueObjects\PerPage;
use App\Src\Shared\Domain\ValueObjects\Search;

class ListProcessUseCase
{
    private function __construct(
        private readonly ProcessConfigRepository $repository,
    ) {}

    public static function create(ProcessConfigRepository $repository): self
    {
        return new self($repository);
    }

    public function execute(ListProcessDTO $dto): ListProcessResponse
    {
        $entity = $this->repository->search(
            Page::create($dto->page),
            PerPage::create($dto->perPage),
            $dto->search ? Search::create($dto->search) : null,
        );

        return ListProcessResponse::create(
            $entity->total()->value(),
            $entity->perPage()->value(),
            $entity->page()->value(),
            $entity->lastPage()->value(),
            $entity->from()?->value(),
            $entity->to()?->value(),
            $entity->items(),
        );
    }
}
