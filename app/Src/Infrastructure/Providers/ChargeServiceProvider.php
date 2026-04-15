<?php

namespace App\Src\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;

class ChargeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(\App\Src\Domain\Repositories\ImportFileRepository::class, \App\Src\Infrastructure\Persistence\MongoDB\MongoDBImportFileRepository::class);
    }
}