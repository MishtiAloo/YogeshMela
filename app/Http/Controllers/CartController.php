<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Show cart page
    public function index()
    {
        $cartItems = $this->getCartItems();
        $total = $cartItems->sum('subtotal');
        
        return view('cart.index', compact('cartItems', 'total'));
    }

    // Add item to cart
    public function add(Request $request, $listingId)
    {
        $listing = Listing::findOrFail($listingId);
        
        // Check if listing is available
        if ($listing->status !== 'available') {
            return back()->with('error', 'This animal is no longer available.');
        }

        $userId = Auth::id();
        
        // Check if user is logged in and not a buyer
        if ($userId && Auth::user()->role !== 'buyer') {
            return back()->with('error', 'Only buyers can add items to cart. You are logged in as ' . ucfirst(Auth::user()->role) . '.');
        }
        
        $sessionId = session()->getId();

        // Check if item already in cart
        $cartItem = Cart::where('listing_id', $listingId)
            ->where(function($query) use ($userId, $sessionId) {
                if ($userId) {
                    $query->where('user_id', $userId);
                } else {
                    $query->where('session_id', $sessionId);
                }
            })
            ->first();

        if ($cartItem) {
            return back()->with('info', 'This item is already in your cart.');
        }

        // Add new cart item
        Cart::create([
            'user_id' => $userId,
            'listing_id' => $listingId,
            'quantity' => 1,
            'session_id' => $userId ? null : $sessionId
        ]);

        return back()->with('success', 'Item added to cart successfully!');
    }

    // Update cart item quantity
    public function update(Request $request, $cartId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:10'
        ]);

        $cartItem = Cart::findOrFail($cartId);
        
        // Verify ownership
        if (!$this->verifyCartOwnership($cartItem)) {
            return back()->with('error', 'Unauthorized action.');
        }

        $cartItem->update([
            'quantity' => $request->quantity
        ]);

        return back()->with('success', 'Cart updated successfully!');
    }

    // Remove item from cart
    public function remove($cartId)
    {
        $cartItem = Cart::findOrFail($cartId);
        
        // Verify ownership
        if (!$this->verifyCartOwnership($cartItem)) {
            return back()->with('error', 'Unauthorized action.');
        }

        $cartItem->delete();

        return back()->with('success', 'Item removed from cart.');
    }

    // Clear entire cart
    public function clear()
    {
        $userId = Auth::id();
        $sessionId = session()->getId();

        Cart::where(function($query) use ($userId, $sessionId) {
            if ($userId) {
                $query->where('user_id', $userId);
            } else {
                $query->where('session_id', $sessionId);
            }
        })->delete();

        return back()->with('success', 'Cart cleared successfully!');
    }

    // Get cart items count (for header badge)
    public function count()
    {
        $count = $this->getCartItems()->count();
        return response()->json(['count' => $count]);
    }

    // Helper: Get cart items for current user/session
    private function getCartItems()
    {
        $userId = Auth::id();
        $sessionId = session()->getId();

        return Cart::with(['listing.user'])
            ->where(function($query) use ($userId, $sessionId) {
                if ($userId) {
                    $query->where('user_id', $userId);
                } else {
                    $query->where('session_id', $sessionId);
                }
            })
            ->get();
    }

    // Helper: Verify cart item ownership
    private function verifyCartOwnership($cartItem)
    {
        $userId = Auth::id();
        $sessionId = session()->getId();

        if ($userId) {
            return $cartItem->user_id == $userId;
        } else {
            return $cartItem->session_id == $sessionId;
        }
    }
}
