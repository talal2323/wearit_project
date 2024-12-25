<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProductApiController;

Route::prefix('products')->group(function () {
    Route::get('/', [ProductApiController::class, 'index']);
    Route::post('/', [ProductApiController::class, 'store']);
    Route::get('/{id}', [ProductApiController::class, 'show']);
    Route::put('/{id}', [ProductApiController::class, 'update']);
    Route::delete('/{id}', [ProductApiController::class, 'destroy']);
    Route::post('/filter', [ProductApiController::class, 'filter']);
});
