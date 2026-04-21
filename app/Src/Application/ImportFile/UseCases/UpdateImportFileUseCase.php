<?php

namespace App\Src\Application\ImportFile\UseCases;

use App\Src\Application\ImportFile\DTOs\ImportFileDTO;
use App\Src\Application\ImportFile\Responses\ImportFileResponse;
use App\Src\Domain\ImportFile\Factories\ImportFileFactory;
use App\Src\Domain\ImportFile\Repositories\ImportFileRepository;

final class UpdateImportFileUseCase
{
    public function __construct(private readonly ImportFileRepository $repository) {}

    public function execute(ImportFileDTO $dto, string $id): ImportFileResponse
    {
        $entity = ImportFileFactory::fromPrimitives(
            $id,
            $dto->fileName,
            $dto->fileFormat,
            $dto->fileSize,
            $dto->storagePath,
            $dto->decimalSeparator,
            $dto->fileEncoding,
            $dto->fileDelimiter,
            $dto->spreadsheet,
            $dto->processConfig,
            $dto->firstRowHeaders,
            $dto->key,
            $dto->position,
            $dto->validRows,
            $dto->duplicatedRows,
            $dto->errorRows,
        );

        $entity = $this->repository->store($entity);

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
