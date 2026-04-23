<?php

namespace App\Src\Application\ImportFile\UseCases;

use App\Src\Application\ImportFile\Responses\ColumnAssignmentResponse;
use App\Src\Domain\ImportFile\Repositories\ImportFileRepository;
use App\Src\Domain\ImportFile\ValueObjects\FileId;

class GetColumnAssignmentByImportFileUseCase
{
    private function __construct(
        private readonly ImportFileRepository $repository,
    ) {}

    public static function create(ImportFileRepository $repository): self
    {
        return new self($repository);
    }

    /**
     * @return ColumnAssignmentResponse[]
     */
    public function execute(string $id): array
    {

        $entities = $this->repository->getColumnAssignmentsByImportFile(FileId::create($id));

        $response = [];
        foreach ($entities as $entity) {
            $response[] = ColumnAssignmentResponse::create(
                $entity->id()?->value(),
                $entity->importFileId()->value(),
                $entity->columnName()->value(),
                $entity->systemFieldId()->value(),
            );
        }

        return $response;
    }
}
