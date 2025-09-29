<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index()
    {
        return response()->json(Listing::all());
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
