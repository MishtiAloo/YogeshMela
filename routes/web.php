<?php

use App\Http\Controllers\UserController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Auth routes (login/logout)
Route::middleware(['web'])->group(function () {
    Route::post('/users/login', [UserController::class, 'login'])
        ->withoutMiddleware([VerifyCsrfToken::class]);
    Route::post('/users/logout', [UserController::class, 'logout'])
        ->withoutMiddleware([VerifyCsrfToken::class]);
});



// Health check
Route::get('/ping', fn () => response()->json(['message' => 'pong']));
