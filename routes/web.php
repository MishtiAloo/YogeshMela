<?php

use App\Http\Controllers\BuyerDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\SellerDashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/listings', [ListingController::class, 'index'])->name('listings.index');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

// Auth routes (login/logout)
Route::middleware(['web'])->group(function () {
    Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [UserController::class, 'login'])
        ->withoutMiddleware([VerifyCsrfToken::class])->name('login');
    Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [UserController::class, 'store'])
        ->withoutMiddleware([VerifyCsrfToken::class])->name('register');
    Route::post('/users/logout', [UserController::class, 'logout'])
        ->withoutMiddleware([VerifyCsrfToken::class])->name('logout');
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

Route::get('/seller/listings/create', [ListingController::class, 'showCreateListing'])
    ->middleware(['auth', 'role:seller'])
    ->name('seller.listings.create');

Route::post('/seller/listings', [ListingController::class, 'store'])
    ->middleware(['auth', 'role:seller'])
    ->name('seller.listings.store');

Route::get('/seller/listings/{listing}/edit', [ListingController::class, 'showEditListing'])
    ->middleware(['auth', 'role:seller'])
    ->name('seller.listings.edit');

Route::put('/seller/listings/{listing}', [ListingController::class, 'update'])
    ->middleware(['auth', 'role:seller'])
    ->name('seller.listings.update');

Route::delete('/seller/listings/{listing}', [ListingController::class, 'destroy'])
    ->middleware(['auth', 'role:seller'])
    ->name('seller.listings.destroy');

Route::get('/users/{user}/trackorder', [UserController::class, 'trackOrder'])
    ->middleware(['auth'])
    ->name('users.trackorder');

Route::get('/admin/listings/filter', [AdminDashboardController::class, 'filterListings'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.listings.filter');

// Health check
Route::get('/ping', fn () => response()->json(['message' => 'pong']));
