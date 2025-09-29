<?php

use App\Http\Controllers\PromotionController;
use Illuminate\Support\Facades\Route;

// RESTful CRUD for /api/users
Route::apiResource('promotions', PromotionController::class);
