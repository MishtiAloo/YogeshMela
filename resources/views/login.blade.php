@extends('layouts.app')

@section('title', 'Login - YogeshMela')

@section('content')
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.9) 0%, rgba(118, 75, 162, 0.9) 100%);
        color: #2d3748;
    }

    .login-container {
        max-width: 450px;
        margin: 5rem auto;
        background: #ffffff;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        padding: 2.5rem;
    }

    .login-container h2 {
        text-align: center;
        font-size: 2rem;
        color: #2d3748;
        margin-bottom: 0.5rem;
    }

    .login-container p {
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

    .checkbox-group {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 0.5rem;
    }

    .checkbox-group label {
        font-size: 0.9rem;
        color: #4a5568;
    }
</style>

<div class="container">
    <div class="login-container">
        <h2>Welcome Back</h2>
        <p>Sign in to continue your Qurbani journey</p>

        {{-- Display validation errors --}}
        @if (session('success'))
            <div class="mb-4 bg-green-50 border-l-4 border-green-500 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="error-box">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Login Form --}}
        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email">Email Address</label>
                <input id="email" name="email" type="email" class="form-control" required placeholder="Enter your email" value="{{ old('email') }}">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" name="password" type="password" class="form-control" required placeholder="Enter your password">
            </div>

            <div class="checkbox-group">
                <div>
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Remember me</label>
                </div>
                <a href="#" class="forgot-password">Forgot Password?</a>
            </div>

            <button type="submit" class="btn-primary">Sign In</button>

            <div class="extra-options">
                Don’t have an account? <a href="/register">Sign up</a>
            </div>
        </form>
    </div>
</div>
@endsection
