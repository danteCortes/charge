<?php

namespace App\Src\Application\ProcessConfig\UseCases;

use App\Src\Application\ProcessConfig\Responses\ProcessConfigResponse;
use App\Src\Domain\ProcessConfig\Repositories\ProcessConfigRepository;

class ShowProcessConfigUseCase
{
    private function __construct(
        private readonly ProcessConfigRepository $repository,
    ) {}

    public static function create(ProcessConfigRepository $repository): self
    {
        return new self($repository);
    }

    public function execute(
        string $id
    ): ProcessConfigResponse {

        $entity = $this->repository->findById(ProcessConfigId::create($id));

        return ProcessConfigResponse::create(
            $entity->id()?->value(),
            $entity->loadType()->value(),
            $entity->processType()->value,
            $entity->layout()->value(),
            $entity->responsible()->value()
        );
    }
}
