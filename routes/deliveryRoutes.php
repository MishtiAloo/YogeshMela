<?php

use App\Http\Controllers\DeliveryController;
use Illuminate\Support\Facades\Route;

// RESTful CRUD for /api/users
Route::apiResource('deliveries', DeliveryController::class);
