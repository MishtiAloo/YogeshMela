<?php

use Illuminate\Support\Facades\Route;

// Load split route files
require __DIR__ . '/userRoutes.php';
require __DIR__ . '/listingRoutes.php';
require __DIR__ . '/orderRoutes.php';
require __DIR__ . '/deliveryRoutes.php';
require __DIR__ . '/butcherOrderRoutes.php';
require __DIR__ . '/promotionRoutes.php';

// Health check
Route::get('/ping', fn () => response()->json(['message' => 'pong']));
