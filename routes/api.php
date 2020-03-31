<?php

use App\Http\Controllers\Api\swCommentController;
use App\Http\Controllers\Api\swDirectoryController;
use App\Http\Controllers\Api\swPHPSwitchController;
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

Route::prefix('/phpversion')->group(function() {
    Route::get(
        '/', [swPHPSwitchController::class, 'index']
    )->name('api.version.php.index');

    Route::post(
        '/', [swPHPSwitchController::class, 'switch']
    )->name('api.version.php.switch');
});

Route::prefix('/comment')->group(function() {
    Route::post(
        '/{version}', [swCommentController::class, 'store']
    )->name('api.comment.store');

   Route::get(
       '/{version}', [swCommentController::class, 'show']
   )->name('api.comment.show');

    Route::post(
        '/{version}/delete', [swCommentController::class, 'destroy']
    )->name('api.comment.destroy');
});
