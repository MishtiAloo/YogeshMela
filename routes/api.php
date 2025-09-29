<?php

use Illuminate\Support\Facades\Route;

// Load split route files (moved from api.php)
require __DIR__ . '/userRoutes.php';
require __DIR__ . '/listingRoutes.php';
require __DIR__ . '/orderRoutes.php';
require __DIR__ . '/deliveryRoutes.php';
require __DIR__ . '/butcherOrderRoutes.php';
require __DIR__ . '/promotionRoutes.php';

// You can leave this empty or just a ping route for testing
Route::get('/ping', fn () => response()->json(['message' => 'pong']));
