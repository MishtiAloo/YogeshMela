@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<style>
    /* Basic Reset and Container Styling */
    .profile-container {
        max-width: 800px;
        margin: 40px auto;
        padding: 20px;
    }

    /* Heading Styles */
    .profile-heading {
        font-size: 2.5rem; /* Equivalent to text-4xl */
        font-weight: 800;  /* Equivalent to font-extrabold */
        margin-bottom: 2.5rem; /* Equivalent to mb-10 */
        text-align: center;
        color: #1a202c; /* Equivalent to text-gray-900 */
    }

    /* Success Message */
    .alert-success {
        background-color: #ecfdf5; /* Equivalent to bg-green-50 */
        border-left: 4px solid #10b981; /* Equivalent to border-green-500 */
        color: #065f46; /* Equivalent to text-green-700 */
        padding: 1rem;
        margin-bottom: 2rem; /* Equivalent to mb-8 */
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
        border-radius: 0.5rem; /* Equivalent to rounded-lg */
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); /* Equivalent to shadow-sm */
    }
    .alert-success p {
        margin: 0;
        padding: 0;
    }
    .alert-success .font-semibold {
        font-weight: 600;
    }

    /* Profile Card Styling */
    .profile-card {
        background-color: #ffffff;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1); /* Equivalent to shadow-2xl */
        border-radius: 0.75rem; /* Equivalent to rounded-xl */
        overflow: hidden;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
        border: 1px solid #e2e8f0; /* Equivalent to border border-gray-100 */
    }

    .profile-card-body {
        padding: 2.5rem 2.5rem; /* px-8 py-8 sm:px-10 */
    }

    .profile-card-body h2 {
        font-size: 1.5rem; /* Equivalent to text-2xl */
        font-weight: 600; /* Equivalent to font-semibold */
        line-height: 2rem; /* Equivalent to leading-8 */
        color: #1a202c; /* Equivalent to text-gray-900 */
        border-bottom: 1px solid #e2e8f0; /* Equivalent to border-gray-200 */
        padding-bottom: 1rem; /* Equivalent to pb-4 */
        margin-bottom: 1.5rem; /* Equivalent to mb-6 */
    }

    .detail-list {
        display: flex;
        flex-direction: column;
        gap: 1rem; /* Equivalent to space-y-4 */
    }

    .detail-item {
        display: grid;
        grid-template-columns: 1fr 2fr; /* Equivalent to sm:grid sm:grid-cols-3, but adjusted for better proportions if no sm breakpoint is used */
        gap: 1rem; /* Equivalent to sm:gap-4 */
        padding: 1rem 1.5rem; /* px-4 py-4 sm:px-6 */
        border-radius: 0.375rem; /* Equivalent to rounded-md */
    }
    .detail-item:nth-child(even) { /* For alternating background color */
        background-color: #f9fafb; /* Equivalent to bg-gray-50 */
    }

    .detail-item dt {
        font-size: 0.875rem; /* Equivalent to text-sm */
        font-weight: 500; /* Equivalent to font-medium */
        color: #4a5568; /* Equivalent to text-gray-600 */
    }

    .detail-item dd {
        margin-top: 0.25rem; /* Equivalent to mt-1 */
        font-size: 1rem; /* Equivalent to text-base */
        line-height: 1.5rem; /* Equivalent to leading-6 */
        color: #2d3748; /* Equivalent to text-gray-800 */
        font-weight: 500; /* Equivalent to font-medium */
    }
    .detail-item dd.role {
        font-weight: 600; /* Equivalent to font-semibold */
        color: #4338ca; /* Equivalent to text-indigo-700 */
    }

    /* Update Button Section */
    .button-section {
        background-color: #f7fafc; /* Equivalent to bg-gray-100 */
        padding: 1.25rem 2.5rem; /* px-8 py-5 */
        display: flex;
        justify-content: flex-end; /* Equivalent to justify-end */
        border-top: 1px solid #e2e8f0; /* Equivalent to border-gray-200 */
    }

    .update-button {
        display: inline-flex;
        align-items: center;
        padding: 0.625rem 1.25rem; /* px-5 py-2.5 */
        border: none; /* Removed border */
        font-size: 1rem; /* Equivalent to text-base */
        font-weight: 600; /* Equivalent to font-semibold */
        border-radius: 0.5rem; /* Equivalent to rounded-lg */
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1); /* Equivalent to shadow-md */
        color: #ffffff;
        background-color: #2563eb; /* Equivalent to bg-blue-600 */
        transition: background-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        text-decoration: none; /* Ensure it looks like a button */
    }

    .update-button:hover {
        background-color: #1d4ed8; /* Equivalent to hover:bg-blue-700 */
    }

    .update-button:focus {
        outline: none;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.5); /* Equivalent to focus:ring-4 focus:ring-blue-300 */
    }
</style>

<div class="profile-container">
    <h1 class="profile-heading">My Profile Details</h1>

    @if (session('success'))
        <div class="alert-success" role="alert">
            <p class="font-semibold">Success!</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="profile-card">
        
        <div class="profile-card-body">
            <h2>Account Information</h2>
            
            <dl class="detail-list">
                {{-- Name --}}
                <div class="detail-item">
                    <dt>Full Name</dt>
                    <dd>{{ $user->name }}</dd>
                </div>

                {{-- Email --}}
                <div class="detail-item">
                    <dt>Email Address</dt>
                    <dd>{{ $user->email }}</dd>
                </div>
                
                {{-- Role --}}
                <div class="detail-item">
                    <dt>User Role</dt>
                    <dd class="role">{{ ucfirst($user->role) }}</dd>
                </div>

                {{-- Phone --}}
                <div class="detail-item">
                    <dt>Phone Number</dt>
                    <dd>{{ $user->phone ?? 'Not Provided' }}</dd>
                </div>

                {{-- Address --}}
                <div class="detail-item">
                    <dt>Address</dt>
                    <dd>{{ $user->address ?? 'Not Provided' }}</dd>
                </div>
            </dl>
        </div>

        {{-- UPDATE PROFILE BUTTON LOCATION --}}
        <div class="button-section">
            <a href="{{ route('profile.edit') }}" class="update-button">
                Update Profile Details
            </a>
        </div>
        {{-- END OF BUTTON LOCATION --}}

    </div>
</div>
@endsection