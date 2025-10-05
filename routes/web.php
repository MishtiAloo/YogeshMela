<?php

use App\Http\Controllers\BuyerDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\SellerDashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Auth routes (login/logout)
Route::middleware(['web'])->group(function () {
    Route::post('/users/login', [UserController::class, 'login'])
        ->withoutMiddleware([VerifyCsrfToken::class]);
    Route::post('/users/logout', [UserController::class, 'logout'])
        ->withoutMiddleware([VerifyCsrfToken::class]);
});

Route::get('/admin/dashboard', [AdminDashboardController::class, 'dashboard'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.dashboard');

Route::get('/buyer/dashboard', [BuyerDashboardController::class, 'dashboard'])
    ->middleware(['auth', 'role:buyer'])
    ->name('buyer.dashboard');

Route::get('/seller/dashboard', [SellerDashboardController::class, 'dashboard'])
    ->middleware(['auth', 'role:seller'])
    ->name('seller.dashboard');

Route::get('/users/{user}/trackorder', [UserController::class, 'trackOrder'])
    ->middleware(['auth'])  
    ->name('users.trackorder');

Route::get('/admin/listings/filter', [AdminDashboardController::class, 'filterListings'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.listings.filter');

// Health check
Route::get('/ping', fn () => response()->json(['message' => 'pong']));
