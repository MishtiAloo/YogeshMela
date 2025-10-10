@extends('layouts.app')

@section('title', 'Edit Profile')

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

    /* Error Message Styling */
    .alert-error {
        background-color: #fef2f2; /* Equivalent to bg-red-50 */
        border-left: 4px solid #ef4444; /* Equivalent to border-red-500 */
        color: #b91c1c; /* Equivalent to text-red-700 */
        padding: 1rem;
        margin-bottom: 2rem;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
        border-radius: 0.5rem;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    }
    .alert-error ul {
        margin-top: 0.5rem;
        padding-left: 1.5rem;
        list-style-type: disc;
    }

    /* Profile Form Card Styling */
    .profile-form-card {
        background-color: #ffffff;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        border-radius: 0.75rem;
        overflow: hidden;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
        border: 1px solid #e2e8f0;
    }

    .profile-form-card-body {
        padding: 2.5rem 2.5rem;
    }

    .profile-form-card-body h2 {
        font-size: 1.5rem;
        font-weight: 600;
        line-height: 2rem;
        color: #1a202c;
        border-bottom: 1px solid #e2e8f0;
        padding-bottom: 1rem;
        margin-bottom: 1.5rem;
    }

    .form-group {
        margin-bottom: 1.5rem; /* Provides spacing between form elements */
    }

    .form-label {
        display: block;
        font-size: 0.875rem; /* text-sm */
        font-weight: 500; /* font-medium */
        color: #4a5568; /* text-gray-700 */
        margin-bottom: 0.5rem;
    }

    .form-input, .form-textarea {
        display: block;
        width: 100%;
        margin-top: 0.25rem; /* mt-1 */
        border: 1px solid #cbd5e0; /* border-gray-300 */
        border-radius: 0.375rem; /* rounded-md */
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); /* shadow-sm */
        padding: 0.75rem 1rem; /* p-2 was a bit small, now more generous */
        font-size: 1rem;
        line-height: 1.5rem;
        color: #2d3748;
    }
    .form-input:focus, .form-textarea:focus {
        outline: none;
        border-color: #4f46e5; /* focus:border-blue-500 */
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1); /* focus:ring-blue-500 */
    }
    .form-input.is-invalid, .form-textarea.is-invalid {
        border-color: #ef4444; /* border-red-500 */
    }

    .error-message {
        font-size: 0.75rem; /* text-xs */
        color: #ef4444; /* text-red-500 */
        margin-top: 0.25rem; /* mt-1 */
    }
    
    .note-text {
        font-size: 0.875rem; /* text-sm */
        color: #718096; /* text-gray-500 */
        font-style: italic;
        padding-top: 0.5rem; /* pt-2 */
    }

    /* Form Actions (Buttons) */
    .form-actions {
        background-color: #f7fafc; /* bg-gray-100 */
        padding: 1.25rem 2.5rem; /* px-8 py-5 */
        display: flex;
        justify-content: flex-end; /* justify-end */
        border-top: 1px solid #e2e8f0; /* border-gray-200 */
        gap: 1rem; /* space-x-4 */
    }

    .button-base {
        display: inline-flex;
        align-items: center;
        padding: 0.625rem 1.25rem;
        border: 1px solid transparent; /* default transparent border */
        font-size: 1rem;
        font-weight: 600;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.06);
        transition: background-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, border-color 0.15s ease-in-out;
        text-decoration: none; /* for anchor tags acting as buttons */
        cursor: pointer;
    }

    .button-cancel {
        background-color: #e2e8f0; /* bg-gray-300 */
        color: #2d3748; /* text-gray-800 */
    }
    .button-cancel:hover {
        background-color: #cbd5e0; /* hover:bg-gray-400 */
    }
    .button-cancel:focus {
        outline: none;
        box-shadow: 0 0 0 4px rgba(226, 232, 240, 0.5); /* focus:ring-gray-300 */
    }

    .button-save {
        background-color: #10b981; /* bg-green-500 */
        color: #ffffff;
    }
    .button-save:hover {
        background-color: #059669; /* hover:bg-green-700 */
    }
    .button-save:focus {
        outline: none;
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.5); /* focus:ring-green-300 */
    }

</style>

<div class="profile-container">
    <h1 class="profile-heading">Update Profile Details</h1>

    {{-- Error messages for validation --}}
    @if ($errors->any())
        <div class="alert-error">
            <p class="font-semibold">Whoops! Something went wrong.</p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="profile-form-card">
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT') {{-- Method Spoofing for the PUT request --}}

            <div class="profile-form-card-body">
                <h2>Edit Personal Information</h2>

                {{-- Name Field --}}
                <div class="form-group">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                           class="form-input @error('name') is-invalid @enderror">
                    @error('name')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email Field --}}
                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                           class="form-input @error('email') is-invalid @enderror">
                    @error('email')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Phone Field --}}
                <div class="form-group">
                    <label for="phone" class="form-label">Phone (Optional)</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"
                           class="form-input @error('phone') is-invalid @enderror">
                    @error('phone')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Address Field --}}
                <div class="form-group">
                    <label for="address" class="form-label">Address (Optional)</label>
                    <textarea name="address" id="address" rows="3"
                              class="form-textarea @error('address') is-invalid @enderror">{{ old('address', $user->address) }}</textarea>
                    @error('address')
                        <p class="error-message">{{ $message }}</p>
                    @enderror
                </div>
                
                <p class="note-text">Note: Password changes are not included in this form for security reasons.</p>
            </div>

            <div class="form-actions">
                <a href="{{ route('profile.show') }}" class="button-base button-cancel">
                    Cancel
                </a>
                <button type="submit" class="button-base button-save">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection