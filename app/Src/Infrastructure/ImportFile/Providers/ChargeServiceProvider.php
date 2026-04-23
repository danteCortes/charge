<?php

namespace App\Src\Infrastructure\ImportFile\Providers;

use App\Src\Application\ImportFile\Services\FilePreviewGeneratorResolver;
use App\Src\Application\ImportFile\UseCases\DeleteImportFileUseCase;
use App\Src\Application\ImportFile\UseCases\GetColumnAssignmentByImportFileUseCase;
use App\Src\Domain\ImportFile\Repositories\ImportFileRepository;
use App\Src\Infrastructure\ImportFile\Persistence\Implements\CsvPreviewGenerator;
use App\Src\Infrastructure\ImportFile\Persistence\Implements\XlsxPreviewGenerator;
use App\Src\Infrastructure\ImportFile\Persistence\MongoDB\MongoDBImportFileRepository;
use Illuminate\Support\ServiceProvider;

class ChargeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ImportFileRepository::class, MongoDBImportFileRepository::class);
        $this->app->singleton(FilePreviewGeneratorResolver::class, function () {
            return new FilePreviewGeneratorResolver([
                new CsvPreviewGenerator,
                new XlsxPreviewGenerator,
                // new JsonPreviewGenerator(),
                // new XmlPreviewGenerator(),
            ]);
        });
        $this->app->bind(DeleteImportFileUseCase::class, function ($app) {
            return DeleteImportFileUseCase::create($app->make(ImportFileRepository::class));
        });
        $this->app->bind(GetColumnAssignmentByImportFileUseCase::class, function ($app) {
            return GetColumnAssignmentByImportFileUseCase::create($app->make(ImportFileRepository::class));
        });
    }
}
