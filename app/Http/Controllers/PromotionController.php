<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;

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
}
