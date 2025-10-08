<?php

use App\Http\Controllers\BuyerDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\SellerDashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PromotionController;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/listings', [ListingController::class, 'index'])->name('listings.index');
Route::get('/listings/{listing}', [ListingController::class, 'show'])->name('listings.show');
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

Route::get('/seller/promotions/{listing}/attach', [PromotionController::class, 'showAttachForm'])
    ->middleware(['auth', 'role:seller'])
    ->name('seller.promotions.attach');

Route::post('/seller/promotions/{listing}/attach', [PromotionController::class, 'attach'])
    ->middleware(['auth', 'role:seller'])
    ->name('seller.promotions.store');

Route::get('/seller/promotions/{promotion}/edit', [PromotionController::class, 'showEditForm'])
    ->middleware(['auth', 'role:seller'])
    ->name('seller.promotions.edit');

Route::put('/seller/promotions/{promotion}', [PromotionController::class, 'updatePromotion'])
    ->middleware(['auth', 'role:seller'])
    ->name('seller.promotions.update');

Route::post('/seller/promotions/{promotion}/end', [PromotionController::class, 'end'])
    ->middleware(['auth', 'role:seller'])
    ->name('seller.promotions.end');

Route::post('/seller/request-verification', [SellerDashboardController::class, 'requestVerification'])
    ->middleware(['auth', 'role:seller'])
    ->name('seller.request.verification');

Route::get('/users/{user}/trackorder', [UserController::class, 'trackOrder'])
    ->middleware(['auth'])
    ->name('users.trackorder');

Route::get('/admin/listings/filter', [AdminDashboardController::class, 'filterListings'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.listings.filter');

Route::get('/admin/sellers', [AdminDashboardController::class, 'getSellers'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.sellers');

Route::get('/admin/buyers', [AdminDashboardController::class, 'getBuyers'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.buyers');

Route::get('/admin/orders/filter', [AdminDashboardController::class, 'filterOrders'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.orders.filter');

Route::get('/admin/deliveries', [AdminDashboardController::class, 'getDeliveries'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.deliveries');

Route::get('/admin/butcher-orders', [AdminDashboardController::class, 'getButcherOrders'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.butcher-orders');

Route::put('/users/{user}', [UserController::class, 'update'])
    ->middleware(['auth', 'role:admin'])
    ->name('users.update');


// Health check
Route::get('/ping', fn () => response()->json(['message' => 'pong']));
