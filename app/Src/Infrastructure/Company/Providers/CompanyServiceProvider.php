<?php

namespace App\Src\Infrastructure\Company\Providers;

use App\Src\Application\Company\UseCases\ListCompanyUseCase;
use App\Src\Domain\Company\Repositories\CompanyRepository;
use App\Src\Infrastructure\Company\Persistence\Implements\MongoDBCompanyRepository;
use Illuminate\Support\ServiceProvider;

class CompanyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(CompanyRepository::class, MongoDBCompanyRepository::class);
        $this->app->bind(ListCompanyUseCase::class, function ($app) {
            return ListCompanyUseCase::create($app->make(CompanyRepository::class));
        });
    }

    public function boot(): void {}
}
