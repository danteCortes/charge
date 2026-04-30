<?php

use App\Jobs\ValidateFileJob;
use App\Src\Infrastructure\ColumnAssignment\Http\Controllers\ColumnAssignmentController;
use App\Src\Infrastructure\ImportFile\Http\Controllers\ImportFileController;
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

Route::post('/column-assignment', [ColumnAssignmentController::class, 'store']);
Route::put('/column-assignment/{id}', [ColumnAssignmentController::class, 'update']);

Route::get('/job', function () {
    ValidateFileJob::dispatch('69eaf59ff8eb1509a6048872');
});
