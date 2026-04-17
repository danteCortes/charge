<?php

namespace App\Src\Infrastructure\LoadType\Providers;

use App\Src\Application\LoadType\UseCases\ListLoadTypesUseCase;
use App\Src\Domain\LoadType\Repositories\LoadTypeRepository;
use App\Src\Infrastructure\LoadType\Persistence\Implements\MongoDBLoadTypeRepository;
use Illuminate\Support\ServiceProvider;

class LoadTypeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(LoadTypeRepository::class, MongoDBLoadTypeRepository::class);
        $this->app->bind(ListLoadTypesUseCase::class, function ($app) {
            return ListLoadTypesUseCase::create($app->make(LoadTypeRepository::class));
        });
    }

    public function boot(): void {}
}
