<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            'animal_type'      => 'required|string|in:cow,goat,sheep,camel',
            'breed'            => 'nullable|string',
            'age'              => 'required|integer|min:1',
            'weight'           => 'required|numeric|min:1',
            'price'            => 'required|numeric|min:1',
            'location'         => 'required|string',
            'vaccination_info' => 'nullable|string',
            'status'           => 'required|in:available,sold',
            'image'            => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('listings', 'public');
            $validated['image'] = $imagePath;
        }

        // Add the seller id (logged-in user)
        $validated['user_id'] = Auth::id();

        $listing = Listing::create($validated);

        return redirect()->route('seller.dashboard')
            ->with('success', 'Listing created successfully!');
    }

    public function show(Listing $listing)  
    {
        // Load the listing with user (seller) relationship
        $listing->load('user');
        
        // Get related listings (same animal type, exclude current)
        $relatedListings = Listing::where('animal_type', $listing->animal_type)
            ->where('id', '!=', $listing->id)
            ->where('status', 'available')
            ->with('user')
            ->take(4)
            ->get();
        
        return view('listings.show', compact('listing', 'relatedListings'));
    }

    public function showCreateListing()
    {
        return view('seller.listings.create');
    }

    public function showEditListing(Listing $listing)
    {
        return view('seller.listings.edit', compact('listing'));
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
            'image'            => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($listing->image) {
                Storage::disk('public')->delete($listing->image);
            }
            $imagePath = $request->file('image')->store('listings', 'public');
            $validated['image'] = $imagePath;
        }

        $listing->update($validated);

        return redirect()
        ->route('seller.dashboard')
        ->with('success', 'Listing updated successfully!');
    }

    public function destroy(Listing $listing)
    {
        $listing->delete();
        return redirect()->route('seller.dashboard')->with('success', 'Listing deleted successfully!');
    }
}
