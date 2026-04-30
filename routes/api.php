<?php

use App\Src\Infrastructure\Company\Http\Controllers\CompanyController;
use App\Src\Infrastructure\Layout\Http\Controllers\LayoutController;
use App\Src\Infrastructure\LoadType\Http\Controllers\LoadTypeController;
use App\Src\Infrastructure\ProcessConfig\Http\Controllers\ProcessConfigController;
use App\Src\Infrastructure\SystemField\Http\Controllers\SystemFieldController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'process'], function () {
    Route::post('/', [ProcessConfigController::class, 'store']);
    Route::get('/list', [ProcessConfigController::class, 'list']);
    Route::get('/{id}', [ProcessConfigController::class, 'show']);
    Route::put('/{id}', [ProcessConfigController::class, 'update']);
    Route::get('/{id}/files', [ProcessConfigController::class, 'files']);
});

Route::get('/company', [CompanyController::class, 'index']);
Route::get('/layout', [LayoutController::class, 'index']);
Route::get('/load-type', [LoadTypeController::class, 'index']);
Route::get('/system-field', [SystemFieldController::class, 'index']);
