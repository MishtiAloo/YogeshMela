@extends('layouts.app')

@section('title', 'Edit Promotion - Seller Dashboard')

@section('content')
<style>
    main .container {
        max-width: 700px;
        margin: 2rem auto;
        padding: 0 20px;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: #2d3748;
    }

    .form-control {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 1rem;
        font-family: inherit;
    }

    .form-control:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .btn {
        display: inline-block;
        padding: 0.75rem 1.5rem;
        border-radius: 5px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s;
        border: none;
        cursor: pointer;
        margin-right: 1rem;
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }

    .btn-secondary {
        background: #e2e8f0;
        color: #4a5568;
    }

    .btn-secondary:hover {
        background: #cbd5e0;
    }
</style>

<div class="container">
    <h1>Edit Promotion</h1>
    <p>Listing: {{ $promotion->listing->animal_type }} - {{ $promotion->listing->breed ?? 'No breed' }} - {{ $promotion->listing->location }}</p>

    <form action="{{ route('seller.promotions.update', $promotion) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="amount_paid">Amount Paid (৳)</label>
            <input type="number" name="amount_paid" id="amount_paid" min="0" step="0.01" value="{{ $promotion->amount_paid }}" required class="form-control">
        </div>

        <div class="form-group">
            <label for="fixed_discount">Fixed Discount (৳)</label>
            <input type="number" name="fixed_discount" id="fixed_discount" min="0" step="0.01" value="{{ $promotion->fixed_discount }}" class="form-control" placeholder="Optional">
        </div>

        <div class="form-group">
            <label for="percent_discount">Percent Discount (%)</label>
            <input type="number" name="percent_discount" id="percent_discount" min="0" max="100" step="0.01" value="{{ $promotion->percent_discount }}" class="form-control" placeholder="Optional">
        </div>

        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" id="start_date" value="{{ $promotion->start_date }}" required class="form-control">
        </div>

        <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date" name="end_date" id="end_date" value="{{ $promotion->end_date }}" required class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update Promotion</button>
        <a href="{{ route('seller.dashboard') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
