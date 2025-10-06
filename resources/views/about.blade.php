@extends('layouts.app')

@section('title', 'About Us - YogeshMela')

@section('content')
<style>
    /* About Hero */
    .about-hero {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.9) 0%, rgba(118, 75, 162, 0.9) 100%);
        color: white;
        padding: 4rem 0;
        text-align: center;
    }

    .about-hero h1 {
        font-size: 3rem;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
    }

    .about-hero p {
        font-size: 1.3rem;
        opacity: 0.95;
        max-width: 800px;
        margin: 0 auto;
    }

    /* Mission Section */
    .mission-section {
        padding: 4rem 0;
        background: #f7fafc;
    }

    .mission-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 3rem;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        align-items: center;
    }

    .mission-text h2 {
        font-size: 2.5rem;
        color: #2d3748;
        margin-bottom: 1.5rem;
    }

    .mission-text p {
        font-size: 1.1rem;
        line-height: 1.7;
        color: #666;
        margin-bottom: 1rem;
    }

    .mission-image {
        text-align: center;
        font-size: 8rem;
    }

    /* Stats Section */
    .stats-section {
        padding: 4rem 0;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 2rem;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .stat-card {
        background: white;
        padding: 2rem;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-number {
        font-size: 3rem;
        font-weight: bold;
        color: #667eea;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        color: #666;
        font-size: 1.1rem;
    }

    /* Values Section */
    .values-section {
        padding: 4rem 0;
        background: #f7fafc;
    }

    .values-section h2 {
        text-align: center;
        font-size: 2.5rem;
        margin-bottom: 3rem;
        color: #2d3748;
    }

    .values-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .value-card {
        background: white;
        padding: 2rem;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s;
    }

    .value-card:hover {
        transform: translateY(-5px);
    }

    .value-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
    }

    .value-card h3 {
        font-size: 1.3rem;
        margin-bottom: 0.5rem;
        color: #2d3748;
    }

    .value-card p {
        color: #666;
    }

    /* Team Section */
    .team-section {
        padding: 4rem 0;
    }

    .team-section h2 {
        text-align: center;
        font-size: 2.5rem;
        margin-bottom: 3rem;
        color: #2d3748;
    }

    .team-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .team-member {
        background: white;
        padding: 2rem;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .team-avatar {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        margin: 0 auto 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        color: white;
    }

    .team-member h3 {
        font-size: 1.3rem;
        margin-bottom: 0.5rem;
        color: #2d3748;
    }

    .team-member p {
        color: #667eea;
        font-weight: 600;
    }

    @media (max-width: 768px) {
        .mission-content {
            grid-template-columns: 1fr;
        }

        .about-hero h1 {
            font-size: 2rem;
        }

        .mission-text h2 {
            font-size: 2rem;
        }
    }
</style>

<!-- About Hero -->
<section class="about-hero">
    <div class="container">
        <h1>About YogeshMela</h1>
        <p>Connecting Bangladesh with premium Qurbani animals through trust, quality, and innovation</p>
    </div>
</section>

<!-- Mission Section -->
<section class="mission-section">
    <div class="mission-content">
        <div class="mission-text">
            <h2>Our Mission</h2>
            <p>YogeshMela was founded with a simple yet powerful mission: to revolutionize the Qurbani animal marketplace in Bangladesh. We believe that finding the perfect animal for Qurbani should be as easy and trustworthy as possible.</p>
            <p>Our platform connects verified sellers with buyers across the country, ensuring that every transaction is transparent, secure, and beneficial for all parties involved. We are committed to maintaining the highest standards of animal welfare, seller verification, and customer satisfaction.</p>
            <p>Through our innovative online marketplace, we bring the traditional Qurbani process into the digital age while preserving the values and traditions that make this occasion special.</p>
        </div>
        <div class="mission-image">
            🐄
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section">
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-number">1000+</div>
            <div class="stat-label">Happy Customers</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">500+</div>
            <div class="stat-label">Verified Sellers</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">50+</div>
            <div class="stat-label">Districts Covered</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">4.8</div>
            <div class="stat-label">Average Rating</div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="values-section">
    <div class="container">
        <h2>Our Values</h2>
        <div class="values-grid">
            <div class="value-card">
                <div class="value-icon">✓</div>
                <h3>Trust & Transparency</h3>
                <p>We ensure every transaction is transparent with verified sellers and detailed animal information.</p>
            </div>
            <div class="value-card">
                <div class="value-icon">🐄</div>
                <h3>Animal Welfare</h3>
                <p>We prioritize the health and well-being of all animals, ensuring they meet the highest standards.</p>
            </div>
            <div class="value-card">
                <div class="value-icon">🤝</div>
                <h3>Community Focus</h3>
                <p>We support local farmers and communities while making Qurbani accessible to everyone.</p>
            </div>
            <div class="value-card">
                <div class="value-icon">🚀</div>
                <h3>Innovation</h3>
                <p>We leverage technology to make the Qurbani process more convenient and efficient.</p>
            </div>
            <div class="value-card">
                <div class="value-icon">💯</div>
                <h3>Quality Assurance</h3>
                <p>Every animal goes through rigorous health checks and quality verification.</p>
            </div>
            <div class="value-card">
                <div class="value-icon">🌟</div>
                <h3>Excellence</h3>
                <p>We strive for excellence in every aspect of our service, from customer support to delivery.</p>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="team-section">
    <div class="container">
        <h2>Meet Our Team</h2>
        <div class="team-grid">
            <div class="team-member">
                <div class="team-avatar">👨‍💼</div>
                <h3>Ahmed Rahman</h3>
                <p>Founder & CEO</p>
            </div>
            <div class="team-member">
                <div class="team-avatar">👩‍💻</div>
                <h3>Fatima Khan</h3>
                <p>Head of Technology</p>
            </div>
            <div class="team-member">
                <div class="team-avatar">👨‍🔬</div>
                <h3>Dr. Mohammad Ali</h3>
                <p>Veterinary Consultant</p>
            </div>
            <div class="team-member">
                <div class="team-avatar">👩‍💼</div>
                <h3>Sadia Islam</h3>
                <p>Customer Success Manager</p>
            </div>
        </div>
    </div>
</section>
@endsection
