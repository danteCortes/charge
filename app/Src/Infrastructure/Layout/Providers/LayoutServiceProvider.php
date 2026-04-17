<?php

namespace App\Src\Infrastructure\Layout\Providers;

use App\Src\Application\Layout\UseCases\ListLayoutsUseCase;
use App\Src\Domain\Layout\Repositories\LayoutRepository;
use App\Src\Infrastructure\Layout\Persistence\Implements\MongoDBLayoutRepository;
use Illuminate\Support\ServiceProvider;

class LayoutServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(LayoutRepository::class, MongoDBLayoutRepository::class);
        $this->app->bind(ListLayoutsUseCase::class, function ($app) {
            return ListLayoutsUseCase::create($app->make(LayoutRepository::class));
        });
    }

    public function boot(): void {}
}
