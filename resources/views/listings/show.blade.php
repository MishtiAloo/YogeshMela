@extends('layouts.app')

@section('title', $listing->breed . ' - ' . ucfirst($listing->animal_type) . ' - YogeshMela')

@section('content')
<style>
    .details-container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 1rem;
    }

    .breadcrumb {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 2rem;
        font-size: 0.9rem;
        color: #718096;
    }

    .breadcrumb a {
        color: #667eea;
        text-decoration: none;
    }

    .breadcrumb a:hover {
        text-decoration: underline;
    }

    .listing-detail-grid {
        display: grid;
        grid-template-columns: 1fr 400px;
        gap: 2rem;
        margin-bottom: 3rem;
    }

    /* Image Gallery */
    .image-section {
        background: white;
        border-radius: 10px;
        padding: 2rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .main-image {
        width: 100%;
        height: 500px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10rem;
        margin-bottom: 1rem;
        position: relative;
    }

    .status-badge-large {
        position: absolute;
        top: 20px;
        right: 20px;
        background: rgba(255, 255, 255, 0.95);
        padding: 0.5rem 1.5rem;
        border-radius: 30px;
        font-size: 1rem;
        font-weight: 600;
        color: #667eea;
        box-shadow: 0 2px 10px rgba(0,0,0,0.2);
    }

    .status-badge-large.sold {
        background: rgba(239, 68, 68, 0.95);
        color: white;
    }

    /* Sidebar */
    .sidebar-info {
        position: sticky;
        top: 20px;
        height: fit-content;
    }

    .price-card {
        background: white;
        border-radius: 10px;
        padding: 2rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        margin-bottom: 1.5rem;
    }

    .price-tag {
        font-size: 2.5rem;
        font-weight: bold;
        color: #667eea;
        margin-bottom: 1rem;
    }

    .availability {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
        padding: 0.75rem;
        background: #f0fdf4;
        border-radius: 5px;
        border-left: 4px solid #48bb78;
    }

    .availability.not-available {
        background: #fef2f2;
        border-left-color: #ef4444;
    }

    .availability-icon {
        font-size: 1.5rem;
    }

    .availability-text {
        font-weight: 600;
        color: #166534;
    }

    .availability.not-available .availability-text {
        color: #991b1b;
    }

    .btn-cart {
        width: 100%;
        padding: 1rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        margin-bottom: 0.75rem;
        transition: all 0.3s;
    }

    .btn-cart:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }

    .btn-cart:disabled {
        background: #cbd5e0;
        cursor: not-allowed;
        transform: none;
    }

    .btn-contact {
        width: 100%;
        padding: 1rem;
        background: white;
        color: #667eea;
        border: 2px solid #667eea;
        border-radius: 5px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-contact:hover {
        background: #667eea;
        color: white;
    }

    .seller-card {
        background: white;
        border-radius: 10px;
        padding: 1.5rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .seller-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .seller-avatar {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        font-weight: bold;
    }

    .seller-info h3 {
        font-size: 1.1rem;
        margin-bottom: 0.25rem;
        color: #2d3748;
    }

    .verified-seller {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        background: #4299e1;
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.85rem;
    }

    .seller-details {
        padding-top: 1rem;
        border-top: 1px solid #e2e8f0;
    }

    .seller-detail-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.75rem;
        color: #4a5568;
    }

    /* Details Section */
    .details-section {
        background: white;
        border-radius: 10px;
        padding: 2rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        margin-bottom: 2rem;
    }

    .details-section h2 {
        font-size: 1.8rem;
        margin-bottom: 1.5rem;
        color: #2d3748;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .animal-type-badge {
        display: inline-block;
        background: #667eea;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 25px;
        font-size: 1rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .specs-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin: 2rem 0;
    }

    .spec-card {
        background: #f7fafc;
        padding: 1.5rem;
        border-radius: 10px;
        border-left: 4px solid #667eea;
    }

    .spec-label {
        font-size: 0.9rem;
        color: #718096;
        margin-bottom: 0.5rem;
    }

    .spec-value {
        font-size: 1.5rem;
        font-weight: bold;
        color: #2d3748;
    }

    .description {
        line-height: 1.8;
        color: #4a5568;
        margin-top: 1.5rem;
    }

    .vaccination-info {
        background: #edf2f7;
        padding: 1.5rem;
        border-radius: 10px;
        margin-top: 1.5rem;
    }

    .vaccination-info h3 {
        font-size: 1.2rem;
        margin-bottom: 1rem;
        color: #2d3748;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* Reviews Section */
    .reviews-section {
        background: white;
        border-radius: 10px;
        padding: 2rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        margin-bottom: 2rem;
    }

    .reviews-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .reviews-header h2 {
        font-size: 1.8rem;
        color: #2d3748;
    }

    .rating-summary {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .rating-number {
        font-size: 3rem;
        font-weight: bold;
        color: #667eea;
    }

    .rating-stars {
        color: #fbbf24;
        font-size: 1.5rem;
    }

    .rating-count {
        color: #718096;
        font-size: 0.9rem;
    }

    .review-item {
        padding: 1.5rem;
        border-bottom: 1px solid #e2e8f0;
    }

    .review-item:last-child {
        border-bottom: none;
    }

    .review-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.75rem;
    }

    .reviewer-name {
        font-weight: 600;
        color: #2d3748;
    }

    .review-date {
        color: #a0aec0;
        font-size: 0.85rem;
    }

    .review-rating {
        color: #fbbf24;
        margin-bottom: 0.5rem;
    }

    .review-text {
        color: #4a5568;
        line-height: 1.6;
    }

    .no-reviews {
        text-align: center;
        padding: 3rem;
        color: #a0aec0;
    }

    .add-review-btn {
        width: 100%;
        padding: 1rem;
        background: white;
        color: #667eea;
        border: 2px dashed #667eea;
        border-radius: 5px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        margin-top: 1rem;
    }

    .add-review-btn:hover {
        background: #f7fafc;
    }

    /* Related Listings */
    .related-section {
        margin-top: 3rem;
    }

    .related-section h2 {
        font-size: 1.8rem;
        margin-bottom: 1.5rem;
        color: #2d3748;
    }

    .related-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .related-card {
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        transition: all 0.3s;
        text-decoration: none;
        color: inherit;
    }

    .related-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }

    .related-image {
        height: 150px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
    }

    .related-content {
        padding: 1rem;
    }

    .related-content h3 {
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
        color: #2d3748;
    }

    .related-price {
        font-size: 1.3rem;
        font-weight: bold;
        color: #667eea;
        margin-bottom: 0.5rem;
    }

    .related-location {
        font-size: 0.85rem;
        color: #718096;
    }

    @media (max-width: 768px) {
        .listing-detail-grid {
            grid-template-columns: 1fr;
        }

        .sidebar-info {
            position: static;
        }

        .main-image {
            height: 300px;
            font-size: 6rem;
        }

        .specs-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="details-container">
    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="/">Home</a> / 
        <a href="/listings">Browse Animals</a> / 
        <a href="/listings?animal_type={{ $listing->animal_type }}">{{ ucfirst($listing->animal_type) }}</a> / 
        <span>{{ $listing->breed }}</span>
    </div>

    <!-- Main Content Grid -->
    <div class="listing-detail-grid">
        <!-- Left: Image & Details -->
        <div>
            <!-- Image Section -->
            <div class="image-section">
                <div class="main-image">
                    @if($listing->animal_type === 'cow') 🐄
                    @elseif($listing->animal_type === 'goat') 🐐
                    @elseif($listing->animal_type === 'sheep') 🐑
                    @elseif($listing->animal_type === 'camel') 🐫
                    @endif
                    <span class="status-badge-large {{ $listing->status === 'sold' ? 'sold' : '' }}">
                        {{ ucfirst($listing->status) }}
                    </span>
                </div>
            </div>

            <!-- Details Section -->
            <div class="details-section">
                <h2>
                    <span class="animal-type-badge">{{ $listing->animal_type }}</span>
                    {{ $listing->breed }}
                </h2>

                <!-- Specifications Grid -->
                <div class="specs-grid">
                    <div class="spec-card">
                        <div class="spec-label">Age</div>
                        <div class="spec-value">{{ $listing->age }} <small style="font-size: 1rem; font-weight: normal;">months</small></div>
                    </div>
                    <div class="spec-card">
                        <div class="spec-label">Weight</div>
                        <div class="spec-value">{{ $listing->weight }} <small style="font-size: 1rem; font-weight: normal;">kg</small></div>
                    </div>
                    <div class="spec-card">
                        <div class="spec-label">Location</div>
                        <div class="spec-value" style="font-size: 1.2rem;">📍 {{ $listing->location }}</div>
                    </div>
                    <div class="spec-card">
                        <div class="spec-label">Listed On</div>
                        <div class="spec-value" style="font-size: 1.1rem;">{{ $listing->created_at->format('M d, Y') }}</div>
                    </div>
                </div>

                <!-- Description -->
                <div class="description">
                    <h3 style="margin-bottom: 1rem; color: #2d3748;">Description</h3>
                    <p>
                        This premium {{ $listing->animal_type }} is a {{ $listing->breed }} breed, 
                        approximately {{ $listing->age }} months old and weighing {{ $listing->weight }} kg. 
                        Perfect for Qurbani, this healthy animal has been well-cared for and is ready for sale.
                        Located in {{ $listing->location }}, this animal represents excellent value at ৳{{ number_format($listing->price, 2) }}.
                    </p>
                </div>

                <!-- Vaccination Info -->
                @if($listing->vaccination_info)
                <div class="vaccination-info">
                    <h3>💉 Vaccination & Health Information</h3>
                    <p>{{ $listing->vaccination_info }}</p>
                </div>
                @else
                <div class="vaccination-info">
                    <h3>💉 Vaccination & Health Information</h3>
                    <p>This animal is healthy and has received all necessary vaccinations. Contact the seller for detailed health records.</p>
                </div>
                @endif
            </div>

            <!-- Reviews Section -->
            <div class="reviews-section">
                <div class="reviews-header">
                    <h2>⭐ Reviews & Ratings</h2>
                    <div class="rating-summary">
                        <div class="rating-number">4.5</div>
                        <div>
                            <div class="rating-stars">★★★★☆</div>
                            <div class="rating-count">(12 reviews)</div>
                        </div>
                    </div>
                </div>

                <!-- Sample Reviews (Dynamic - would come from database) -->
                <div class="review-item">
                    <div class="review-header">
                        <span class="reviewer-name">Ahmed Khan</span>
                        <span class="review-date">2 days ago</span>
                    </div>
                    <div class="review-rating">★★★★★</div>
                    <p class="review-text">Excellent animal! Very healthy and well-maintained. The seller was professional and delivery was smooth. Highly recommended!</p>
                </div>

                <div class="review-item">
                    <div class="review-header">
                        <span class="reviewer-name">Fatima Rahman</span>
                        <span class="review-date">1 week ago</span>
                    </div>
                    <div class="review-rating">★★★★☆</div>
                    <p class="review-text">Good quality animal. Matches the description. Minor delay in delivery but overall satisfied with the purchase.</p>
                </div>

                <div class="review-item">
                    <div class="review-header">
                        <span class="reviewer-name">Mohammad Ali</span>
                        <span class="review-date">2 weeks ago</span>
                    </div>
                    <div class="review-rating">★★★★★</div>
                    <p class="review-text">Perfect for Qurbani! The animal was exactly as shown. Seller was very helpful and answered all my questions. Will buy again.</p>
                </div>

                <button class="add-review-btn">+ Add Your Review</button>
            </div>
        </div>

        <!-- Right: Sidebar -->
        <div class="sidebar-info">
            <!-- Price & Cart -->
            <div class="price-card">
                <div class="price-tag">৳{{ number_format($listing->price, 2) }}</div>
                
                <div class="availability {{ $listing->status === 'sold' ? 'not-available' : '' }}">
                    <span class="availability-icon">
                        @if($listing->status === 'available') ✓ @else ✗ @endif
                    </span>
                    <span class="availability-text">
                        @if($listing->status === 'available')
                            Available for Purchase
                        @else
                            Not Available (Sold)
                        @endif
                    </span>
                </div>

                <button class="btn-cart" {{ $listing->status === 'sold' ? 'disabled' : '' }}>
                    🛒 Add to Cart
                </button>
                <button class="btn-contact">📞 Contact Seller</button>
            </div>

            <!-- Seller Information -->
            <div class="seller-card">
                <div class="seller-header">
                    <div class="seller-avatar">
                        {{ strtoupper(substr($listing->seller->name, 0, 1)) }}
                    </div>
                    <div class="seller-info">
                        <h3>{{ $listing->seller->name }}</h3>
                        @if($listing->seller->verified)
                            <span class="verified-seller">✓ Verified Seller</span>
                        @endif
                    </div>
                </div>

                <div class="seller-details">
                    @if($listing->seller->phone)
                    <div class="seller-detail-item">
                        📱 {{ $listing->seller->phone }}
                    </div>
                    @endif
                    @if($listing->seller->email)
                    <div class="seller-detail-item">
                        ✉️ {{ $listing->seller->email }}
                    </div>
                    @endif
                    <div class="seller-detail-item">
                        📍 {{ $listing->seller->city ?? 'Bangladesh' }}
                    </div>
                    <div class="seller-detail-item">
                        👤 Member since {{ $listing->seller->created_at->format('Y') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Listings -->
    @if($relatedListings->count() > 0)
    <div class="related-section">
        <h2>Similar {{ ucfirst($listing->animal_type) }}s You May Like</h2>
        <div class="related-grid">
            @foreach($relatedListings as $related)
            <a href="/listings/{{ $related->id }}" class="related-card">
                <div class="related-image">
                    @if($related->animal_type === 'cow') 🐄
                    @elseif($related->animal_type === 'goat') 🐐
                    @elseif($related->animal_type === 'sheep') 🐑
                    @elseif($related->animal_type === 'camel') 🐫
                    @endif
                </div>
                <div class="related-content">
                    <h3>{{ $related->breed }}</h3>
                    <div class="related-price">৳{{ number_format($related->price, 2) }}</div>
                    <div class="related-location">📍 {{ $related->location }}</div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
