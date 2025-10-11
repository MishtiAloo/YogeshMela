<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Listing;

class BuyerDashboardController extends Controller
{
    public function dashboard()
    {
        $buyer = Auth::user();

        // Get all orders with related data
        $orders = Order::where('buyer_id', $buyer->id)
            ->with(['listing.user', 'delivery'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Get cart items
        $cartItems = Cart::where('user_id', $buyer->id)
            ->with('listing')
            ->get();

        // Calculate statistics
        $stats = [
            'total_orders' => $orders->count(),
            'pending_orders' => $orders->where('status', 'confirmed')->count(),
            'completed_orders' => $orders->where('status', 'delivered')->count(),
            'cancelled_orders' => 0, // No cancelled status in current schema
            'total_spent' => $orders->sum('total_price'),
            'cart_items' => $cartItems->count(),
            'cart_total' => $cartItems->sum('subtotal'),
        ];

        // Get recent listings (for recommendations)
        $recommendedListings = Listing::where('status', 'available')
            ->where('user_id', '!=', $buyer->id)
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        return view('buyer.dashboard', [
            'buyer'  => $buyer,
            'orders' => $orders,
            'stats' => $stats,
            'cartItems' => $cartItems,
            'recommendedListings' => $recommendedListings,
        ]);
    }
}

