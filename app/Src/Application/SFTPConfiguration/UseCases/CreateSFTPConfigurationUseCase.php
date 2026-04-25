<?php

namespace App\Src\Application\SFTPConfiguration\UseCases;

use App\Src\Domain\SFTPConfiguration\Factories\SFTPConfigurationFactory;
use App\Src\Domain\SFTPConfiguration\Repositories\SFTPConfigurationRepository;
use App\Src\Application\SFTPConfiguration\DTOs\SFTPConfigurationDTO;
use App\Src\Application\SFTPConfiguration\Responses\SFTPConfigurationResponse;

class CreateSFTPConfigurationUseCase
{
    private function __construct(
        private readonly SFTPConfigurationRepository $repository,
    ) {}

    public static function create(SFTPConfigurationRepository $repository): self
    {
        return new self($repository);
    }

    public function execute(
        SFTPConfigurationDTO $dto
    ): SFTPConfigurationResponse {
        $entity = $this->repository->save(SFTPConfigurationFactory::fromPrimitives(
            null,
            $dto->process_config_id,
            $dto->hostname,
            $dto->port,
            $dto->user,
            $dto->password,
            $dto->directory_path,
        ));

        return SFTPConfigurationResponse::create(
            $entity->id()?->value(),
            $entity->processConfigId()->value(),
            $entity->hostname()->value(),
            $entity->port()->value(),
            $entity->user()->value(),
            $entity->password()->value(),
            $entity->directoryPath()->value(),
        );
    }
}
