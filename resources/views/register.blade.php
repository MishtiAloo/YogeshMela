@extends('layouts.app')

@section('title', 'Register - YogeshMela')

@section('content')
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.9) 0%, rgba(118, 75, 162, 0.9) 100%);
        color: #2d3748;
    }

    .register-container {
        max-width: 450px;
        margin: 5rem auto;
        background: #ffffff;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        padding: 2.5rem;
    }

    .register-container h2 {
        text-align: center;
        font-size: 2rem;
        color: #2d3748;
        margin-bottom: 0.5rem;
    }

    .register-container p {
        text-align: center;
        color: #718096;
        margin-bottom: 2rem;
        font-size: 0.95rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        color: #4a5568;
        font-weight: 600;
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }

    .form-control {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid #ddd;
        border-radius: 10px;
        font-size: 1rem;
        transition: all 0.3s;
    }

    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 8px rgba(102, 126, 234, 0.3);
        outline: none;
    }

    .btn-primary {
        display: block;
        width: 100%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        font-weight: 600;
        padding: 0.75rem;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 1rem;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }

    .extra-options {
        margin-top: 1rem;
        text-align: center;
        font-size: 0.9rem;
        color: #666;
    }

    .extra-options a {
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
    }

    .extra-options a:hover {
        text-decoration: underline;
    }

    .error-box {
        background: #fed7d7;
        border-left: 5px solid #e53e3e;
        color: #742a2a;
        padding: 0.75rem 1rem;
        border-radius: 5px;
        margin-bottom: 1.5rem;
        font-size: 0.9rem;
    }
</style>

<div class="container">
    <div class="register-container">
        <h2>Create Your Account</h2>
        <p>Join YogeshMela and start your journey</p>

        @if ($errors->any())
            <div class="error-box">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Full Name</label>
                <input id="name" name="name" type="text" class="form-control" required placeholder="Enter your full name" value="{{ old('name') }}">
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input id="email" name="email" type="email" class="form-control" required placeholder="Enter your email" value="{{ old('email') }}">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" name="password" type="password" class="form-control" required placeholder="Enter your password">
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" required placeholder="Confirm your password">
            </div>

            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input id="phone" name="phone" type="text" class="form-control" placeholder="Enter your phone number" value="{{ old('phone') }}">
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <textarea id="address" name="address" class="form-control" required placeholder="Enter your full address" rows="3">{{ old('address') }}</textarea>
            </div>

            <div class="form-group">
                <label for="role">Role</label>
                <select id="role" name="role" class="form-control" required>
                    <option value="">Select your role</option>
                    <option value="buyer" {{ old('role') == 'buyer' ? 'selected' : '' }}>Buyer</option>
                    <option value="seller" {{ old('role') == 'seller' ? 'selected' : '' }}>Seller</option>
                </select>
            </div>

            <button type="submit" class="btn-primary">Create Account</button>

            <div class="extra-options">
                Already have an account? <a href="{{ route('login') }}">Sign in here</a>
            </div>
        </form>
    </div>
</div>
@endsection
