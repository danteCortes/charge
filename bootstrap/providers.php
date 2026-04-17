<?php

use App\Providers\AppServiceProvider;
use App\Src\Infrastructure\Company\Providers\CompanyServiceProvider;
use App\Src\Infrastructure\ImportFile\Providers\ChargeServiceProvider;
use App\Src\Infrastructure\Layout\Providers\LayoutServiceProvider;
use App\Src\Infrastructure\LoadType\Providers\LoadTypeServiceProvider;
use App\Src\Infrastructure\ProcessConfig\Providers\ProcessConfigServiceProvider;
use App\Src\Infrastructure\SystemField\Providers\SystemFieldServiceProvider;
use MongoDB\Laravel\MongoDBServiceProvider;

return [
    AppServiceProvider::class,
    MongoDBServiceProvider::class,
    ChargeServiceProvider::class,
    ProcessConfigServiceProvider::class,
    CompanyServiceProvider::class,
    LayoutServiceProvider::class,
    LoadTypeServiceProvider::class,
    SystemFieldServiceProvider::class,
];
