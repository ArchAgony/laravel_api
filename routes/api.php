<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CityController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// authentication
Route::post('/auth/register', [AuthenticationController::class, 'register']);
Route::post('/auth/login', [AuthenticationController::class, 'login']);
Route::post('/auth/logout', [AuthenticationController::class, 'logout']);

// city
Route::post('/city', [CityController::class, 'create']);
