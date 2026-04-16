<?php

namespace App\Src\Application\UseCases;

use App\Src\Application\DTOs\ArrayFilesDTO;
use App\Src\Domain\Entities\ImportFile;
use App\Src\Domain\Enums\FileFormat;
use App\Src\Domain\Enums\FileStatus;
use App\Src\Domain\Repositories\ImportFileRepository;
use App\Src\Domain\ValueObjects\FileName;
use App\Src\Domain\ValueObjects\FileSize;
use App\Src\Domain\ValueObjects\StoragePath;

final class StoreImportFilesUseCase
{
    public function __construct(private readonly ImportFileRepository $repository) {}

    public function execute(ArrayFilesDTO $filesDTO): string
    {
        $entities = array_map(function ($dto) {
            return ImportFile::create(
                id: null,
                fileName: FileName::create($dto->fileName),
                fileFormat: FileFormat::fromString($dto->fileFormat),
                fileSize: FileSize::create($dto->fileSize),
                storagePath: StoragePath::create($dto->storagePath),
                decimalSeparator: null,
                fileEncoding: null,
                fileDelimiter: null,
                spreadsheet: null,
                fileStatus: FileStatus::PENDING
            );
        }, $filesDTO->files);

        return $this->repository->store($entities);
    }
}
