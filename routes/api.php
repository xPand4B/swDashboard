<?php

use App\Http\Controllers\Api\swDirectoryController;
use App\Http\Controllers\Api\swVersionController;
use Illuminate\Support\Facades\Route;

Route::prefix('/version')->group(function() {
    Route::get(
        '/{major}', [swVersionController::class, 'index']
    )->name('api.version.index');
});

Route::prefix('/directory')->group(function() {
    Route::get(
        '/', [swDirectoryController::class, 'index']
    )->name('api.directory.index');

    Route::post(
        '/', [swDirectoryController::class, 'store']
    )->name('api.directory.store');

    Route::post(
        '/delete', [swDirectoryController::class, 'destroy']
    )->name('api.directory.destroy');
});

