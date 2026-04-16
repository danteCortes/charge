<?php

namespace App\Src\Application\ProcessConfig\UseCases;

use App\Src\Application\ProcessConfig\DTOs\ProcessConfigDTO;
use App\Src\Application\ProcessConfig\Responses\ProcessConfigResponse;
use App\Src\Domain\ProcessConfig\Factories\ProcessConfigFactory;
use App\Src\Domain\ProcessConfig\Repositories\ProcessConfigRepository;

class UpdateProcessConfigUseCase
{
    private function __construct(
        private readonly ProcessConfigRepository $repository,
    ) {}

    public static function create(ProcessConfigRepository $repository): self
    {
        return new self($repository);
    }

    public function execute(
        ProcessConfigDTO $dto, string $id
    ): ProcessConfigResponse {

        $entity = ProcessConfigFactory::fromPrimitives(
            $id,
            $dto->company,
            $dto->loadType,
            $dto->processType,
            $dto->layout,
            $dto->responsible,
        );

        $entity = $this->repository->save($entity);

        return ProcessConfigResponse::create(
            $entity->id()?->value(),
            $entity->company()?->value(),
            $entity->loadType()?->value(),
            $entity->processType()?->value,
            $entity->layout()?->value(),
            $entity->responsible()?->value()
        );
    }
}
