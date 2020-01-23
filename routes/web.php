<?php

use App\Http\Controllers\swManagementController;
use Illuminate\Support\Facades\Route;

Route::get(
    '/', [swManagementController::class, 'index']
)->name('home');

Route::post(
    '/add', [swManagementController::class, 'store']
)->name('shop.store');

Route::delete(
    '/delete/{name}', [swManagementController::class, 'destroy']
)->name('shop.destroy');
