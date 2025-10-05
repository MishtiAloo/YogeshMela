<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    public function index()
    {
        return response()->json(Listing::all());
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
        ]);
    
        // Add the seller id (logged-in user)
        $validated['user_id'] = Auth::id();
    
        $listing = Listing::create($validated);
    
        return redirect()->route('seller.dashboard')
            ->with('success', 'Listing created successfully!');
    }

    public function show(Listing $listing)  
    {
        return response()->json($listing);
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
        ]);

        $listing->update($validated);

        return redirect()
        ->route('seller.dashboard')
        ->with('success', 'Listing updated successfully!');
    }

    public function destroy(Listing $listing)
    {
        $listing->delete();
        return response()->json(['message' => 'Listing deleted']);
    }
}
