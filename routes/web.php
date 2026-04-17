<?php

use App\Src\Infrastructure\Company\Http\Controllers\CompanyController;
use App\Src\Infrastructure\ImportFile\Http\Controllers\ImportFileController;
use App\Src\Infrastructure\Layout\Http\Controllers\LayoutController;
use App\Src\Infrastructure\ProcessConfig\Http\Controllers\ProcessConfigController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/import-file', [ImportFileController::class, 'store']);
Route::put('/import-file/{id}', [ImportFileController::class, 'update']);
Route::get('/import-file/{id}/preview', [ImportFileController::class, 'preview']);

Route::post('/process-config', [ProcessConfigController::class, 'store']);
Route::get('/process-config/{id}', [ProcessConfigController::class, 'show']);
Route::put('/process-config/{id}', [ProcessConfigController::class, 'update']);

Route::get('/company', [CompanyController::class, 'index']);
Route::get('/layout', [LayoutController::class, 'index']);
