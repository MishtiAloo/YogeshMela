<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PromotionController extends Controller
{
    public function index()
    {
        return response()->json(Promotion::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'listing_id'      => 'required|exists:listings,id',
            'amount_paid'     => 'required|numeric|min:0',
            'fixed_discount'  => 'nullable|numeric|min:0',
            'percent_discount'=> 'nullable|numeric|min:0|max:100',
            'status'          => 'required|in:pending,active,expired',
            'start_date'      => 'required|date',
            'end_date'        => 'required|date|after:start_date',
        ]);

        $promotion = Promotion::create($validated);

        return response()->json($promotion, 201);
    }

    public function show(Promotion $promotion)
    {
        return response()->json($promotion);
    }

    public function update(Request $request, Promotion $promotion)
    {
        $validated = $request->validate([
            'amount_paid'     => 'sometimes|numeric|min:0',
            'fixed_discount'  => 'nullable|numeric|min:0',
            'percent_discount'=> 'nullable|numeric|min:0|max:100',
            'status'          => 'required|in:pending,active,expired',
            'start_date'      => 'sometimes|date',
            'end_date'        => 'sometimes|date|after:start_date',
        ]);

        $promotion->update($validated);

        return response()->json($promotion);
    }

    public function destroy(Promotion $promotion)
    {
        $promotion->delete();
        return response()->json(['message' => 'Promotion deleted']);
    }

    public function showAttachForm(Listing $listing)
    {
        // Ensure the listing belongs to the seller
        if ($listing->user_id !== Auth::id()) {
            abort(403);
        }
        return view('seller.promotions.attach', compact('listing'));
    }

    public function attach(Request $request, Listing $listing)
    {
        if ($listing->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'amount_paid' => 'required|numeric|min:0',
            'fixed_discount' => 'nullable|numeric|min:0',
            'percent_discount' => 'nullable|numeric|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $validated['listing_id'] = $listing->id;
        $validated['status'] = 'pending'; // default

        Promotion::create($validated);

        return redirect()->route('seller.dashboard')->with('success', 'Promotion attached successfully.');
    }

    public function showEditForm(Promotion $promotion)
    {
        // Ensure the promotion's listing belongs to the seller
        if ($promotion->listing->user_id !== Auth::id()) {
            abort(403);
        }
        return view('seller.promotions.edit', compact('promotion'));
    }

    public function updatePromotion(Request $request, Promotion $promotion)
    {
        if ($promotion->listing->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'amount_paid' => 'sometimes|numeric|min:0',
            'fixed_discount' => 'nullable|numeric|min:0',
            'percent_discount' => 'nullable|numeric|min:0|max:100',
            'start_date' => 'sometimes|date',
            'end_date' => 'sometimes|date|after:start_date',
        ]);

        $promotion->update($validated);

        return redirect()->route('seller.dashboard')->with('success', 'Promotion updated successfully.');
    }

    public function end(Promotion $promotion)
    {
        if ($promotion->listing->user_id !== Auth::id()) {
            abort(403);
        }

        $promotion->update(['status' => 'expired']);

        return redirect()->route('seller.dashboard')->with('success', 'Promotion ended successfully.');
    }
}
