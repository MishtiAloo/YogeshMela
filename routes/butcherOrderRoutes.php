<?php

use App\Http\Controllers\ButcherOrderController;
use Illuminate\Support\Facades\Route;

// RESTful CRUD for /api/users
Route::apiResource('butcherOrders', ButcherOrderController::class);
