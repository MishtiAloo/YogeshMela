@extends('layouts.app')

@section('content')
<div style="background-color: #f9fafb; min-height: 100vh; padding: 40px 0;">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <!-- Page Header -->
        <div style="margin-bottom: 40px;">
            <h1 style="font-size: 32px; font-weight: bold; color: #1f2937; margin-bottom: 8px;">Checkout</h1>
            <p style="color: #6b7280; font-size: 16px;">Complete your order</p>
        </div>

        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px;">
            <!-- Checkout Form -->
            <div>
                <!-- Delivery Information -->
                <div style="background-color: white; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 24px; margin-bottom: 24px;">
                    <h2 style="font-size: 20px; font-weight: bold; color: #1f2937; margin-bottom: 20px;">Delivery Information</h2>
                    
                    <form>
                        <div style="margin-bottom: 16px;">
                            <label style="display: block; color: #1f2937; font-weight: 500; margin-bottom: 6px;">Full Name</label>
                            <input type="text" name="name" value="{{ auth()->user()->name ?? '' }}" style="width: 100%; padding: 10px 14px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; color: #1f2937;">
                        </div>

                        <div style="margin-bottom: 16px;">
                            <label style="display: block; color: #1f2937; font-weight: 500; margin-bottom: 6px;">Phone Number</label>
                            <input type="tel" name="phone" value="{{ auth()->user()->phone ?? '' }}" style="width: 100%; padding: 10px 14px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; color: #1f2937;">
                        </div>

                        <div style="margin-bottom: 16px;">
                            <label style="display: block; color: #1f2937; font-weight: 500; margin-bottom: 6px;">Email</label>
                            <input type="email" name="email" value="{{ auth()->user()->email ?? '' }}" style="width: 100%; padding: 10px 14px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; color: #1f2937;">
                        </div>

                        <div style="margin-bottom: 16px;">
                            <label style="display: block; color: #1f2937; font-weight: 500; margin-bottom: 6px;">Delivery Address</label>
                            <textarea name="address" rows="3" style="width: 100%; padding: 10px 14px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; color: #1f2937; resize: vertical;"></textarea>
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                            <div>
                                <label style="display: block; color: #1f2937; font-weight: 500; margin-bottom: 6px;">City</label>
                                <input type="text" name="city" style="width: 100%; padding: 10px 14px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; color: #1f2937;">
                            </div>
                            <div>
                                <label style="display: block; color: #1f2937; font-weight: 500; margin-bottom: 6px;">Postal Code</label>
                                <input type="text" name="postal_code" style="width: 100%; padding: 10px 14px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; color: #1f2937;">
                            </div>
                        </div>

                        <div style="margin-bottom: 16px;">
                            <label style="display: block; color: #1f2937; font-weight: 500; margin-bottom: 6px;">Delivery Notes (Optional)</label>
                            <textarea name="notes" rows="2" placeholder="Any special instructions for delivery..." style="width: 100%; padding: 10px 14px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; color: #1f2937; resize: vertical;"></textarea>
                        </div>
                    </form>
                </div>

                <!-- Payment Method -->
                <div style="background-color: white; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 24px; margin-bottom: 24px;">
                    <h2 style="font-size: 20px; font-weight: bold; color: #1f2937; margin-bottom: 20px;">Payment Method</h2>
                    
                    <div style="display: grid; gap: 12px;">
                        <label style="display: flex; align-items: center; padding: 16px; border: 2px solid #e5e7eb; border-radius: 8px; cursor: pointer; transition: border-color 0.3s;">
                            <input type="radio" name="payment_method" value="cash" checked style="margin-right: 12px; width: 20px; height: 20px;">
                            <div>
                                <div style="font-weight: 600; color: #1f2937;">Cash on Delivery</div>
                                <div style="font-size: 14px; color: #6b7280;">Pay when you receive your order</div>
                            </div>
                        </label>

                        <label style="display: flex; align-items: center; padding: 16px; border: 2px solid #e5e7eb; border-radius: 8px; cursor: pointer; transition: border-color 0.3s;">
                            <input type="radio" name="payment_method" value="bkash" style="margin-right: 12px; width: 20px; height: 20px;">
                            <div>
                                <div style="font-weight: 600; color: #1f2937;">bKash</div>
                                <div style="font-size: 14px; color: #6b7280;">Mobile payment via bKash</div>
                            </div>
                        </label>

                        <label style="display: flex; align-items: center; padding: 16px; border: 2px solid #e5e7eb; border-radius: 8px; cursor: pointer; transition: border-color 0.3s;">
                            <input type="radio" name="payment_method" value="nagad" style="margin-right: 12px; width: 20px; height: 20px;">
                            <div>
                                <div style="font-weight: 600; color: #1f2937;">Nagad</div>
                                <div style="font-size: 14px; color: #6b7280;">Mobile payment via Nagad</div>
                            </div>
                        </label>

                        <label style="display: flex; align-items: center; padding: 16px; border: 2px solid #e5e7eb; border-radius: 8px; cursor: pointer; transition: border-color 0.3s;">
                            <input type="radio" name="payment_method" value="bank" style="margin-right: 12px; width: 20px; height: 20px;">
                            <div>
                                <div style="font-weight: 600; color: #1f2937;">Bank Transfer</div>
                                <div style="font-size: 14px; color: #6b7280;">Direct bank account transfer</div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Additional Services -->
                <div style="background-color: white; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 24px;">
                    <h2 style="font-size: 20px; font-weight: bold; color: #1f2937; margin-bottom: 20px;">Additional Services</h2>
                    
                    <div style="display: grid; gap: 12px;">
                        <label style="display: flex; align-items: center; padding: 16px; border: 2px solid #e5e7eb; border-radius: 8px; cursor: pointer;">
                            <input type="checkbox" name="butcher_service" style="margin-right: 12px; width: 18px; height: 18px;">
                            <div style="flex: 1;">
                                <div style="font-weight: 600; color: #1f2937;">Butcher Service</div>
                                <div style="font-size: 14px; color: #6b7280;">Professional butchering at your location</div>
                            </div>
                            <div style="font-weight: 600; color: #f97316;">+৳500</div>
                        </label>

                        <label style="display: flex; align-items: center; padding: 16px; border: 2px solid #e5e7eb; border-radius: 8px; cursor: pointer;">
                            <input type="checkbox" name="home_delivery" style="margin-right: 12px; width: 18px; height: 18px;">
                            <div style="flex: 1;">
                                <div style="font-weight: 600; color: #1f2937;">Home Delivery</div>
                                <div style="font-size: 14px; color: #6b7280;">Delivery to your doorstep</div>
                            </div>
                            <div style="font-weight: 600; color: #f97316;">+৳300</div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Order Summary Sidebar -->
            <div>
                <div style="background-color: white; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 24px; position: sticky; top: 20px;">
                    <h2 style="font-size: 20px; font-weight: bold; color: #1f2937; margin-bottom: 20px;">Order Summary</h2>
                    
                    <!-- Cart Items Summary -->
                    @php
                        $cartItems = App\Models\Cart::with('listing')->where('user_id', auth()->id())->get();
                        $subtotal = $cartItems->sum('subtotal');
                    @endphp

                    <div style="border-bottom: 1px solid #e5e7eb; padding-bottom: 16px; margin-bottom: 16px;">
                        @foreach($cartItems as $item)
                        <div style="display: flex; justify-content: space-between; margin-bottom: 12px;">
                            <div style="flex: 1;">
                                <div style="font-weight: 500; color: #1f2937; font-size: 14px;">{{ Str::limit($item->listing->title, 30) }}</div>
                                <div style="color: #6b7280; font-size: 12px;">Qty: {{ $item->quantity }}</div>
                            </div>
                            <div style="font-weight: 500; color: #1f2937; font-size: 14px;">৳{{ number_format($item->subtotal, 2) }}</div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Cost Breakdown -->
                    <div style="border-bottom: 1px solid #e5e7eb; padding-bottom: 16px; margin-bottom: 16px;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 12px;">
                            <span style="color: #6b7280; font-size: 14px;">Subtotal</span>
                            <span style="color: #1f2937; font-weight: 500;">৳{{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 12px;">
                            <span style="color: #6b7280; font-size: 14px;">Delivery Fee</span>
                            <span style="color: #1f2937; font-weight: 500;">৳300</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 12px;">
                            <span style="color: #6b7280; font-size: 14px;">Additional Services</span>
                            <span style="color: #1f2937; font-weight: 500;">৳0</span>
                        </div>
                    </div>

                    <div style="display: flex; justify-content: space-between; margin-bottom: 24px;">
                        <span style="font-size: 18px; font-weight: bold; color: #1f2937;">Total</span>
                        <span style="font-size: 24px; font-weight: bold; color: #f97316;">৳{{ number_format($subtotal + 300, 2) }}</span>
                    </div>

                    <button style="width: 100%; padding: 14px 24px; background-color: #14b8a6; color: white; border: none; border-radius: 8px; font-weight: 600; font-size: 16px; cursor: pointer; transition: background-color 0.3s;">
                        Place Order
                    </button>

                    <a href="{{ route('cart.index') }}" style="display: block; width: 100%; padding: 14px 24px; background-color: white; color: #14b8a6; text-align: center; border-radius: 8px; font-weight: 600; text-decoration: none; border: 2px solid #14b8a6; margin-top: 12px; transition: background-color 0.3s;">
                        Back to Cart
                    </a>

                    <!-- Security Badge -->
                    <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #e5e7eb; text-align: center;">
                        <div style="color: #6b7280; font-size: 12px; display: flex; align-items: center; justify-content: center; gap: 6px;">
                            <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            <span>Secure checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Radio button hover effect */
    label:has(input[type="radio"]):hover,
    label:has(input[type="checkbox"]):hover {
        border-color: #14b8a6 !important;
    }

    /* Radio button checked state */
    label:has(input[type="radio"]:checked) {
        border-color: #14b8a6 !important;
        background-color: #f0fdfa !important;
    }

    /* Button hover */
    button[style*="background-color: #14b8a6"]:hover {
        background-color: #0d9488 !important;
    }

    a[href="{{ route('cart.index') }}"]:hover {
        background-color: #f0fdfa !important;
    }
</style>
@endsection
