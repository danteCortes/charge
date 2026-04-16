<?php

namespace App\Src\Infrastructure\ImportFile\Providers;

use App\Src\Domain\ImportFile\Repositories\ImportFileRepository;
use App\Src\Infrastructure\ImportFile\Persistence\MongoDB\MongoDBImportFileRepository;
use Illuminate\Support\ServiceProvider;

class ChargeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ImportFileRepository::class, MongoDBImportFileRepository::class);
    }
}
