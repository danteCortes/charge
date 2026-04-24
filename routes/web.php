<?php

use App\Src\Infrastructure\ColumnAssignment\Http\Controllers\ColumnAssignmentController;
use App\Src\Infrastructure\Company\Http\Controllers\CompanyController;
use App\Src\Infrastructure\ImportFile\Http\Controllers\ImportFileController;
use App\Src\Infrastructure\Layout\Http\Controllers\LayoutController;
use App\Src\Infrastructure\LoadType\Http\Controllers\LoadTypeController;
use App\Src\Infrastructure\ProcessConfig\Http\Controllers\ProcessConfigController;
use App\Src\Infrastructure\SystemField\Http\Controllers\SystemFieldController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/import-file', [ImportFileController::class, 'store']);
Route::put('/import-file/{id}', [ImportFileController::class, 'update']);
Route::get('/import-file/{id}/preview', [ImportFileController::class, 'preview']);
Route::delete('/import-file/{id}', [ImportFileController::class, 'delete']);
Route::get('/import-file/{id}/spreadsheets', [ImportFileController::class, 'spreadsheets']);
Route::get('/import-file/{id}/column-assignments', [ImportFileController::class, 'columnAssignments']);
Route::post('/import-file/chunk', [ImportFileController::class, 'receiveChunk']);
Route::post('/import-file/complete', [ImportFileController::class, 'completeUpload']);

Route::post('/process-config', [ProcessConfigController::class, 'store']);
Route::get('/process-config/{id}', [ProcessConfigController::class, 'show']);
Route::put('/process-config/{id}', [ProcessConfigController::class, 'update']);
Route::get('/process-config/{id}/files', [ProcessConfigController::class, 'files']);

Route::get('/company', [CompanyController::class, 'index']);
Route::get('/layout', [LayoutController::class, 'index']);
Route::get('/load-type', [LoadTypeController::class, 'index']);
Route::get('/system-field', [SystemFieldController::class, 'index']);

Route::post('/column-assignment', [ColumnAssignmentController::class, 'store']);
Route::put('/column-assignment/{id}', [ColumnAssignmentController::class, 'update']);
