<?php

namespace App\Http\Controllers;

use App\Models\ButcherOrder;
use App\Models\Delivery;
use App\Models\Listing;
use App\Models\User;
use App\Models\Order;
use App\Models\Promotion;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $sellers = User::where('role', 'seller');
        if ($request->filled('seller_verified')) {
            $sellers = $sellers->where('verified', $request->seller_verified);
        }
        $sellers = $sellers->get();

        $listings = Listing::with('seller');
        $listings = $listings->get();

        $orders = Order::with(['buyer', 'listing']);
        if ($request->filled('order_status')) {
            $orders = $orders->where('status', $request->order_status);
        }
        $orders = $orders->get();

        $promotions = Promotion::with('listing');   
        if ($request->filled('promotion_status')) {
            $promotions = $promotions->where('status', $request->promotion_status);
        }
        $promotions = $promotions->get();

        return view('admin.dashboard', [
            'sellers' => $sellers,
            'listings' => $listings,
            'orders' => $orders,
            'promotions' => $promotions,
        ]);
    }

    public function filterOrders(Request $request)
    {
        $query = Order::query();

        // Optional filters (only applied if passed in request)
        if ($request->filled('buyer_id')) {
            $query->where('buyer_id', $request->buyer_id);
        }

        if ($request->filled('butcher_service')) {
            $query->where('butcher_service', $request->butcher_service);
        }

        if ($request->filled('delivery_service')) {
            $query->where('delivery_service', $request->delivery_service);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Get filtered results
        $orders = $query->with(['buyer', 'listing'])->get();

        return response()->json($orders);
    }

    public function filterListings(Request $request)
    {
        $query = Listing::query();

        // Filters (only apply if provided in request)
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('animal_type')) {
            $query->where('animal_type', $request->animal_type);
        }

        if ($request->filled('breed')) {
            $query->where('breed', 'LIKE', '%' . $request->breed . '%');
        }

        if ($request->filled('location')) {
            $query->where('location', 'LIKE', '%' . $request->location . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Optional range filters
        if ($request->filled('min_age')) {
            $query->where('age', '>=', $request->min_age);
        }
        if ($request->filled('max_age')) {
            $query->where('age', '<=', $request->max_age);
        }

        if ($request->filled('min_weight')) {
            $query->where('weight', '>=', $request->min_weight);
        }
        if ($request->filled('max_weight')) {
            $query->where('weight', '<=', $request->max_weight);
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Include related seller
        $listings = $query->with('seller')->get();

        return response()->json($listings);
    }

    // Sellers management
    public function getSellers(Request $request)
    {
        $query = User::where('role', 'seller');

        if ($request->filled('verified')) {
            $query->where('verified', $request->boolean('verified'));
        }

        $sellers = $query->get();

        return response()->json($sellers);
    }

}
