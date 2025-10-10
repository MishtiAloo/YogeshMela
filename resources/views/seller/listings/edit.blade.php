@extends('layouts.app')

@section('title', 'Edit Listing - Seller Dashboard')

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

    .btn-danger {
        background: #e53e3e;
        color: white;
    }

    .btn-danger:hover {
        background: #c53030;
    }
</style>

<div class="container">
    <h1>Edit Listing</h1>

    <form action="{{ route('seller.listings.update', $listing->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="animal_type">Animal Type</label>
            <select name="animal_type" id="animal_type" required class="form-control">
                <option value="cow" {{ $listing->animal_type == 'cow' ? 'selected' : '' }}>Cow</option>
                <option value="goat" {{ $listing->animal_type == 'goat' ? 'selected' : '' }}>Goat</option>
                <option value="sheep" {{ $listing->animal_type == 'sheep' ? 'selected' : '' }}>Sheep</option>
                <option value="camel" {{ $listing->animal_type == 'camel' ? 'selected' : '' }}>Camel</option>
            </select>
        </div>

        <div class="form-group">
            <label for="breed">Breed</label>
            <input type="text" name="breed" id="breed" value="{{ $listing->breed }}" class="form-control" placeholder="Breed (optional)">
        </div>

        <div class="form-group">
            <label for="age">Age (months)</label>
            <input type="number" name="age" id="age" min="1" value="{{ $listing->age }}" required class="form-control">
        </div>

        <div class="form-group">
            <label for="weight">Weight (kg)</label>
            <input type="number" name="weight" id="weight" min="1" step="0.1" value="{{ $listing->weight }}" required class="form-control">
        </div>

        <div class="form-group">
            <label for="price">Price (৳)</label>
            <input type="number" name="price" id="price" min="1" step="0.01" value="{{ $listing->price }}" required class="form-control">
        </div>

        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" name="location" id="location" value="{{ $listing->location }}" required class="form-control">
        </div>

        <div class="form-group">
            <label for="vaccination_info">Vaccination Info</label>
            <textarea name="vaccination_info" id="vaccination_info" class="form-control" rows="3" placeholder="Vaccination details (optional)">{{ $listing->vaccination_info }}</textarea>
        </div>

        <div class="form-group">
            <label for="image">Animal Image</label>
            @if($listing->image)
                <div style="margin-bottom: 1rem;">
                    @if(str_starts_with($listing->image, 'image/'))
                        <img src="{{ asset($listing->image) }}" alt="Current Image" style="max-width: 200px; max-height: 200px; border: 1px solid #ddd; border-radius: 5px;">
                    @else
                        <img src="{{ asset('storage/' . $listing->image) }}" alt="Current Image" style="max-width: 200px; max-height: 200px; border: 1px solid #ddd; border-radius: 5px;">
                    @endif
                    <p style="margin-top: 0.5rem; font-size: 0.9rem; color: #666;">Current image. Upload a new one to replace it.</p>
                </div>
            @endif
            <input type="file" name="image" id="image" accept="image/*" class="form-control">
            <small style="color: #666;">Leave empty to keep current image. Max 2MB, JPEG/PNG/GIF only.</small>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" required class="form-control">
                <option value="available" {{ $listing->status == 'available' ? 'selected' : '' }}>Available</option>
                <option value="sold" {{ $listing->status == 'sold' ? 'selected' : '' }}>Sold</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Listing</button>
        <a href="{{ route('seller.dashboard') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
