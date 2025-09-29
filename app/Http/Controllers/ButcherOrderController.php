<?php

namespace App\Http\Controllers;

use App\Models\ButcherOrder;
use Illuminate\Http\Request;

class ButcherOrderController extends Controller
{
    public function index()
    {
        return response()->json(ButcherOrder::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id'       => 'required|exists:orders,id',
            'butcher_id'     => 'required|exists:users,id',
            'scheduled_date' => 'required|date',
            'charge'         => 'required|numeric|min:1',
            'status'         => 'required|in:scheduled,completed,cancelled',
        ]);

        $butcherOrder = ButcherOrder::create($validated);

        return response()->json($butcherOrder, 201);
    }

    public function show(ButcherOrder $butcherOrder)
    {
        return response()->json($butcherOrder);
    }

    public function update(Request $request, ButcherOrder $butcherOrder)
    {
        $validated = $request->validate([
            'scheduled_date' => 'sometimes|date',
            'charge'         => 'sometimes|numeric|min:1',
            'status'         => 'sometimes|in:scheduled,completed,cancelled',
        ]);

        $butcherOrder->update($validated);

        return response()->json($butcherOrder);
    }

    public function destroy(ButcherOrder $butcherOrder)
    {
        $butcherOrder->delete();
        return response()->json(['message' => 'Butcher order deleted']);
    }
}
