<?php

namespace App\Src\Application\ImportFile\UseCases;

use App\Src\Application\ImportFile\Responses\ImportFileResponse;
use App\Src\Domain\ImportFile\Repositories\ImportFileRepository;
use App\Src\Domain\ImportFile\ValueObjects\FileId;

class DeleteImportFileUseCase
{
    private function __construct(
        private readonly ImportFileRepository $repository,
    ) {}

    public static function create(ImportFileRepository $repository): self
    {
        return new self($repository);
    }

    public function execute(string $id): ImportFileResponse
    {
        $entity = $this->repository->delete(FileId::create($id));

        return ImportFileResponse::create(
            $entity->id()?->value(),
            $entity->fileName()->value(),
            $entity->fileFormat()->value,
            $entity->fileSize()->value(),
            $entity->storagePath()->value(),
            $entity->decimalSeparator()?->value,
            $entity->fileEncoding()?->value,
            $entity->fileDelimiter()?->value,
            $entity->spreadsheet()?->value(),
            $entity->processConfig()->value(),
            $entity->isFirstRowHeaders(),
            $entity->key()?->value(),
            $entity->position()?->value(),
            $entity->validRows()->value(),
            $entity->duplicatedRows()->value(),
            $entity->errorRows()->value(),
        );
    }
}
