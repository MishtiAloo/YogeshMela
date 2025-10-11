@extends('layouts.app')

@section('title', 'Admin Dashboard - YogeshMela')

@section('content')
<style>
    .dashboard-container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 20px;
    }

    h1 {
        margin-bottom: 2rem;
        color: #2d3748;
    }

    .section {
        margin-bottom: 2rem;
        padding: 1rem;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .section h2 {
        margin-bottom: 1rem;
        color: #667eea;
    }

    .filters {
        margin-bottom: 1rem;
    }

    .filters select, .filters button {
        margin-right: 1rem;
        padding: 0.5rem;
        border: 1px solid #ddd;
        border-radius: 3px;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 1rem;
    }

    .table th,
    .table td {
        border: 1px solid #ddd;
        padding: 0.75rem 1rem;
        text-align: left;
    }

    .table th {
        background-color: #667eea;
        color: white;
    }

    .btn {
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: 600;
        transition: background-color 0.3s ease;
        text-decoration: none;
        color: white;
        display: inline-block;
    }

    .btn-verify {
        background-color: #48bb78;
    }

    .btn-verify:hover {
        background-color: #2f855a;
    }

    .btn-deny {
        background-color: #e53e3e;
    }

    .btn-deny:hover {
        background-color: #9b2c2c;
    }

    .btn-attach {
        background-color: #4299e1;
    }

    .btn-attach:hover {
        background-color: #2b6cb0;
    }

    form {
        margin: 0;
        display: inline;
    }
</style>

<div class="dashboard-container">
    <h1>Admin Dashboard</h1>

    @if(session('success'))
        <div class="alert alert-success" style="padding: 1rem; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 5px; margin-bottom: 1rem;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Sellers Section -->
    <div class="section">
        <h2>Sellers</h2>
        <div class="filters">
            <form method="GET" action="{{ route('admin.dashboard') }}">
                <select name="seller_verified">
                    <option value="">All</option>
                    <option value="verified" {{ request('seller_verified') == 'verified' ? 'selected' : '' }}>Verified</option>
                    <option value="pending" {{ request('seller_verified') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="unverified" {{ request('seller_verified') == 'unverified' ? 'selected' : '' }}>Unverified</option>
                </select>
                
                <button type="submit" class="btn btn-verify">Filter</button>
            </form>
        </div>
        @if($sellers->isEmpty())
            <p>No sellers found.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Verified</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sellers as $seller)
                    <tr>
                        <td>{{ $seller->name }}</td>
                        <td>{{ $seller->email }}</td>
                        <td>{{ $seller->phone ?? '-' }}</td>
                        <td>{{ ucfirst($seller->verified) }}</td>

                        <td>
                            @if($seller->verified === 'pending')
                                <form action="{{ route('users.update', $seller->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="verified" value="verified">
                                    <button type="submit" class="btn btn-verify">Verify</button>
                                </form>
                            @elseif($seller->verified === 'verified')
                                <form action="{{ route('users.update', $seller->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="verified" value="unverified">
                                    <button type="submit" class="btn btn-deny">Unverify</button>
                                </form>
                            @endif
                        </td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <!-- Listings Section -->
    <div class="section">
        <h2>Listings</h2>

        @if($listings->isEmpty())
            <p>No listings found.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Animal Type</th>
                        <th>Breed</th>
                        <th>Price</th>
                        <th>Seller</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($listings as $listing)
                    <tr>
                        <td>{{ $listing->id }}</td>
                        <td>{{ ucfirst($listing->animal_type) }}</td>
                        <td>{{ $listing->breed ?? '-' }}</td>
                        <td>{{ number_format($listing->price, 2) }}</td>
                        <td>{{ $listing->seller->name ?? 'Unknown' }}</td>
                        <td>{{ ucfirst($listing->status) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <!-- Promotions Section -->
    <div class="section">
        <h2>Promotions</h2>

        <!-- Filter Form -->
        <div class="filters">
            <form method="GET" action="{{ route('admin.dashboard') }}">
                <select name="promotion_status">
                    <option value="">All</option>
                    <option value="pending" {{ request('promotion_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="active" {{ request('promotion_status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="expired" {{ request('promotion_status') == 'expired' ? 'selected' : '' }}>Expired</option>
                </select>
                <button type="submit" class="btn btn-verify">Filter</button>
            </form>
        </div>

        @if($promotions->isEmpty())
            <p>No promotions found.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Listing ID</th>
                        <th>Animal Type</th>
                        <th>Amount Paid</th>
                        <th>Fixed Discount</th>
                        <th>Percent Discount</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($promotions as $promotion)
                        <tr>
                            <td>{{ $promotion->listing->id ?? 'Unknown' }}</td>
                            <td>{{ $promotion->listing->animal_type ?? 'Unknown' }}</td>
                            <td>{{ number_format($promotion->amount_paid, 2) }}</td>
                            <td>{{ $promotion->fixed_discount ? number_format($promotion->fixed_discount, 2) : '-' }}</td>
                            <td>{{ $promotion->percent_discount ? $promotion->percent_discount . '%' : '-' }}</td>
                            <td>{{ $promotion->start_date }}</td>
                            <td>{{ $promotion->end_date }}</td>
                            <td>{{ ucfirst($promotion->status) }}</td>

                            <td>
                                @if($promotion->status === 'pending')
                                    <!-- Accept -->
                                    <form action="{{ route('promotions.update', $promotion->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="active">
                                        <button type="submit" class="btn btn-verify">Accept</button>
                                    </form>

                                    <!-- Reject -->
                                    <form action="{{ route('promotions.destroy', $promotion->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="status" value="declined">
                                        <button type="submit" class="btn btn-deny">Deny</button>
                                    </form>

                                @elseif($promotion->status === 'active')
                                    <!-- Delete -->
                                    <form action="{{ route('promotions.destroy', $promotion->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-deny">Delete</button>
                                    </form>

                                @elseif($promotion->status === 'expired')
                                    <span class="text-muted">No actions</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>


    <!-- Orders Section -->
    <div class="section">
        <h2>Orders</h2>
        <div class="filters">
            <form method="GET" action="{{ route('admin.dashboard') }}">
                <select name="order_status">
                    <option value="">All</option>
                    <option value="pending" {{ request('order_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ request('order_status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="delivered" {{ request('order_status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                </select>
                <button type="submit" class="btn btn-verify">Filter</button>
            </form>
        </div>
        @if($orders->isEmpty())
            <p>No orders found.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Buyer</th>
                        <th>Listing</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->buyer->name ?? 'Unknown' }}</td>
                        <td>{{ $order->listing->animal_type ?? 'Unknown' }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

</div>

<script>
function attachPromotion(listingId) {
    // Placeholder for attach promotion functionality
    alert('Attach promotion to listing ' + listingId);
}

function editPromotion(promotionId) {
    // Placeholder for edit promotion functionality
    alert('Edit promotion ' + promotionId);
}

function deletePromotion(promotionId) {
    // Placeholder for delete promotion functionality
    if (confirm('Are you sure you want to delete this promotion?')) {
        alert('Delete promotion ' + promotionId);
    }
}
</script>
@endsection
