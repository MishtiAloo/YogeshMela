<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Listing;
use App\Models\Promotion;
use App\Models\User;
use App\Models\Order;

class SellerDashboardController extends Controller
{
    public function dashboard()
    {
        $seller = Auth::user();

        $listings = Listing::where('user_id', $seller->id)->get();

        // Get promotions for these listings
        $listingIds = $listings->pluck('id');
        $promotions = Promotion::whereIn('listing_id', $listingIds)->get()->keyBy('listing_id');

        // Get orders for these listings
        $orders = Order::whereIn('listing_id', $listingIds)->with('buyer')->get()->groupBy('listing_id');

        return view('seller.dashboard', [
            'seller'     => $seller,
            'listings'   => $listings,
            'promotions' => $promotions,
            'orders'     => $orders,
        ]);
    }

    public function markDelivered(Order $order)
    {
        // Ensure the order belongs to the authenticated seller's listing
        if ($order->listing->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $order->update(['status' => 'delivered']);

        return redirect()->route('seller.dashboard')->with('success', 'Order marked as delivered.');
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
