<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index(Request $request)
    {
        // Start with base query
        $query = Listing::with('user')->where('status', 'available');

        // Filter by animal type
        if ($request->filled('animal_type')) {
            $query->where('animal_type', $request->animal_type);
        }

        // Filter by location (partial match)
        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        // Filter by breed (partial match)
        if ($request->filled('breed')) {
            $query->where('breed', 'like', '%' . $request->breed . '%');
        }

        // Filter by minimum price
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        // Filter by maximum price
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Filter by minimum weight
        if ($request->filled('min_weight')) {
            $query->where('weight', '>=', $request->min_weight);
        }

        // Filter by maximum weight
        if ($request->filled('max_weight')) {
            $query->where('weight', '<=', $request->max_weight);
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        
        if (in_array($sortBy, ['price', 'weight', 'age', 'created_at'])) {
            $query->orderBy($sortBy, $sortOrder);
        }

        // For web requests, paginate and return view
        $listings = $query->paginate(12)->withQueryString();
        
        return view('listings.index', compact('listings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id'          => 'required|exists:users,id',
            'animal_type'      => 'required|string',
            'breed'            => 'nullable|string',
            'age'              => 'required|integer|min:1',
            'weight'           => 'required|numeric|min:1',
            'price'            => 'required|numeric|min:1',
            'location'         => 'required|string',
            'vaccination_info' => 'nullable|string',
            'status'           => 'required|in:available,sold',
        ]);

        $listing = Listing::create($validated);

        return response()->json($listing, 201);
    }

    public function show(Listing $listing)
    {
        return response()->json($listing);
    }

    public function update(Request $request, Listing $listing)
    {
        $validated = $request->validate([
            'animal_type'      => 'sometimes|string',
            'breed'            => 'nullable|string',
            'age'              => 'sometimes|integer|min:1',
            'weight'           => 'sometimes|numeric|min:1',
            'price'            => 'sometimes|numeric|min:1',
            'location'         => 'sometimes|string',
            'vaccination_info' => 'nullable|string',
            'status'           => 'sometimes|in:available,sold',
        ]);

        $listing->update($validated);

        return response()->json($listing);
    }

    public function destroy(Listing $listing)
    {
        $listing->delete();
        return response()->json(['message' => 'Listing deleted']);
    }
}
