<?php

namespace App\Src\Infrastructure\Country\Providers;

use App\Src\Application\Country\UseCases\GetCompaniesByCountryIdUseCase;
use App\Src\Application\Country\UseCases\ListCountriesUseCase;
use App\Src\Domain\Country\Repositories\CountryRepository;
use App\Src\Infrastructure\Country\Persistence\Implements\MongoDBCountryRepository;
use Illuminate\Support\ServiceProvider;

class CountryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(CountryRepository::class, MongoDBCountryRepository::class);
        $this->app->bind(ListCountriesUseCase::class, function ($app) {
            return ListCountriesUseCase::create($app->make(CountryRepository::class));
        });
        $this->app->bind(GetCompaniesByCountryIdUseCase::class, function ($app) {
            return GetCompaniesByCountryIdUseCase::create($app->make(CountryRepository::class));
        });
    }

    public function boot(): void {}
}
