<?php

use App\Helper\swVersionHelper;
use App\Http\Controllers\Api\swCacheController;
use App\Http\Controllers\Api\swCommentController;
use App\Http\Controllers\Api\swDirectoryController;
use App\Http\Controllers\Api\swPHPSwitchController;
use App\Http\Controllers\Api\swVersionController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Cache
|--------------------------------------------------------------------------
*/
Route::prefix('/cache')->group(function() {
    Route::get(
        '/clear', [swCacheController::class, 'clear']
    )->name('api.cache.clear');

    Route::get(
        '/regenerate', [swCacheController::class, 'regenerate']
    )->name('api.cache.regenerate');
});

/*
|--------------------------------------------------------------------------
| Versions
|--------------------------------------------------------------------------
*/
Route::prefix('/version')->group(function() {
    Route::get(
        '/{major}', [swVersionController::class, 'index']
    )->name('api.version.index');
});

/*
|--------------------------------------------------------------------------
| Directories
|--------------------------------------------------------------------------
*/
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

/*
|--------------------------------------------------------------------------
| PHP-Version
|--------------------------------------------------------------------------
*/
Route::prefix('/phpversion')->group(function() {
    Route::get(
        '/', [swPHPSwitchController::class, 'index']
    )->name('api.version.php.index');

    Route::post(
        '/', [swPHPSwitchController::class, 'switch']
    )->name('api.version.php.switch');
});

/*
|--------------------------------------------------------------------------
| Comments
|--------------------------------------------------------------------------
*/
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
