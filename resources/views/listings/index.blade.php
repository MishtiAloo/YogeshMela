@extends('layouts.app')

@section('title', 'Browse Animals - YogeshMela')

@section('content')
<style>
    .page-header {
        background: linear-gradient(135deg, #14b8a6 0%, #134e4a 100%);
        color: white;
        padding: 3rem 0;
        text-align: center;
        margin-bottom: 2rem;
    }

    .page-header h1 {
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
    }

    .page-header p {
        font-size: 1.1rem;
        opacity: 0.9;
    }

    .listings-container {
        display: grid;
        grid-template-columns: 300px 1fr;
        gap: 2rem;
        margin-bottom: 3rem;
    }

    /* Filters Sidebar */
    .filters-sidebar {
        background: white;
        padding: 1.5rem;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        height: fit-content;
        position: sticky;
        top: 20px;
    }

    .filters-sidebar h3 {
        font-size: 1.3rem;
        margin-bottom: 1.5rem;
        color: #2d3748;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .filter-group {
        margin-bottom: 1.5rem;
    }

    .filter-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #4a5568;
    }

    .filter-group select,
    .filter-group input {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #e2e8f0;
        border-radius: 5px;
        font-size: 0.95rem;
    }

    .filter-group select:focus,
    .filter-group input:focus {
        outline: none;
        border-color: #14b8a6;
    }

    .price-range-inputs {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.5rem;
    }

    .filter-buttons {
        display: flex;
        gap: 0.5rem;
        margin-top: 1.5rem;
    }

    .btn-filter {
        flex: 1;
        padding: 0.75rem;
        border: none;
        border-radius: 5px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-apply {
        background: linear-gradient(135deg, #14b8a6 0%, #134e4a 100%);
        color: white;
    }

    .btn-apply:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }

    .btn-clear {
        background: #e2e8f0;
        color: #4a5568;
    }

    .btn-clear:hover {
        background: #cbd5e0;
    }

    /* Listings Grid */
    .listings-main {
        min-height: 400px;
    }

    .results-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        padding: 1rem;
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .results-count {
        font-size: 1.1rem;
        color: #4a5568;
    }

    .results-count strong {
        color: #14b8a6;
    }

    .sort-controls {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .sort-controls label {
        font-weight: 600;
        color: #4a5568;
    }

    .sort-controls select {
        padding: 0.5rem 1rem;
        border: 1px solid #e2e8f0;
        border-radius: 5px;
        cursor: pointer;
    }

    .listings-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.5rem;
    }

    .listing-card {
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        transition: all 0.3s;
    }

    .listing-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }

    .listing-image {
        height: 180px;
        background: linear-gradient(135deg, #14b8a6 0%, #134e4a 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 4rem;
        position: relative;
    }

    .listing-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background: rgba(255, 255, 255, 0.95);
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        color: #14b8a6;
    }

    .listing-content {
        padding: 1.25rem;
    }

    .listing-type {
        display: inline-block;
        background: #14b8a6;
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.8rem;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
    }

    .verified-badge {
        display: inline-block;
        background: #4299e1;
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.8rem;
        margin-left: 0.5rem;
    }

    .listing-content h3 {
        font-size: 1.2rem;
        margin-bottom: 0.75rem;
        color: #2d3748;
        min-height: 2.4rem;
    }

    .listing-specs {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0.5rem;
        margin-bottom: 1rem;
        padding: 0.75rem;
        background: #f7fafc;
        border-radius: 5px;
    }

    .spec-item {
        font-size: 0.85rem;
        color: #4a5568;
    }

    .spec-item strong {
        color: #2d3748;
    }

    .listing-price {
        font-size: 1.5rem;
        font-weight: bold;
        color: #14b8a6;
        margin-bottom: 0.75rem;
    }

    .listing-location {
        color: #718096;
        font-size: 0.9rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .btn-view-details {
        width: 100%;
        padding: 0.75rem;
        background: linear-gradient(135deg, #14b8a6 0%, #134e4a 100%);
        color: white;
        border: none;
        border-radius: 5px;
        font-weight: 600;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        display: block;
        transition: all 0.3s;
    }

    .btn-view-details:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        color: white;
    }

    /* Pagination */
    .pagination-wrapper {
        margin-top: 2rem;
        display: flex;
        justify-content: center;
    }

    .pagination {
        display: flex;
        gap: 0.5rem;
        list-style: none;
        padding: 0;
    }

    .pagination li {
        display: inline-block;
    }

    .pagination a,
    .pagination span {
        display: block;
        padding: 0.5rem 1rem;
        border: 1px solid #e2e8f0;
        border-radius: 5px;
        color: #4a5568;
        text-decoration: none;
        transition: all 0.3s;
    }

    .pagination a:hover {
        background: #14b8a6;
        color: white;
        border-color: #14b8a6;
    }

    .pagination .active span {
        background: #14b8a6;
        color: white;
        border-color: #14b8a6;
    }

    .pagination .disabled span {
        color: #cbd5e0;
        cursor: not-allowed;
    }

    .no-results {
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .no-results-icon {
        font-size: 5rem;
        margin-bottom: 1rem;
    }

    .no-results h3 {
        font-size: 1.5rem;
        color: #2d3748;
        margin-bottom: 0.5rem;
    }

    .no-results p {
        color: #718096;
        margin-bottom: 1.5rem;
    }

    /* Active filters display */
    .active-filters {
        margin-bottom: 1rem;
        padding: 1rem;
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .active-filters h4 {
        font-size: 0.9rem;
        color: #4a5568;
        margin-bottom: 0.5rem;
    }

    .filter-tag {
        display: inline-block;
        background: #14b8a6;
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.85rem;
        margin-right: 0.5rem;
        margin-bottom: 0.5rem;
    }

    @media (max-width: 768px) {
        .listings-container {
            grid-template-columns: 1fr;
        }

        .filters-sidebar {
            position: static;
        }

        .results-header {
            flex-direction: column;
            gap: 1rem;
            align-items: flex-start;
        }
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1>🐄 Browse Animals</h1>
        <p>Find the perfect animal for Qurbani from verified sellers</p>
    </div>
</div>

<div class="container">
    <div class="listings-container">
        <!-- Filters Sidebar -->
        <aside class="filters-sidebar">
            <h3>🔍 Filters</h3>
            <form action="{{ route('listings.index') }}" method="GET" id="filterForm">
                
                <!-- Animal Type -->
                <div class="filter-group">
                    <label for="animal_type">Animal Type</label>
                    <select name="animal_type" id="animal_type">
                        <option value="">All Types</option>
                        <option value="cow" {{ request('animal_type') == 'cow' ? 'selected' : '' }}>🐄 Cow</option>
                        <option value="goat" {{ request('animal_type') == 'goat' ? 'selected' : '' }}>🐐 Goat</option>
                        <option value="sheep" {{ request('animal_type') == 'sheep' ? 'selected' : '' }}>🐑 Sheep</option>
                        <option value="camel" {{ request('animal_type') == 'camel' ? 'selected' : '' }}>🐫 Camel</option>
                    </select>
                </div>

                <!-- Location -->
                <div class="filter-group">
                    <label for="location">Location</label>
                    <input type="text" name="location" id="location" placeholder="e.g., Dhaka" value="{{ request('location') }}">
                </div>

                <!-- Breed -->
                <div class="filter-group">
                    <label for="breed">Breed</label>
                    <input type="text" name="breed" id="breed" placeholder="e.g., Holstein" value="{{ request('breed') }}">
                </div>

                <!-- Price Range -->
                <div class="filter-group">
                    <label>Price Range (৳)</label>
                    <div class="price-range-inputs">
                        <input type="number" name="min_price" placeholder="Min" value="{{ request('min_price') }}">
                        <input type="number" name="max_price" placeholder="Max" value="{{ request('max_price') }}">
                    </div>
                </div>

                <!-- Weight Range -->
                <div class="filter-group">
                    <label>Weight Range (kg)</label>
                    <div class="price-range-inputs">
                        <input type="number" name="min_weight" placeholder="Min" value="{{ request('min_weight') }}">
                        <input type="number" name="max_weight" placeholder="Max" value="{{ request('max_weight') }}">
                    </div>
                </div>

                <!-- Buttons -->
                <div class="filter-buttons">
                    <button type="submit" class="btn-filter btn-apply">Apply Filters</button>
                    <a href="{{ route('listings.index') }}" class="btn-filter btn-clear">Clear All</a>
                </div>
            </form>
        </aside>

        <!-- Main Listings Area -->
        <main class="listings-main">
            <!-- Results Header -->
            <div class="results-header">
                <div class="results-count">
                    Showing <strong>{{ $listings->count() }}</strong> of <strong>{{ $listings->total() }}</strong> animals
                </div>
                <div class="sort-controls">
                    <label for="sort">Sort by:</label>
                    <select id="sort" onchange="updateSort(this.value)">
                        <option value="created_at-desc" {{ request('sort_by') == 'created_at' && request('sort_order') == 'desc' ? 'selected' : '' }}>Newest First</option>
                        <option value="price-asc" {{ request('sort_by') == 'price' && request('sort_order') == 'asc' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="price-desc" {{ request('sort_by') == 'price' && request('sort_order') == 'desc' ? 'selected' : '' }}>Price: High to Low</option>
                        <option value="weight-desc" {{ request('sort_by') == 'weight' && request('sort_order') == 'desc' ? 'selected' : '' }}>Weight: High to Low</option>
                        <option value="age-desc" {{ request('sort_by') == 'age' && request('sort_order') == 'desc' ? 'selected' : '' }}>Age: Oldest First</option>
                    </select>
                </div>
            </div>

            <!-- Active Filters Display -->
            @if(request()->hasAny(['animal_type', 'location', 'breed', 'min_price', 'max_price', 'min_weight', 'max_weight']))
            <div class="active-filters">
                <h4>Active Filters:</h4>
                @if(request('animal_type'))
                    <span class="filter-tag">Type: {{ ucfirst(request('animal_type')) }}</span>
                @endif
                @if(request('location'))
                    <span class="filter-tag">Location: {{ request('location') }}</span>
                @endif
                @if(request('breed'))
                    <span class="filter-tag">Breed: {{ request('breed') }}</span>
                @endif
                @if(request('min_price'))
                    <span class="filter-tag">Min Price: ৳{{ number_format(request('min_price')) }}</span>
                @endif
                @if(request('max_price'))
                    <span class="filter-tag">Max Price: ৳{{ number_format(request('max_price')) }}</span>
                @endif
                @if(request('min_weight'))
                    <span class="filter-tag">Min Weight: {{ request('min_weight') }}kg</span>
                @endif
                @if(request('max_weight'))
                    <span class="filter-tag">Max Weight: {{ request('max_weight') }}kg</span>
                @endif
            </div>
            @endif

            <!-- Listings Grid -->
            @if($listings->count() > 0)
            <div class="listings-grid">
                @foreach($listings as $listing)
                <div class="listing-card">
                    <div class="listing-image">
                        @if($listing->animal_type === 'cow') 🐄
                        @elseif($listing->animal_type === 'goat') 🐐
                        @elseif($listing->animal_type === 'sheep') 🐑
                        @elseif($listing->animal_type === 'camel') 🐫
                        @endif
                        <span class="listing-badge">{{ ucfirst($listing->status) }}</span>
                    </div>
                    <div class="listing-content">
                        <div>
                            <span class="listing-type">{{ $listing->animal_type }}</span>
                            @if($listing->user->verified)
                                <span class="verified-badge">✓ Verified</span>
                            @endif
                        </div>
                        <h3>{{ $listing->breed }}</h3>
                        
                        <div class="listing-specs">
                            <div class="spec-item">
                                <strong>Age:</strong> {{ $listing->age }} months
                            </div>
                            <div class="spec-item">
                                <strong>Weight:</strong> {{ $listing->weight }} kg
                            </div>
                        </div>

                        <div class="listing-price">৳{{ number_format($listing->price, 2) }}</div>
                        <div class="listing-location">
                            📍 {{ $listing->location }}
                        </div>

                        <a href="/listings/{{ $listing->id }}" class="btn-view-details">View Details</a>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="pagination-wrapper">
                {{ $listings->links() }}
            </div>
            @else
            <!-- No Results -->
            <div class="no-results">
                <div class="no-results-icon">🔍</div>
                <h3>No animals found</h3>
                <p>Try adjusting your filters or browse all available animals</p>
                <a href="{{ route('listings.index') }}" class="btn btn-primary">View All Animals</a>
            </div>
            @endif
        </main>
    </div>
</div>

<script>
    function updateSort(value) {
        const [sortBy, sortOrder] = value.split('-');
        const url = new URL(window.location.href);
        url.searchParams.set('sort_by', sortBy);
        url.searchParams.set('sort_order', sortOrder);
        window.location.href = url.toString();
    }
</script>
@endsection
