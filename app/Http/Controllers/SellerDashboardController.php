<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Listing;

class SellerDashboardController extends Controller
{
    public function dashboard()
    {
        $seller = Auth::user();

        $listings = Listing::where('user_id', $seller->id)->get();

        return view('seller.dashboard', [
            'seller'   => $seller,
            'listings' => $listings,
        ]);
    }
}
