<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        return response()->json(Order::all());
    }

    public function store(Request $request)
    {
        // Validate the checkout form
        $validated = $request->validate([
            'butcher_service' => 'nullable|boolean',
            'delivery_service'=> 'nullable|boolean',
        ]);

        try {
            DB::beginTransaction();

            $userId = Auth::id();

            // Get all cart items for the authenticated user
            $cartItems = Cart::with('listing')->where('user_id', $userId)->get();
            
            if ($cartItems->isEmpty()) {
                
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Your cart is empty!'
                    ], 400);
                }
                
                return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
            }

            $orders = [];
            $butcherService = $request->input('butcher_service', false);
            $deliveryService = $request->input('delivery_service', false);
            $currentUser = Auth::user();
            $deliveryAddress = $currentUser?->address ?? 'Not specified';
            $phone = $currentUser?->phone ?? 'Not specified';

            // Calculate service fees
            $butcherFee = $butcherService ? 500 : 0;
            $deliveryFee = $deliveryService ? 300 : 0;
            $additionalServicesFee = $butcherFee + $deliveryFee;

            // Create individual order for each cart item
            foreach ($cartItems as $cartItem) {
                // Calculate total price for this order
                $itemTotal = $cartItem->listing->price * $cartItem->quantity;
                $totalPrice = $itemTotal + $additionalServicesFee;
                
                $order = Order::create([
                    'buyer_id'                => $userId,
                    'listing_id'              => $cartItem->listing_id,
                    'quantity'                => $cartItem->quantity,
                    'total_price'             => $totalPrice,
                    'additional_services_fee' => $additionalServicesFee,
                    'butcher_service'         => $butcherService,
                    'delivery_service'        => $deliveryService,
                    'delivery_address'        => $deliveryAddress,
                    'phone'                   => $phone,
                    'payment_method'          => 'cash',
                    'status'                  => 'confirmed',
                ]);

                $orders[] = $order;
            }

            // Clear the cart after successful order creation
            Cart::where('user_id', $userId)->delete();

            DB::commit();

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Order placed successfully! You will be redirected to your dashboard.',
                    'orders_count' => count($orders),
                    'redirect' => route('buyer.dashboard')
                ], 201);
            }

            return redirect()->route('buyer.dashboard')->with('success', 'Orders placed successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to place order. Please try again.',
                    'error' => $e->getMessage()
                ], 500);
            }

            return redirect()->back()->with('error', 'Failed to place order. Please try again.');
        }
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
            'status'          => 'sometimes|in:confirmed,delivered',
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
