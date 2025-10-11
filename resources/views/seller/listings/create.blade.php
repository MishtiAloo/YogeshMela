@extends('layouts.app')

@section('title', 'Add New Listing - Seller Dashboard')

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

    .alert {
        padding: 1rem;
        margin-bottom: 1rem;
        border-radius: 5px;
    }

    .alert-danger {
        background-color: #fee2e2;
        border: 1px solid #ef4444;
        color: #991b1b;
    }

    .alert-success {
        background-color: #d1fae5;
        border: 1px solid #10b981;
        color: #065f46;
    }

    .error-message {
        color: #dc2626;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }
</style>

<div class="container">
    <h1>Add New Listing</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>There were some errors with your submission:</strong>
            <ul style="margin: 0.5rem 0 0 0; padding-left: 1.5rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('seller.listings.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="animal_type">Animal Type</label>
            <select name="animal_type" id="animal_type" required class="form-control">
                <option value="">Select Type</option>
                <option value="cow" {{ old('animal_type') == 'cow' ? 'selected' : '' }}>Cow</option>
                <option value="goat" {{ old('animal_type') == 'goat' ? 'selected' : '' }}>Goat</option>
                <option value="sheep" {{ old('animal_type') == 'sheep' ? 'selected' : '' }}>Sheep</option>
                <option value="camel" {{ old('animal_type') == 'camel' ? 'selected' : '' }}>Camel</option>
            </select>
            @error('animal_type')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="breed">Breed</label>
            <input type="text" name="breed" id="breed" class="form-control" placeholder="Breed (optional)" value="{{ old('breed') }}">
            @error('breed')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="age">Age (months)</label>
            <input type="number" name="age" id="age" min="1" required class="form-control" value="{{ old('age') }}">
            @error('age')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="weight">Weight (kg)</label>
            <input type="number" name="weight" id="weight" min="1" step="0.1" required class="form-control" value="{{ old('weight') }}">
            @error('weight')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="price">Price (৳)</label>
            <input type="number" name="price" id="price" min="1" step="0.01" required class="form-control" value="{{ old('price') }}">
            @error('price')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" name="location" id="location" required class="form-control" value="{{ old('location') }}">
            @error('location')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="vaccination_info">Vaccination Info</label>
            <textarea name="vaccination_info" id="vaccination_info" class="form-control" rows="3" placeholder="Vaccination details (optional)">{{ old('vaccination_info') }}</textarea>
            @error('vaccination_info')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="image">Animal Image</label>
            <input type="file" name="image" id="image" accept="image/*" required class="form-control">
            @error('image')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" required class="form-control">
                <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                <option value="sold" {{ old('status') == 'sold' ? 'selected' : '' }}>Sold</option>
            </select>
            @error('status')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Add Listing</button>
        <a href="{{ route('seller.dashboard') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
