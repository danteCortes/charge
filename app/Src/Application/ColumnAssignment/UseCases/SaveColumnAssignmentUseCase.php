<?php

namespace App\Src\Application\ColumnAssignment\UseCases;

use App\Src\Application\ColumnAssignment\DTOs\ColumnAssignmentDTO;
use App\Src\Application\ColumnAssignment\Responses\ColumnAssignmentResponse;
use App\Src\Domain\ColumnAssignment\Factories\ColumnAssignmentFactory;
use App\Src\Domain\ColumnAssignment\Repositories\ColumnAssignmentRepository;

class SaveColumnAssignmentUseCase
{
    private function __construct(
        private readonly ColumnAssignmentRepository $repository,
    ) {}

    public static function create(ColumnAssignmentRepository $repository): self
    {
        return new self($repository);
    }

    public function execute(
        ColumnAssignmentDTO $dto
    ): ColumnAssignmentResponse {
        $entity = $this->repository->save(ColumnAssignmentFactory::fromPrimitives(
            null,
            $dto->importFileId,
            $dto->columnName,
            $dto->systemFieldId,
        ));

        return ColumnAssignmentResponse::create(
            $entity->id()?->value(),
            $entity->importFileId()->value(),
            $entity->columnName()->value(),
            $entity->systemFieldId()->value(),
        );
    }
}
