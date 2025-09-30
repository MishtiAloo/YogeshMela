<?php

namespace App\Http\Controllers;

use App\Models\ButcherOrder;
use App\Models\Delivery;
use App\Models\Listing;
use App\Models\User;
use App\Models\Order;

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
}
