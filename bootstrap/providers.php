<?php

use App\Providers\AppServiceProvider;
use App\Src\Infrastructure\ProcessConfig\Providers\ProcessConfigServiceProvider;
use App\Src\Infrastructure\Providers\ChargeServiceProvider;
use MongoDB\Laravel\MongoDBServiceProvider;

return [
    AppServiceProvider::class,
    MongoDBServiceProvider::class,
    ChargeServiceProvider::class,
    ProcessConfigServiceProvider::class,
];
