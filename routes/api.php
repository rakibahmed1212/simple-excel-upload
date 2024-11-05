<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FindRiderController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('set-rider-location', [FindRiderController::class, 'setRiderLocation']);
Route::post('get-nearest-rider', [FindRiderController::class, 'getNearestRider']);
