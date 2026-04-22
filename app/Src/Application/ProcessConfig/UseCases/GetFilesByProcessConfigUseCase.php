<?php

namespace App\Src\Application\ProcessConfig\UseCases;

use App\Src\Application\ImportFile\Responses\ImportFileResponse;
use App\Src\Application\ImportFile\Responses\ListImportFilesResponse;
use App\Src\Domain\ProcessConfig\Repositories\ProcessConfigRepository;
use App\Src\Domain\ProcessConfig\ValueObjects\ProcessConfigId;

class GetFilesByProcessConfigUseCase
{
    private function __construct(
        private readonly ProcessConfigRepository $repository,
    ) {}

    public static function create(ProcessConfigRepository $repository): self
    {
        return new self($repository);
    }

    public function execute(string $id): ListImportFilesResponse
    {
        $importFiles = $this->repository->files(ProcessConfigId::create($id));

        $listImportFilesResponse = [];
        foreach ($importFiles as $file) {
            $listImportFilesResponse[] = ImportFileResponse::create(
                $file->id()?->value(),
                $file->fileName()->value(),
                $file->fileFormat()->value,
                $file->fileSize()->value(),
                $file->storagePath()->value(),
                $file->decimalSeparator()?->value,
                $file->fileEncoding()?->value,
                $file->fileDelimiter()?->value,
                $file->spreadsheet()?->value(),
                $file->processConfig()->value(),
                $file->isFirstRowHeaders(),
                $file->key()?->value(),
                $file->position()?->value(),
                $file->validRows()->value(),
                $file->duplicatedRows()->value(),
                $file->errorRows()->value(),
            );
        }

        return ListImportFilesResponse::create($listImportFilesResponse);
    }
}
