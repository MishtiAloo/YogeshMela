<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// RESTful CRUD for /api/users
Route::apiResource('users', UserController::class);


