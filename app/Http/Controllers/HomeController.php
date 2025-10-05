<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get featured listings (promoted or available listings)
        $featuredListings = Listing::where('status', 'available')
            ->with('user')
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
