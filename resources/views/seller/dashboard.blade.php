@extends('layouts.app')

@section('title', 'Seller Dashboard - YogeshMela')

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

    .listings-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 2rem;
    }

    .listings-table th,
    .listings-table td {
        border: 1px solid #ddd;
        padding: 0.75rem 1rem;
        text-align: left;
    }

    .listings-table th {
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

    .btn-edit {
        background-color: #4299e1;
    }

    .btn-edit:hover {
        background-color: #2b6cb0;
    }

    .btn-delete {
        background-color: #e53e3e;
    }

    .btn-delete:hover {
        background-color: #9b2c2c;
    }

    .btn-add {
        background-color: #48bb78;
        margin-bottom: 1rem;
    }

    .btn-add:hover {
        background-color: #2f855a;
    }

    form {
        margin: 0;
        display: inline;
    }
</style>

<div class="dashboard-container">
    <h1>Welcome, {{ $seller->name }}
        @if($seller->verified === 'verified')
            <span style="color: green; font-size: 0.8em;">✓ Verified</span>
        @elseif($seller->verified === 'pending')
            <span style="color: orange; font-size: 0.8em;">Pending Verification</span>
        @else
            <form action="{{ route('seller.request.verification') }}" method="POST" style="display: inline; margin-left: 1rem;">
                @csrf
                <button type="submit" class="btn btn-add" style="font-size: 0.8em; padding: 0.3rem 0.6rem;">Request Verification</button>
            </form>
        @endif
    </h1>

    @if(session('success'))
        <div style="background-color: #d4edda; color: #155724; padding: 1rem; border-radius: 5px; margin-bottom: 1rem;">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('seller.listings.create') }}" class="btn btn-add">Add New Listing</a>

    @if($listings->isEmpty())
        <p>You have no listings yet.</p>
    @else
        <table class="listings-table">
            <thead>
                <tr>
                    <th>Animal Type</th>
                    <th>Breed</th>
                    <th>Age (months)</th>
                    <th>Weight (kg)</th>
                    <th>Price (৳)</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th>Promo Stat</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($listings as $listing)
                <tr>
                    <td>{{ ucfirst($listing->animal_type) }}</td>
                    <td>{{ $listing->breed ?? '-' }}</td>
                    <td>{{ $listing->age }}</td>
                    <td>{{ $listing->weight }}</td>
                    <td>{{ number_format($listing->price, 2) }}</td>
                    <td>{{ $listing->location }}</td>
                    <td>{{ ucfirst($listing->status) }}
                        @if(isset($orders[$listing->id]))
                            @foreach($orders[$listing->id] as $order)
                                @if($order->status === 'confirmed')
                                    <br>
                                    <form action="{{ route('seller.orders.deliver', $order->id) }}" method="POST" style="display: inline; margin-top: 0.5rem;">
                                        @csrf
                                        <button type="submit" class="btn btn-add" style="font-size: 0.8em; padding: 0.3rem 0.6rem;">confirm Delivery</button>
                                    </form>
                                @endif
                            @endforeach
                        @endif
                    </td>
                    <td>
                        @if(isset($promotions[$listing->id]))
                            @php $promo = $promotions[$listing->id]; @endphp
                            @if($promo->status == 'pending')
                                Pending
                            @elseif($promo->status == 'active')
                                <a href="{{ route('seller.promotions.end', $promo->id) }}" class="btn btn-delete" onclick="return confirm('Are you sure you want to end this promotion?');">End Promo</a>
                                <a href="{{ route('seller.promotions.edit', $promo->id) }}" class="btn btn-edit">Edit Promo</a>
                            @elseif($promo->status == 'expired')
                                Expired
                            @endif
                        @else
                            <a href="{{ route('seller.promotions.attach', $listing->id) }}" class="btn btn-add">Attach Promo</a>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('seller.listings.edit', $listing->id) }}" class="btn btn-edit">Edit</a>
                        <form action="{{ route('seller.listings.destroy', $listing->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this listing?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
