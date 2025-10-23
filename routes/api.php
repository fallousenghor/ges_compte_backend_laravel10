<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CompteController;



// Routes d'authentification
Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    // Routes protégées
    Route::middleware('auth:api')->group(function () {
        Route::get('/user', [AuthController::class, 'user']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});

// Routes pour les comptes (protégées)
Route::middleware('auth:api')->prefix('comptes')->group(function () {
    Route::apiResource('/', CompteController::class)->parameters(['' => 'id']);

    Route::group(['prefix' => 'filter'], function () {
        Route::get('/type/{type}', [CompteController::class, 'getByType'])->name('comptes.by-type');
        Route::get('/status/{status}', [CompteController::class, 'getByStatus'])->name('comptes.by-status');
    });

    Route::get('/search/{query}', [CompteController::class, 'search'])->name('comptes.search');
});
