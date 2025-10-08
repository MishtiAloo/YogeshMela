<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Listing;
use App\Models\Promotion;
use App\Models\User;

class SellerDashboardController extends Controller
{
    public function dashboard()
    {
        $seller = Auth::user();

        $listings = Listing::where('user_id', $seller->id)->get();

        // Get promotions for these listings
        $listingIds = $listings->pluck('id');
        $promotions = Promotion::whereIn('listing_id', $listingIds)->get()->keyBy('listing_id');

        return view('seller.dashboard', [
            'seller'     => $seller,
            'listings'   => $listings,
            'promotions' => $promotions,
        ]);
    }

    public function requestVerification()
    {
        $seller = Auth::user();

        if ($seller->verified === 'unverified') {
            User::where('id', Auth::id())->update(['verified' => 'pending']);
        }

        return redirect()->route('seller.dashboard')->with('success', 'Verification request submitted.');
    }
}
