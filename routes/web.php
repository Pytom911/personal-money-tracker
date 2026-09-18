<?php

use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\WishlistDepositController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashBoardController::class,'index'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics');

Route::resource('categories', CategoryController::class);
Route::resource('transaction', TransactionController::class);
Route::resource('wishlist', WishlistController::class);
Route::resource('wishlistDeposit', WishlistDepositController::class);
