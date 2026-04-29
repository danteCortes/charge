<?php

namespace App\Src\Application\ProcessConfig\UseCases;

use App\Src\Application\ProcessConfig\DTOs\ProcessConfigDTO;
use App\Src\Application\ProcessConfig\Responses\ProcessConfigResponse;
use App\Src\Domain\ProcessConfig\Factories\ProcessConfigFactory;
use App\Src\Domain\ProcessConfig\Repositories\ProcessConfigRepository;
use App\Src\Domain\ProcessConfig\ValueObjects\ProcessConfigId;
use App\Src\Shared\Exceptions\NotFoundException;

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

        $processConfig = $this->repository->findById(ProcessConfigId::create($id));
        if (! $processConfig) {
            throw new NotFoundException("No se encuentra la entidad proceso con el id: $id.");
        }

        $entity = $this->repository->save(ProcessConfigFactory::fromPrimitives(
            $id,
            $dto->company,
            $dto->loadType,
            $dto->layout,
            $dto->responsible,
            $dto->templateName,
            $processConfig->startDate()?->value(),
            $processConfig->records()->value(),
            $processConfig->status()->value,
        ));

        return ProcessConfigResponse::create(
            $entity->id()?->value(),
            $entity->company()?->value(),
            $entity->loadType()?->value(),
            $entity->layout()?->value(),
            $entity->responsible()?->value(),
            $entity->templateName()?->value(),
            $entity->startDate()?->value(),
            $entity->records()->value(),
            $entity->status()->value,
        );
    }
}
