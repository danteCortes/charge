<?php

namespace App\Src\Application\ProcessConfig\UseCases;

use App\Src\Application\ProcessConfig\DTOs\ProcessConfigDTO;
use App\Src\Application\ProcessConfig\Responses\ProcessConfigResponse;
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
        ProcessConfigDTO $dto
    ): ProcessConfigResponse {
        $entity = $this->repository->save($dto);

        return ProcessConfigResponse::create(
            $entity->value
        );
    }
}
