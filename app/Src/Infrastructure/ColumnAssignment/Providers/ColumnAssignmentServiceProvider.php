<?php

namespace App\Src\Infrastructure\ColumnAssignment\Providers;

use App\Src\Application\ColumnAssignment\UseCases\SaveColumnAssignmentUseCase;
use App\Src\Application\ColumnAssignment\UseCases\UpdateColumnAssignmentUseCase;
use App\Src\Domain\ColumnAssignment\Repositories\ColumnAssignmentRepository;
use App\Src\Infrastructure\ColumnAssignment\Persistence\Implements\MongoDBColumnAssignmentRepository;
use Illuminate\Support\ServiceProvider;

class ColumnAssignmentServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ColumnAssignmentRepository::class, MongoDBColumnAssignmentRepository::class);
        $this->app->bind(SaveColumnAssignmentUseCase::class, function ($app) {
            return SaveColumnAssignmentUseCase::create($app->make(ColumnAssignmentRepository::class));
        });
        $this->app->bind(UpdateColumnAssignmentUseCase::class, function ($app) {
            return UpdateColumnAssignmentUseCase::create($app->make(ColumnAssignmentRepository::class));
        });
    }

    public function boot(): void {}
}
