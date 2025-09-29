<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// RESTful CRUD for /api/users
Route::apiResource('users', UserController::class);

// Extra custom routes
Route::post('users/login', [UserController::class, 'login'])->name('users.login');
Route::post('users/logout', [UserController::class, 'logout'])->name('users.logout');
