<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\WishlistDepositController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;

Route::get('/', [DashBoardController::class,'index'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('categories', CategoryController::class);
Route::resource('transaction', TransactionController::class);
Route::resource('wishlist', WishlistController::class);
Route::resource('wishlistDeposit', WishlistDepositController::class);
