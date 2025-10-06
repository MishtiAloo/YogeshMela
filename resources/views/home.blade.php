@extends('layouts.app')

@section('title', 'YogeshMela - Premium Qurbani Animals Marketplace')

@section('content')
<style>
    /* Hero Section */
    .hero {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.9) 0%, rgba(118, 75, 162, 0.9) 100%),
                    url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 600"><rect fill="%23f0f4f8" width="1200" height="600"/></svg>');
        color: white;
        padding: 5rem 0;
        text-align: center;
    }
    
    .hero h1 {
        font-size: 3rem;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
    }
    
    .hero p {
        font-size: 1.3rem;
        margin-bottom: 2rem;
        opacity: 0.95;
    }
    
    .hero-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
    }
    
    /* Search Box */
    .search-box {
        background: white;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        max-width: 800px;
        margin: -3rem auto 0;
        position: relative;
        z-index: 10;
    }
    
    .search-box h3 {
        color: #333;
        margin-bottom: 1rem;
    }
    
    .search-form {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr auto;
        gap: 1rem;
    }
    
    .search-form select,
    .search-form input {
        padding: 0.75rem;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 1rem;
    }
    
    /* Categories */
    .categories {
        padding: 4rem 0;
    }
    
    .categories h2 {
        text-align: center;
        font-size: 2.5rem;
        margin-bottom: 3rem;
        color: #2d3748;
    }
    
    .category-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
    }
    
    .category-card {
        background: white;
        padding: 2rem;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s, box-shadow 0.3s;
        cursor: pointer;
        text-decoration: none;
        color: #333;
    }
    
    .category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }
    
    .category-icon {
        font-size: 4rem;
        margin-bottom: 1rem;
    }
    
    .category-card h3 {
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
    }
    
    .category-card p {
        color: #666;
    }
    
    /* Featured Listings */
    .featured-listings {
        padding: 4rem 0;
        background: #f7fafc;
    }
    
    .featured-listings h2 {
        text-align: center;
        font-size: 2.5rem;
        margin-bottom: 3rem;
        color: #2d3748;
    }
    
    .listings-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 2rem;
    }
    
    .listing-card {
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s, box-shadow 0.3s;
    }
    
    .listing-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }
    
    .listing-image {
        height: 200px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 4rem;
    }
    
    .listing-content {
        padding: 1.5rem;
    }
    
    .listing-type {
        display: inline-block;
        background: #667eea;
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.85rem;
        margin-bottom: 0.5rem;
    }
    
    .listing-content h3 {
        font-size: 1.3rem;
        margin-bottom: 0.5rem;
        color: #2d3748;
    }
    
    .listing-details {
        display: flex;
        justify-content: space-between;
        margin: 1rem 0;
        font-size: 0.9rem;
        color: #666;
    }
    
    .listing-price {
        font-size: 1.5rem;
        font-weight: bold;
        color: #667eea;
        margin-bottom: 1rem;
    }
    
    .listing-location {
        color: #999;
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }
    
    .badge {
        display: inline-block;
        background: #48bb78;
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 5px;
        font-size: 0.85rem;
        margin-right: 0.5rem;
    }
    
    .badge.verified {
        background: #4299e1;
    }
    
    /* Features Section */
    .features {
        padding: 4rem 0;
    }
    
    .features h2 {
        text-align: center;
        font-size: 2.5rem;
        margin-bottom: 3rem;
        color: #2d3748;
    }
    
    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
    }
    
    .feature-card {
        text-align: center;
        padding: 2rem;
    }
    
    .feature-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
    }
    
    .feature-card h3 {
        font-size: 1.3rem;
        margin-bottom: 0.5rem;
        color: #2d3748;
    }
    
    .feature-card p {
        color: #666;
    }
    
    /* CTA Section */
    .cta {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 4rem 0;
        text-align: center;
    }
    
    .cta h2 {
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }
    
    .cta p {
        font-size: 1.2rem;
        margin-bottom: 2rem;
        opacity: 0.95;
    }
    
    @media (max-width: 768px) {
        .hero h1 {
            font-size: 2rem;
        }
        
        .search-form {
            grid-template-columns: 1fr;
        }
        
        .category-grid,
        .features-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <h1>🐄 Find Your Perfect Qurbani Animal</h1>
        <p>Premium quality cows, goats, sheep, and camels from verified sellers across Bangladesh</p>
        <div class="hero-buttons">
            <a href="{{ route('login') }}" class="btn btn-secondary">Login</a>
            <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
            <a href="/listings" class="btn btn-primary">Browse Animals</a>
            <a href="/sellers/register" class="btn btn-secondary">Become a Seller</a>
        </div>
    </div>
</section>

<!-- Search Box -->
<div class="container">
    <div class="search-box">
        <h3>Search for Animals</h3>
        <form action="/listings" method="GET" class="search-form">
            <select name="animal_type">
                <option value="">All Types</option>
                <option value="cow">Cow</option>
                <option value="goat">Goat</option>
                <option value="sheep">Sheep</option>
                <option value="camel">Camel</option>
            </select>
           <input type="text" name="location" placeholder="Location (e.g., Dhaka)">
            <input type="number" name="max_price" placeholder="Max Price (৳)">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>
</div>

<!-- Categories -->
<section class="categories">
    <div class="container">
        <h2>Browse by Category</h2>
        <div class="category-grid">
            <a href="/listings?animal_type=cow" class="category-card">
                <div class="category-icon">🐄</div>
                <h3>Cows</h3>
                <p>{{ $stats['cows'] ?? 0 }} available</p>
            </a>
            <a href="/listings?animal_type=goat" class="category-card">
                <div class="category-icon">🐐</div>
                <h3>Goats</h3>
                <p>{{ $stats['goats'] ?? 0 }} available</p>
            </a>
            <a href="/listings?animal_type=sheep" class="category-card">
                <div class="category-icon">🐑</div>
                <h3>Sheep</h3>
                <p>{{ $stats['sheep'] ?? 0 }} available</p>
            </a>
            <a href="/listings?animal_type=camel" class="category-card">
                <div class="category-icon">🐫</div>
                <h3>Camels</h3>
                <p>{{ $stats['camels'] ?? 0 }} available</p>
            </a>
        </div>
    </div>
</section>

<!-- Featured Listings -->
<section class="featured-listings">
    <div class="container">
        <h2>⭐ Featured Animals</h2>
        <div class="listings-grid">
            @forelse($featuredListings as $listing)
            <div class="listing-card">
                <div class="listing-image">
                    @if($listing->animal_type === 'cow') 🐄
                    @elseif($listing->animal_type === 'goat') 🐐
                    @elseif($listing->animal_type === 'sheep') 🐑
                    @elseif($listing->animal_type === 'camel') 🐫
                    @endif
                </div>
                <div class="listing-content">
                    <span class="listing-type">{{ ucfirst($listing->animal_type) }}</span>
                    @if($listing->user->verified)
                        <span class="badge verified">✓ Verified Seller</span>
                    @endif
                    <h3>{{ $listing->breed }}</h3>
                    <div class="listing-details">
                        <span>Age: {{ $listing->age }} months</span>
                        <span>Weight: {{ $listing->weight }} kg</span>
                    </div>
                    <div class="listing-price">৳{{ number_format($listing->price, 2) }}</div>
                    <div class="listing-location">📍 {{ $listing->location }}</div>
                    <span class="badge">{{ ucfirst($listing->status) }}</span>
                    <a href="/listings/{{ $listing->id }}" class="btn btn-primary" style="width: 100%; margin-top: 0.5rem;">View Details</a>
                </div>
            </div>
            @empty
            <p style="grid-column: 1/-1; text-align: center; color: #666;">No featured listings available at the moment.</p>
            @endforelse
        </div>
        
        @if(count($featuredListings) > 0)
        <div style="text-align: center; margin-top: 2rem;">
            <a href="/listings" class="btn btn-primary">View All Animals →</a>
        </div>
        @endif
    </div>
</section>

<!-- Features -->
<section class="features">
    <div class="container">
        <h2>Why Choose YogeshMela?</h2>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">✓</div>
                <h3>Verified Sellers</h3>
                <p>All sellers are verified to ensure quality and trust</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🚚</div>
                <h3>Home Delivery</h3>
                <p>Get your animal delivered right to your doorstep</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🔪</div>
                <h3>Butcher Service</h3>
                <p>Professional butcher services available on request</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">💰</div>
                <h3>Best Prices</h3>
                <p>Competitive prices from sellers across Bangladesh</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📱</div>
                <h3>Easy Online Booking</h3>
                <p>Browse, select, and book animals from the comfort of your home</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">💉</div>
                <h3>Health Certified</h3>
                <p>All animals come with vaccination and health information</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta">
    <div class="container">
        <h2>Ready to Find Your Animal?</h2>
        <p>Join thousands of satisfied customers who trust YogeshMela</p>
        <div class="hero-buttons">
            <a href="/listings" class="btn btn-primary">Start Browsing</a>
            <a href="/sellers/register" class="btn btn-secondary">Register as Seller</a>
        </div>
    </div>
</section>
@endsection
