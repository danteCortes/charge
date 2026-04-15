<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/import-file', [App\Src\Infrastructure\Http\Controllers\ImportFileController::class, 'store']);