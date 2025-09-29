<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function index()
    {
        return response()->json(Delivery::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id'         => 'required|exists:orders,id',
            'delivery_man_id'  => 'required|exists:users,id',
            'delivery_date'    => 'required|date',
            'delivery_address' => 'required|string',
            'charge'           => 'required|numeric|min:1',
            'status'           => 'required|in:scheduled,completed,cancelled',
        ]);

        $delivery = Delivery::create($validated);

        return response()->json($delivery, 201);
    }

    public function show(Delivery $delivery)
    {
        return response()->json($delivery);
    }

    public function update(Request $request, Delivery $delivery)
    {
        $validated = $request->validate([
            'delivery_date'    => 'sometimes|date',
            'delivery_address' => 'sometimes|string',
            'charge'           => 'sometimes|numeric|min:1',
            'status'           => 'sometimes|in:scheduled,completed,cancelled',
        ]);

        $delivery->update($validated);

        return response()->json($delivery);
    }

    public function destroy(Delivery $delivery)
    {
        $delivery->delete();
        return response()->json(['message' => 'Delivery deleted']);
    }
}
