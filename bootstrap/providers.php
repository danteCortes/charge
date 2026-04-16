<?php

use App\Providers\AppServiceProvider;
use App\Src\Infrastructure\ImportFile\Providers\ChargeServiceProvider;
use App\Src\Infrastructure\ProcessConfig\Providers\ProcessConfigServiceProvider;
use MongoDB\Laravel\MongoDBServiceProvider;

return [
    AppServiceProvider::class,
    MongoDBServiceProvider::class,
    ChargeServiceProvider::class,
    ProcessConfigServiceProvider::class,
];
