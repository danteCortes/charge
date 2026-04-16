<?php

namespace App\Src\Application\ImportFile\UseCases;

use App\Src\Application\ImportFile\DTOs\ImportFileDTO;
use App\Src\Application\ImportFile\Responses\ImportFileResponse;
use App\Src\Domain\ImportFile\Factories\ImportFileFactory;
use App\Src\Domain\ImportFile\Repositories\ImportFileRepository;

final class StoreImportFilesUseCase
{
    public function __construct(private readonly ImportFileRepository $repository) {}

    public function execute(ImportFileDTO $dto): ImportFileResponse
    {
        $entity = ImportFileFactory::fromPrimitives(
            null,
            $dto->fileName,
            $dto->fileFormat,
            $dto->fileSize,
            $dto->storagePath,
            null,
            null,
            null,
            null,
            'Pendiente',
            $dto->processConfig,
            true
        );

        $entity = $this->repository->store($entity);

        return ImportFileResponse::create(
            $entity->id()?->value(),
            $entity->fileName()->value(),
            $entity->fileFormat()->value,
            $entity->fileSize()->value(),
            $entity->storagePath()->value(),
            $entity->processConfig()->value(),
            $entity->decimalSeparator()?->value,
            $entity->fileEncoding()?->value,
            $entity->fileDelimiter()?->value,
            $entity->spreadsheet()?->value(),
            $entity->isFirstRowHeaders(),
            $entity->fileStatus()->value,
        );
    }
}
