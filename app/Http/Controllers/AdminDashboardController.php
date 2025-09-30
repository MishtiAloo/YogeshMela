<?php

namespace App\Http\Controllers;

use App\Models\ButcherOrder;
use App\Models\Delivery;
use App\Models\Listing;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function dashboard()
    {
        $users  = User::all();
        $orders = Order::all();
        $listings = Listing::all();
        $deliveries = Delivery::all();
        $butcher_oreders = ButcherOrder::all();

        return view('admin.dashboard', [
            'users'  => $users,
            'orders' => $orders,
            'listings' => $listings,
            'deliveries' => $deliveries,
            'butcher_orders' => $butcher_oreders,
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

        // Get all orders with status=confirmed:
        // GET /admin/orders/filter?status=confirmed

        // Get all orders from a specific buyer:
        // GET /admin/orders/filter?buyer_id=5

        // Get all orders where delivery service is enabled:
        // GET /admin/orders/filter?delivery_service=1

        // Combine filters:
        // GET /admin/orders/filter?status=delivered&butcher_service=1
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

        // All goat listings:
        // GET /admin/listings/filter?animal_type=goat

        // All available listings in Dhaka:
        // GET /admin/listings/filter?location=Dhaka&status=available

        // Cows weighing more than 200kg:
        // GET /admin/listings/filter?animal_type=cow&min_weight=200

        // Price range filter:
        // GET /admin/listings/filter?min_price=50000&max_price=100000
    }

}
