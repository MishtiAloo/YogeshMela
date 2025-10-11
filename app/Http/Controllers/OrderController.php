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
            \Log::info('Order placement - User ID: ' . $userId);
            \Log::info('Session ID: ' . session()->getId());
            \Log::info('Auth check: ' . (Auth::check() ? 'true' : 'false'));

            // Get all cart items for the authenticated user
            $cartItems = Cart::with('listing')->where('user_id', $userId)->get();
            
            \Log::info('Cart items count: ' . $cartItems->count());
            \Log::info('Cart items: ' . json_encode($cartItems->toArray()));

            if ($cartItems->isEmpty()) {
                \Log::warning('Cart is empty for user: ' . $userId);
                
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
                    'delivery_address'        => auth()->user()->address ?? 'Not specified',
                    'phone'                   => auth()->user()->phone ?? 'Not specified',
                    'payment_method'          => 'cash',
                    'status'                  => 'confirmed',
                ]);

                $orders[] = $order;
            }

            // Clear the cart after successful order creation
            Cart::where('user_id', $userId)->delete();

            DB::commit();

            \Log::info('Orders placed successfully for user: ' . $userId . ', count: ' . count($orders));

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
            
            \Log::error('Order placement error: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            
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
