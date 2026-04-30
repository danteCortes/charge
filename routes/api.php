<?php

use App\Src\Infrastructure\ProcessConfig\Http\Controllers\ProcessConfigController;
use Illuminate\Support\Facades\Route;

Route::get('process/list', [ProcessConfigController::class, 'list']);
