@extends('layouts.app')

@section('content')
<div style="background: linear-gradient(135deg, #14b8a6 0%, #134e4a 100%); padding: 60px 0 40px;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
            <div>
                <h1 style="color: white; font-size: 36px; font-weight: bold; margin-bottom: 8px;">Welcome back, {{ $buyer->name }}!</h1>
                <p style="color: rgba(255,255,255,0.9); font-size: 16px;">Here's your buyer dashboard overview</p>
            </div>
            <div style="text-align: right;">
                <p style="color: rgba(255,255,255,0.8); font-size: 14px; margin-bottom: 4px;">Member since</p>
                <p style="color: white; font-size: 16px; font-weight: 600;">{{ $buyer->created_at->format('M Y') }}</p>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 40px;">
            <!-- Total Orders -->
            <div style="background: rgba(255,255,255,0.95); border-radius: 12px; padding: 24px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px;">
                    <span style="color: #6b7280; font-size: 14px; font-weight: 500;">Total Orders</span>
                    <svg style="width: 24px; height: 24px; color: #14b8a6;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <p style="font-size: 32px; font-weight: bold; color: #1f2937; margin-bottom: 4px;">{{ $stats['total_orders'] }}</p>
                <p style="color: #6b7280; font-size: 12px;">All time purchases</p>
            </div>

            <!-- Pending Orders -->
            <div style="background: rgba(255,255,255,0.95); border-radius: 12px; padding: 24px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px;">
                    <span style="color: #6b7280; font-size: 14px; font-weight: 500;">Pending</span>
                    <svg style="width: 24px; height: 24px; color: #f59e0b;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <p style="font-size: 32px; font-weight: bold; color: #1f2937; margin-bottom: 4px;">{{ $stats['pending_orders'] }}</p>
                <p style="color: #6b7280; font-size: 12px;">Awaiting delivery</p>
            </div>

            <!-- Completed Orders -->
            <div style="background: rgba(255,255,255,0.95); border-radius: 12px; padding: 24px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px;">
                    <span style="color: #6b7280; font-size: 14px; font-weight: 500;">Completed</span>
                    <svg style="width: 24px; height: 24px; color: #10b981;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <p style="font-size: 32px; font-weight: bold; color: #1f2937; margin-bottom: 4px;">{{ $stats['completed_orders'] }}</p>
                <p style="color: #6b7280; font-size: 12px;">Successfully delivered</p>
            </div>

            <!-- Total Spent -->
            <div style="background: rgba(255,255,255,0.95); border-radius: 12px; padding: 24px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px;">
                    <span style="color: #6b7280; font-size: 14px; font-weight: 500;">Total Spent</span>
                    <svg style="width: 24px; height: 24px; color: #f97316;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <p style="font-size: 28px; font-weight: bold; color: #1f2937; margin-bottom: 4px;">৳{{ number_format($stats['total_spent'], 2) }}</p>
                <p style="color: #6b7280; font-size: 12px;">Lifetime value</p>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div style="background-color: #f9fafb; padding: 40px 0; min-height: 60vh;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px;">
            <!-- Left Column: Orders -->
            <div>
                <!-- Recent Orders -->
                <div style="background: white; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 24px; margin-bottom: 24px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <h2 style="font-size: 20px; font-weight: bold; color: #1f2937;">Recent Orders</h2>
                        <a href="#all-orders" style="color: #14b8a6; font-size: 14px; font-weight: 500; text-decoration: none;">View All →</a>
                    </div>

                    @if($orders->count() > 0)
                        @foreach($orders->take(5) as $order)
                        <div style="border-bottom: 1px solid #e5e7eb; padding: 16px 0;">
                            <div style="display: flex; justify-content: space-between; align-items: start;">
                                <div style="flex: 1;">
                                    <h3 style="font-size: 16px; font-weight: 600; color: #1f2937; margin-bottom: 6px;">
                                        {{ $order->listing->title }}
                                    </h3>
                                    <p style="color: #6b7280; font-size: 14px; margin-bottom: 8px;">
                                        Seller: {{ $order->listing->user->name }}
                                    </p>
                                    <div style="display: flex; gap: 16px; align-items: center;">
                                        <span style="color: #6b7280; font-size: 13px;">
                                            📅 {{ $order->created_at->format('M d, Y') }}
                                        </span>
                                        <span style="padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: 600;
                                            @if($order->status === 'completed') background-color: #d1fae5; color: #065f46;
                                            @elseif($order->status === 'pending') background-color: #fef3c7; color: #92400e;
                                            @elseif($order->status === 'cancelled') background-color: #fee2e2; color: #991b1b;
                                            @else background-color: #e0e7ff; color: #3730a3;
                                            @endif">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </div>
                                </div>
                                <div style="text-align: right;">
                                    <p style="font-size: 20px; font-weight: bold; color: #f97316; margin-bottom: 8px;">
                                        ৳{{ number_format($order->total_price, 2) }}
                                    </p>
                                    <a href="{{ route('users.trackorder', ['user' => $buyer->id]) }}" style="color: #14b8a6; font-size: 13px; text-decoration: none; font-weight: 500;">
                                        Track Order →
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div style="text-align: center; padding: 40px 20px;">
                            <svg style="width: 64px; height: 64px; margin: 0 auto 16px; color: #d1d5db;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            <p style="color: #6b7280; font-size: 16px; margin-bottom: 16px;">No orders yet</p>
                            <a href="{{ route('listings.index') }}" style="display: inline-block; padding: 10px 24px; background-color: #14b8a6; color: white; border-radius: 8px; font-weight: 600; text-decoration: none;">
                                Start Shopping
                            </a>
                        </div>
                    @endif
                </div>

                <!-- All Orders Table -->
                @if($orders->count() > 5)
                <div id="all-orders" style="background: white; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 24px;">
                    <h2 style="font-size: 20px; font-weight: bold; color: #1f2937; margin-bottom: 20px;">All Orders</h2>
                    <div style="overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr style="border-bottom: 2px solid #e5e7eb;">
                                    <th style="text-align: left; padding: 12px; color: #6b7280; font-size: 13px; font-weight: 600;">ORDER ID</th>
                                    <th style="text-align: left; padding: 12px; color: #6b7280; font-size: 13px; font-weight: 600;">ITEM</th>
                                    <th style="text-align: left; padding: 12px; color: #6b7280; font-size: 13px; font-weight: 600;">DATE</th>
                                    <th style="text-align: left; padding: 12px; color: #6b7280; font-size: 13px; font-weight: 600;">STATUS</th>
                                    <th style="text-align: right; padding: 12px; color: #6b7280; font-size: 13px; font-weight: 600;">TOTAL</th>
                                    <th style="text-align: center; padding: 12px; color: #6b7280; font-size: 13px; font-weight: 600;">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr style="border-bottom: 1px solid #e5e7eb;">
                                    <td style="padding: 12px; color: #1f2937; font-size: 14px;">#{{ $order->id }}</td>
                                    <td style="padding: 12px; color: #1f2937; font-size: 14px;">{{ Str::limit($order->listing->title, 30) }}</td>
                                    <td style="padding: 12px; color: #6b7280; font-size: 14px;">{{ $order->created_at->format('M d, Y') }}</td>
                                    <td style="padding: 12px;">
                                        <span style="padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: 600;
                                            @if($order->status === 'completed') background-color: #d1fae5; color: #065f46;
                                            @elseif($order->status === 'pending') background-color: #fef3c7; color: #92400e;
                                            @elseif($order->status === 'cancelled') background-color: #fee2e2; color: #991b1b;
                                            @else background-color: #e0e7ff; color: #3730a3;
                                            @endif">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td style="padding: 12px; text-align: right; color: #f97316; font-weight: 600; font-size: 14px;">৳{{ number_format($order->total_price, 2) }}</td>
                                    <td style="padding: 12px; text-align: center;">
                                        <a href="{{ route('users.trackorder', ['user' => $buyer->id]) }}" style="color: #14b8a6; font-size: 13px; text-decoration: none; font-weight: 500;">
                                            Track
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            </div>

            <!-- Right Column: Cart & Quick Actions -->
            <div>
                <!-- Cart Summary -->
                <div style="background: white; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 24px; margin-bottom: 24px;">
                    <h2 style="font-size: 18px; font-weight: bold; color: #1f2937; margin-bottom: 16px;">Shopping Cart</h2>
                    
                    @if($cartItems->count() > 0)
                        <div style="margin-bottom: 16px;">
                            @foreach($cartItems->take(3) as $item)
                            <div style="display: flex; gap: 12px; margin-bottom: 12px; padding-bottom: 12px; border-bottom: 1px solid #f3f4f6;">
                                <div style="width: 60px; height: 60px; border-radius: 8px; overflow: hidden; background-color: #f3f4f6; flex-shrink: 0;">
                                    @if($item->listing->image_url)
                                        <img src="{{ asset($item->listing->image_url) }}" alt="{{ $item->listing->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                                    @endif
                                </div>
                                <div style="flex: 1;">
                                    <p style="font-size: 14px; font-weight: 600; color: #1f2937; margin-bottom: 4px;">
                                        {{ Str::limit($item->listing->title, 25) }}
                                    </p>
                                    <p style="font-size: 12px; color: #6b7280;">Qty: {{ $item->quantity }}</p>
                                    <p style="font-size: 14px; font-weight: 600; color: #f97316;">৳{{ number_format($item->subtotal, 2) }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                        <div style="border-top: 2px solid #e5e7eb; padding-top: 12px; margin-bottom: 16px;">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 8px;">
                                <span style="color: #6b7280; font-size: 14px;">Items ({{ $stats['cart_items'] }})</span>
                                <span style="font-weight: 600; color: #1f2937; font-size: 14px;">৳{{ number_format($stats['cart_total'], 2) }}</span>
                            </div>
                        </div>
                        
                        <a href="{{ route('cart.index') }}" style="display: block; width: 100%; padding: 12px; background-color: #14b8a6; color: white; text-align: center; border-radius: 8px; font-weight: 600; text-decoration: none; margin-bottom: 8px;">
                            View Cart
                        </a>
                        <a href="{{ route('checkout.index') }}" style="display: block; width: 100%; padding: 12px; background-color: #f97316; color: white; text-align: center; border-radius: 8px; font-weight: 600; text-decoration: none;">
                            Checkout Now
                        </a>
                    @else
                        <div style="text-align: center; padding: 20px;">
                            <svg style="width: 48px; height: 48px; margin: 0 auto 12px; color: #d1d5db;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <p style="color: #6b7280; font-size: 14px; margin-bottom: 12px;">Your cart is empty</p>
                            <a href="{{ route('listings.index') }}" style="color: #14b8a6; font-size: 14px; font-weight: 600; text-decoration: none;">
                                Browse Animals →
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Quick Actions -->
                <div style="background: white; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 24px; margin-bottom: 24px;">
                    <h2 style="font-size: 18px; font-weight: bold; color: #1f2937; margin-bottom: 16px;">Quick Actions</h2>
                    
                    <a href="{{ route('listings.index') }}" style="display: flex; align-items: center; padding: 12px; border-radius: 8px; text-decoration: none; margin-bottom: 8px; border: 1px solid #e5e7eb; transition: background-color 0.3s;">
                        <svg style="width: 20px; height: 20px; color: #14b8a6; margin-right: 12px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <span style="color: #1f2937; font-weight: 500; font-size: 14px;">Browse All Animals</span>
                    </a>

                    <a href="{{ route('users.trackorder', ['user' => $buyer->id]) }}" style="display: flex; align-items: center; padding: 12px; border-radius: 8px; text-decoration: none; margin-bottom: 8px; border: 1px solid #e5e7eb; transition: background-color 0.3s;">
                        <svg style="width: 20px; height: 20px; color: #14b8a6; margin-right: 12px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span style="color: #1f2937; font-weight: 500; font-size: 14px;">Track My Orders</span>
                    </a>

                    <a href="{{ route('cart.index') }}" style="display: flex; align-items: center; padding: 12px; border-radius: 8px; text-decoration: none; margin-bottom: 8px; border: 1px solid #e5e7eb; transition: background-color 0.3s;">
                        <svg style="width: 20px; height: 20px; color: #14b8a6; margin-right: 12px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span style="color: #1f2937; font-weight: 500; font-size: 14px;">My Shopping Cart</span>
                    </a>
                </div>

                <!-- Account Info -->
                <div style="background: linear-gradient(135deg, #14b8a6 0%, #134e4a 100%); border-radius: 12px; padding: 24px; color: white;">
                    <h3 style="font-size: 16px; font-weight: bold; margin-bottom: 12px;">Account Information</h3>
                    <div style="margin-bottom: 8px;">
                        <p style="font-size: 13px; opacity: 0.9; margin-bottom: 4px;">Email</p>
                        <p style="font-size: 14px; font-weight: 600;">{{ $buyer->email }}</p>
                    </div>
                    <div style="margin-bottom: 8px;">
                        <p style="font-size: 13px; opacity: 0.9; margin-bottom: 4px;">Phone</p>
                        <p style="font-size: 14px; font-weight: 600;">{{ $buyer->phone ?? 'Not set' }}</p>
                    </div>
                    <div style="margin-bottom: 16px;">
                        <p style="font-size: 13px; opacity: 0.9; margin-bottom: 4px;">Address</p>
                        <p style="font-size: 14px; font-weight: 600;">{{ $buyer->address ?? 'Not set' }}</p>
                    </div>
                    <a href="#" style="display: block; text-align: center; padding: 10px; background-color: rgba(255,255,255,0.2); border-radius: 8px; color: white; font-weight: 600; text-decoration: none; font-size: 14px;">
                        Edit Profile
                    </a>
                </div>
            </div>
        </div>

        <!-- Recommended Listings -->
        @if($recommendedListings->count() > 0)
        <div style="margin-top: 40px;">
            <h2 style="font-size: 24px; font-weight: bold; color: #1f2937; margin-bottom: 24px;">Recommended for You</h2>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px;">
                @foreach($recommendedListings as $listing)
                <a href="{{ route('listings.show', $listing->id) }}" style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.1); text-decoration: none; transition: transform 0.3s, box-shadow 0.3s;">
                    <div style="height: 200px; background-color: #f3f4f6; overflow: hidden;">
                        @if($listing->image_url)
                            <img src="{{ asset($listing->image_url) }}" alt="{{ $listing->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: #9ca3af;">
                                <span>No Image</span>
                            </div>
                        @endif
                    </div>
                    <div style="padding: 16px;">
                        <span style="display: inline-block; padding: 4px 12px; background-color: #f0fdfa; color: #14b8a6; border-radius: 12px; font-size: 12px; font-weight: 600; margin-bottom: 8px;">
                            {{ ucfirst($listing->category) }}
                        </span>
                        <h3 style="font-size: 16px; font-weight: 600; color: #1f2937; margin-bottom: 8px;">{{ $listing->title }}</h3>
                        <p style="color: #6b7280; font-size: 14px; margin-bottom: 12px;">{{ Str::limit($listing->description, 60) }}</p>
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="font-size: 20px; font-weight: bold; color: #f97316;">৳{{ number_format($listing->price, 2) }}</span>
                            <span style="color: #6b7280; font-size: 13px;">{{ $listing->weight }} kg</span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

<style>
    /* Hover effects */
    a[href="{{ route('listings.index') }}"]:hover,
    a[href="{{ route('users.trackorder', ['user' => $buyer->id]) }}"]:hover,
    a[href="{{ route('cart.index') }}"]:hover {
        background-color: #f9fafb !important;
    }

    .listing-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15) !important;
    }
</style>
@endsection
