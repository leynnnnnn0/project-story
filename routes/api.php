<?php

use App\Http\Controllers\Api\StoreOrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Route::post('/store-order/header-upload', [StoreOrderController::class, 'validateHeaderUpload']);
});
