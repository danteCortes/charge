<?php

namespace App\Src\Application\ImportFile\UseCases;

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

    public function execute(string $id): void
    {

        $this->repository->delete(FileId::create($id));
    }
}
