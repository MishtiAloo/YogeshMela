<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Show the authenticated user's profile details.
     */
    public function show()
    {
        // Auth::user() automatically retrieves the currently logged-in user
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    /**
     * Show the form for editing the authenticated user's profile.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the authenticated user's profile information.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate incoming data
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // The email must be unique, BUT ignore the current user's email address
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],
        ]);

        $user->update($validatedData);

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
    }
}