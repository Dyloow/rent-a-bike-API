<?php

use Illuminate\Support\Facades\Route;
Route::apiResource('bikes', App\Http\Controllers\BikeController::class);
Route::apiResource('rents', App\Http\Controllers\RentController::class);