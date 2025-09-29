<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return response()->json(Order::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'buyer_id'        => 'required|exists:users,id',
            'listing_id'      => 'required|exists:listings,id',
            'quantity'        => 'required|integer|min:1',
            'butcher_service' => 'required|boolean',
            'delivery_service'=> 'required|boolean',
            'status'          => 'required|in:confirmed,pending,cancelled',
        ]);

        $order = Order::create($validated);

        return response()->json($order, 201);
    }

    public function show(Order $order)
    {
        return response()->json($order);
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'quantity'        => 'sometimes|integer|min:1',
            'butcher_service' => 'sometimes|boolean',
            'delivery_service'=> 'sometimes|boolean',
            'status'          => 'sometimes|in:confirmed,pending,cancelled',
        ]);

        $order->update($validated);

        return response()->json($order);
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json(['message' => 'Order deleted']);
    }
}
