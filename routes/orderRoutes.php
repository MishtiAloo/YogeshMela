<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

// RESTful CRUD for /api/users
Route::apiResource('orders', OrderController::class);
