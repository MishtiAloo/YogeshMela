@extends('layouts.app')

@section('content')
<div style="background-color: #f9fafb; min-height: 100vh; padding: 40px 0;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <!-- Page Header -->
        <div style="margin-bottom: 40px;">
            <h1 style="font-size: 32px; font-weight: bold; color: #1f2937; margin-bottom: 8px;">Shopping Cart</h1>
            <p style="color: #6b7280; font-size: 16px;">Review your items before checkout</p>
        </div>

        @if(session('success'))
        <div style="background-color: #d1fae5; border: 1px solid #10b981; color: #065f46; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div style="background-color: #fee2e2; border: 1px solid #ef4444; color: #991b1b; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px;">
            {{ session('error') }}
        </div>
        @endif

        @if(session('info'))
        <div style="background-color: #dbeafe; border: 1px solid #3b82f6; color: #1e40af; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px;">
            {{ session('info') }}
        </div>
        @endif

        @if($cartItems->count() > 0)
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px;">
            <!-- Cart Items Section -->
            <div>
                <div style="background-color: white; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden;">
                    <!-- Cart Items List -->
                    @foreach($cartItems as $item)
                    <div style="padding: 24px; border-bottom: 1px solid #e5e7eb; display: flex; gap: 20px; align-items: start;">
                        <!-- Item Image -->
                        <div style="width: 120px; height: 120px; border-radius: 8px; overflow: hidden; flex-shrink: 0; background-color: #f3f4f6;">
                            @if($item->listing->image)
                                @if(str_starts_with($item->listing->image, 'image/'))
                                    <img src="{{ asset($item->listing->image) }}" alt="{{ ucfirst($item->listing->animal_type) }}" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <img src="{{ asset('storage/' . $item->listing->image) }}" alt="{{ ucfirst($item->listing->animal_type) }}" style="width: 100%; height: 100%; object-fit: cover;">
                                @endif
                            @else
                                <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: #9ca3af;">
                                    <span style="font-size: 14px;">No Image</span>
                                </div>
                            @endif
                        </div>

                        <!-- Item Details -->
                        <div style="flex: 1;">
                            <h3 style="font-size: 18px; font-weight: 600; color: #1f2937; margin-bottom: 8px;">
                                <a href="{{ route('listings.show', $item->listing->id) }}" style="color: #1f2937; text-decoration: none;">
                                    {{ $item->listing->title }}
                                </a>
                            </h3>
                            <p style="color: #6b7280; font-size: 14px; margin-bottom: 12px;">
                                {{ Str::limit($item->listing->description, 100) }}
                            </p>
                            <div style="display: flex; gap: 16px; align-items: center; font-size: 14px; color: #6b7280;">
                                <span><strong>Weight:</strong> {{ $item->listing->weight }} kg</span>
                                <span><strong>Category:</strong> {{ ucfirst($item->listing->category) }}</span>
                                <span><strong>Seller:</strong> {{ $item->listing->user->name }}</span>
                            </div>
                        </div>

                        <!-- Quantity & Price -->
                        <div style="text-align: right; min-width: 200px;">
                            <div style="font-size: 24px; font-weight: bold; color: #f97316; margin-bottom: 16px;">
                                ৳{{ number_format($item->subtotal, 2) }}
                            </div>
                            
                            <!-- Quantity Controls -->
                            <form method="POST" action="{{ route('cart.update', $item->id) }}" style="margin-bottom: 12px;">
                                @csrf
                                @method('PUT')
                                <div style="display: flex; align-items: center; justify-content: flex-end; gap: 8px;">
                                    <label style="color: #6b7280; font-size: 14px; margin-right: 8px;">Qty:</label>
                                    <select name="quantity" onchange="this.form.submit()" style="padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 6px; color: #1f2937; font-size: 14px; background-color: white; cursor: pointer;">
                                        @for($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}" {{ $item->quantity == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </form>

                            <!-- Remove Button -->
                            <form method="POST" action="{{ route('cart.remove', $item->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="color: #6b7280; font-size: 14px; text-decoration: underline; background: none; border: none; cursor: pointer; padding: 0;">
                                    Remove
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Clear Cart Button -->
                <div style="margin-top: 16px; text-align: right;">
                    <form method="POST" action="{{ route('cart.clear') }}" onsubmit="return confirm('Are you sure you want to clear your cart?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="color: #6b7280; font-size: 14px; background: none; border: none; cursor: pointer; text-decoration: underline; padding: 8px 0;">
                            Clear Cart
                        </button>
                    </form>
                </div>
            </div>

            <!-- Order Summary Sidebar -->
            <div style="background-color: white; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 24px; height: fit-content; position: sticky; top: 20px;">
                <h2 style="font-size: 20px; font-weight: bold; color: #1f2937; margin-bottom: 20px;">Order Summary</h2>
                
                <div style="border-bottom: 1px solid #e5e7eb; padding-bottom: 16px; margin-bottom: 16px;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 12px;">
                        <span style="color: #6b7280; font-size: 14px;">Subtotal ({{ $cartItems->count() }} items)</span>
                        <span style="color: #1f2937; font-weight: 500;">৳{{ number_format($total, 2) }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 12px;">
                        <span style="color: #6b7280; font-size: 14px;">Delivery Fee</span>
                        <span style="color: #1f2937; font-weight: 500;">Calculated at checkout</span>
                    </div>
                </div>

                <div style="display: flex; justify-content: space-between; margin-bottom: 24px;">
                    <span style="font-size: 18px; font-weight: bold; color: #1f2937;">Total</span>
                    <span style="font-size: 24px; font-weight: bold; color: #f97316;">৳{{ number_format($total, 2) }}</span>
                </div>

                @auth
                    @if(auth()->user()->role === 'buyer')
                        <!-- Checkout button for buyers only -->
                        <a href="{{ route('checkout.index') }}" style="display: block; width: 100%; padding: 14px 24px; background-color: #14b8a6; color: white; text-align: center; border-radius: 8px; font-weight: 600; text-decoration: none; transition: background-color 0.3s;">
                            Proceed to Checkout
                        </a>
                    @else
                        <!-- Message for sellers and admins -->
                        <div style="background-color: #fee2e2; border: 1px solid #ef4444; border-radius: 8px; padding: 16px; margin-bottom: 16px; text-align: center;">
                            <p style="color: #991b1b; font-size: 14px; margin-bottom: 8px;">
                                <strong>Only buyers can purchase items</strong>
                            </p>
                            <p style="color: #991b1b; font-size: 13px;">
                                You are logged in as <strong>{{ ucfirst(auth()->user()->role) }}</strong>. Please use a buyer account to make purchases.
                            </p>
                        </div>
                    @endif
                @else
                    <!-- Login prompt for guests -->
                    <div style="background-color: #fef3c7; border: 1px solid #f59e0b; border-radius: 8px; padding: 16px; margin-bottom: 16px; text-align: center;">
                        <p style="color: #92400e; font-size: 14px; margin-bottom: 12px;">
                            <strong>Please login as a buyer to proceed with checkout</strong>
                        </p>
                        <div style="display: flex; gap: 8px;">
                            <a href="{{ route('login') }}" style="flex: 1; padding: 12px 20px; background-color: #14b8a6; color: white; text-align: center; border-radius: 8px; font-weight: 600; text-decoration: none; transition: background-color 0.3s;">
                                Login
                            </a>
                            <a href="{{ route('register') }}" style="flex: 1; padding: 12px 20px; background-color: white; color: #14b8a6; text-align: center; border-radius: 8px; font-weight: 600; text-decoration: none; border: 2px solid #14b8a6; transition: background-color 0.3s;">
                                Sign Up
                            </a>
                        </div>
                    </div>
                @endauth

                <a href="{{ route('listings.index') }}" style="display: block; width: 100%; padding: 14px 24px; background-color: white; color: #14b8a6; text-align: center; border-radius: 8px; font-weight: 600; text-decoration: none; border: 2px solid #14b8a6; margin-top: 12px; transition: background-color 0.3s;">
                    Continue Shopping
                </a>
            </div>
        </div>

        @else
        <!-- Empty Cart -->
        <div style="background-color: white; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 60px 40px; text-align: center;">
            <svg style="width: 80px; height: 80px; margin: 0 auto 24px; color: #d1d5db;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <h2 style="font-size: 24px; font-weight: bold; color: #1f2937; margin-bottom: 12px;">Your cart is empty</h2>
            <p style="color: #6b7280; margin-bottom: 24px; font-size: 16px;">Add some animals to get started!</p>
            <a href="{{ route('listings.index') }}" style="display: inline-block; padding: 14px 32px; background-color: #14b8a6; color: white; border-radius: 8px; font-weight: 600; text-decoration: none; transition: background-color 0.3s;">
                Browse Listings
            </a>
        </div>
        @endif
    </div>
</div>

<style>
    /* Hover effects */
    a[href="{{ route('checkout.index') }}"]:hover,
    a[href="{{ route('login') }}"]:hover {
        background-color: #0d9488 !important;
    }
    a[href="{{ route('listings.index') }}"]:hover {
        background-color: #f0fdfa !important;
    }
    a[href="{{ route('register') }}"]:hover {
        background-color: #f0fdfa !important;
    }
</style>
@endsection
