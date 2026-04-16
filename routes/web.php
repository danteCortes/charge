<?php

use App\Src\Infrastructure\Http\Controllers\ImportFileController;
use App\Src\Infrastructure\ProcessConfig\Http\Controllers\ProcessConfigController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/import-file', [ImportFileController::class, 'store']);

Route::post('/process-config', [ProcessConfigController::class, 'store']);
Route::get('/process-config/{id}', [ProcessConfigController::class, 'show']);
Route::put('/process-config/{id}', [ProcessConfigController::class, 'update']);
