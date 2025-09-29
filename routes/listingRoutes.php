<?php

use App\Http\Controllers\ListingController;
use Illuminate\Support\Facades\Route;

// RESTful CRUD for /api/users
Route::apiResource('listings', ListingController::class);
