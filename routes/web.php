<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return view('dashboard');
});
Route::resource('categories', CategoryController::class);
Route::resource('transaction', TransactionController::class);
