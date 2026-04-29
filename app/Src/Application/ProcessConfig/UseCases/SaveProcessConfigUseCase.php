<?php

namespace App\Src\Application\ProcessConfig\UseCases;

use App\Src\Application\ProcessConfig\DTOs\ProcessConfigDTO;
use App\Src\Application\ProcessConfig\Responses\ProcessConfigResponse;
use App\Src\Domain\ProcessConfig\Factories\ProcessConfigFactory;
use App\Src\Domain\ProcessConfig\Repositories\ProcessConfigRepository;

class SaveProcessConfigUseCase
{
    private function __construct(
        private readonly ProcessConfigRepository $repository,
    ) {}

    public static function create(ProcessConfigRepository $repository): self
    {
        return new self($repository);
    }

    public function execute(
        ProcessConfigDTO $dto
    ): ProcessConfigResponse {

        $entity = $this->repository->save(ProcessConfigFactory::fromPrimitives(
            null,
            $dto->company,
            $dto->loadType,
            $dto->layout,
            $dto->responsible,
            $dto->templateName,
            null,
            0,
            'Pendiente',
        ));

        return ProcessConfigResponse::create(
            $entity->id()?->value(),
            $entity->company()?->value(),
            $entity->loadType()?->value(),
            $entity->layout()?->value(),
            $entity->responsible()?->value(),
            $entity->templateName()?->value(),
            $entity->startdate()?->value(),
            $entity->records()->value(),
            $entity->status()?->value,
        );
    }
}
