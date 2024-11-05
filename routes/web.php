<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [CustomerController::class, 'index']);
Route::get('/stored-procedure', [CustomerController::class, 'getCustomerCounts'])->name('getCustomerCounts');
Route::post('/import', [CustomerController::class, 'import'])->name('import');

