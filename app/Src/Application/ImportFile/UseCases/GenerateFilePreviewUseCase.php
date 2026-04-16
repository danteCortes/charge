<?php

namespace App\Src\Application\ImportFile\UseCases;

use App\Src\Application\ImportFile\Responses\FilePreviewResponse;
use App\Src\Application\ImportFile\Services\FilePreviewGeneratorResolver;
use App\Src\Domain\ImportFile\Repositories\ImportFileRepository;
use App\Src\Domain\ImportFile\ValueObjects\FileId;

class GenerateFilePreviewUseCase
{
    public function __construct(
        private ImportFileRepository $repository,
        private FilePreviewGeneratorResolver $resolver,
    ) {}

    public function execute(string $fileId): FilePreviewResponse
    {
        $file = $this->repository->findById(FileId::create($fileId));

        if (! $file) {
            throw new \RuntimeException('File not found');
        }

        $generator = $this->resolver->resolve($file->fileFormat());

        $preview = $generator->preview($file);

        return FilePreviewResponse::fromDomain($preview);
    }
}
