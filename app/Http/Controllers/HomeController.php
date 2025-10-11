<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get featured listings (prioritize those with active promotions)
        $featuredListings = Listing::where('status', 'available')
            ->with('seller')
            ->orderByRaw('(EXISTS (SELECT 1 FROM promotions WHERE promotions.listing_id = listings.id AND promotions.status = "active" AND promotions.start_date <= NOW() AND promotions.end_date >= NOW())) DESC')
            ->latest()
            ->take(6)
            ->get();

        // Get stats for each animal type
        $stats = [
            'cows' => Listing::where('animal_type', 'cow')->where('status', 'available')->count(),
            'goats' => Listing::where('animal_type', 'goat')->where('status', 'available')->count(),
            'sheep' => Listing::where('animal_type', 'sheep')->where('status', 'available')->count(),
            'camels' => Listing::where('animal_type', 'camel')->where('status', 'available')->count(),
        ];

        return view('home', compact('featuredListings', 'stats'));
    }
}
