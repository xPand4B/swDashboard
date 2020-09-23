<?php

use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Route;

Route::get(
    '', [AppController::class, 'index']
)->name('app.index');

Route::get(
    'test', [AppController::class, 'test']
)->name('app.test');
