<?php

namespace App\Src\Infrastructure\SystemField\Providers;

use App\Src\Application\SystemField\UseCases\ListSystemFieldsUseCase;
use App\Src\Domain\SystemField\Repositories\SystemFieldRepository;
use App\Src\Infrastructure\SystemField\Persistence\Implements\MongoDBSystemFieldRepository;
use Illuminate\Support\ServiceProvider;

class SystemFieldServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(SystemFieldRepository::class, MongoDBSystemFieldRepository::class);
        $this->app->bind(ListSystemFieldsUseCase::class, function ($app) {
            return ListSystemFieldsUseCase::create($app->make(SystemFieldRepository::class));
        });
    }

    public function boot(): void {}
}
