<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientGroupController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\PaymentTermController;
use App\Http\Controllers\SalesRepController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('me', [AuthController::class, 'me']);
    Route::post('logout', [AuthController::class, 'logout']);

    Route::apiResource('clients', ClientController::class);
    Route::apiResource('countries', CountryController::class)->only(['index']);
    Route::apiResource('client-groups', ClientGroupController::class)->only(['index']);
    Route::apiResource('payment-terms', PaymentTermController::class)->only(['index']);
    Route::apiResource('sales-reps', SalesRepController::class)->only(['index']);
});
