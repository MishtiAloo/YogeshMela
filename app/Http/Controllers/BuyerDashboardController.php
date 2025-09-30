<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class BuyerDashboardController extends Controller
{
    public function dashboard()
    {
        $buyer = Auth::user();

        $orders = Order::where('buyer_id', $buyer->id)->get();

        return view('buyer.dashboard', [
            'buyer'  => $buyer,
            'orders' => $orders,
        ]);
    }
}

