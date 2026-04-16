<?php

namespace App\Src\Infrastructure\Providers;

use App\Src\Domain\Repositories\ImportFileRepository;
use App\Src\Infrastructure\Persistence\MongoDB\MongoDBImportFileRepository;
use Illuminate\Support\ServiceProvider;

class ChargeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ImportFileRepository::class, MongoDBImportFileRepository::class);
    }
}
