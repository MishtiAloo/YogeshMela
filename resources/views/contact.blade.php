@extends('layouts.app')

@section('title', 'Contact Us - YogeshMela')

@section('content')
<style>
    /* Contact Section */
    .contact-hero {
        background: linear-gradient(135deg, rgba(85, 202, 179, 0.9) 0%, rgba(22, 131, 96, 0.9) 100%);
        color: white;
        padding: 4rem 0;
        text-align: center;
    }
    
    .contact-hero h1 {
        font-size: 3rem;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
    }
    
    .contact-hero p {
        font-size: 1.3rem;
        opacity: 0.95;
    }
    
    /* Contact Form */
    .contact-section {
        padding: 4rem 0;
        background: #f7fafc;
    }
    
    .contact-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 3rem;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }
    
    .contact-info {
        background: white;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .contact-info h2 {
        color: #2d3748;
        margin-bottom: 2rem;
        font-size: 2rem;
    }
    
    .contact-item {
        display: flex;
        align-items: center;
        margin-bottom: 1.5rem;
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 8px;
    }
    
    .contact-item i {
        font-size: 1.5rem;
        margin-right: 1rem;
        color: #667eea;
    }
    
    .contact-item h3 {
        margin-bottom: 0.5rem;
        color: #2d3748;
    }
    
    .contact-item p {
        color: #666;
        margin: 0;
    }
    
    .contact-form {
        background: white;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .contact-form h2 {
        color: #2d3748;
        margin-bottom: 2rem;
        font-size: 2rem;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        color: #2d3748;
        font-weight: 600;
    }
    
    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 1rem;
        font-family: inherit;
    }
    
    .form-group textarea {
        resize: vertical;
        min-height: 120px;
    }
    
    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }
    
    /* Map Section */
    .map-section {
        padding: 4rem 0;
    }
    
    .map-section h2 {
        text-align: center;
        font-size: 2.5rem;
        margin-bottom: 3rem;
        color: #2d3748;
    }
    
    .map-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }
    
    .map-placeholder {
        height: 400px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }
    
    @media (max-width: 768px) {
        .contact-container {
            grid-template-columns: 1fr;
        }
        
        .contact-hero h1 {
            font-size: 2rem;
        }
    }
</style>

<!-- Contact Hero -->
<section class="contact-hero">
    <div class="container">
        <h1>Contact Us</h1>
        <p>Get in touch with YogeshMela. We're here to help you with your Qurbani needs.</p>
    </div>
</section>

<!-- Contact Section -->
<section class="contact-section">
    <div class="contact-container">
        <!-- Contact Information -->
        <div class="contact-info">
            <h2>Get In Touch</h2>
            
            <div class="contact-item">
                <i>📞</i>
                <div>
                    <h3>Phone</h3>
                    <p>+880 1700-000000</p>
                    <p>+880 1800-000000</p>
                </div>
            </div>
            
            <div class="contact-item">
                <i>📧</i>
                <div>
                    <h3>Email</h3>
                    <p>info@yogeshmela.com</p>
                    <p>support@yogeshmela.com</p>
                </div>
            </div>
            
            <div class="contact-item">
                <i>📍</i>
                <div>
                    <h3>Address</h3>
                    <p>Dhaka, Bangladesh</p>
                    <p>Available across Bangladesh</p>
                </div>
            </div>
            
            <div class="contact-item">
                <i>🕒</i>
                <div>
                    <h3>Business Hours</h3>
                    <p>Monday - Friday: 9:00 AM - 6:00 PM</p>
                    <p>Saturday: 9:00 AM - 2:00 PM</p>
                </div>
            </div>
        </div>
        
        <!-- Contact Form -->
        <div class="contact-form">
            <h2>Send us a Message</h2>
            <form action="/contact" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone">
                </div>
                
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" name="subject" required>
                </div>
                
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" required></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary" style="width: 100%;">Send Message</button>
            </form>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="map-section">
    <div class="container">
        <h2>Find Us</h2>
        <div class="map-container">
            <div class="map-placeholder">
                🗺️ Interactive Map Coming Soon<br>
                <small>Currently serving customers across Bangladesh</small>
            </div>
        </div>
    </div>
</section>
@endsection
