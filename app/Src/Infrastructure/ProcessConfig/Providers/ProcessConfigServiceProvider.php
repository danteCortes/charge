<?php

namespace App\Src\Infrastructure\ProcessConfig\Providers;

use App\Src\Application\ProcessConfig\UseCases\SaveProcessConfigUseCase;
use App\Src\Application\ProcessConfig\UseCases\ShowProcessConfigUseCase;
use App\Src\Domain\ProcessConfig\Repositories\ProcessConfigRepository;
use App\Src\Infrastructure\ProcessConfig\Persistence\Implements\MongoDBProcessConfigRepository;
use Illuminate\Support\ServiceProvider;

class ProcessConfigServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ProcessConfigRepository::class, MongoDBProcessConfigRepository::class);
        $this->app->bind(SaveProcessConfigUseCase::class, function ($app) {
            return SaveProcessConfigUseCase::create($app->make(ProcessConfigRepository::class));
        });
        $this->app->bind(ShowProcessConfigUseCase::class, function ($app) {
            return ShowProcessConfigUseCase::create($app->make(ProcessConfigRepository::class));
        });
    }

    public function boot(): void {}
}
