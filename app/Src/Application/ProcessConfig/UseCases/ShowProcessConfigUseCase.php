<?php

namespace App\Src\Application\ProcessConfig\UseCases;

use App\Src\Application\ProcessConfig\Responses\ProcessConfigResponse;
use App\Src\Domain\ProcessConfig\Repositories\ProcessConfigRepository;
use App\Src\Domain\ProcessConfig\ValueObjects\ProcessConfigId;
use App\Src\Shared\Exceptions\NotFoundException;

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

        if (! $entity) {
            throw new NotFoundException('Entidad no encontrada.');
        }

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
