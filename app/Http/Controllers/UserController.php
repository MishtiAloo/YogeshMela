<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(User::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|string|min:6',
            'phone'      => 'nullable|string|max:20',
            'house_no'   => 'nullable|string|max:50',
            'road_no'    => 'nullable|string|max:50',
            'thana'      => 'nullable|string|max:100',
            'postal_code'=> 'nullable|string|max:20',
            'city'       => 'nullable|string|max:100',
            'division'   => 'nullable|string|max:100',
            'role'       => 'required|in:buyer,seller,admin,butcher,delivery_man',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        // Auth::login($user);
        // $request->session()->regenerate();

        return redirect()->route('login')->with('success', 'Account created successfully! Please log in.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'       => 'sometimes|string|max:255',
            'email'      => 'sometimes|email|unique:users,email,' . $user->id,
            'password'   => 'sometimes|string|min:6',
            'phone'      => 'nullable|string|max:20',
            'house_no'   => 'nullable|string|max:50',
            'road_no'    => 'nullable|string|max:50',
            'thana'      => 'nullable|string|max:100',
            'postal_code'=> 'nullable|string|max:20',
            'city'       => 'nullable|string|max:100',
            'division'   => 'nullable|string|max:100',
            'role'       => 'sometimes|in:buyer,seller,admin,butcher,delivery_man',
            'verified'   => 'sometimes|boolean',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);

        return response()->json([
            'message' => 'User updated successfully',
            'user'    => $user
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'message' => 'user deleted successfully'
        ], 204);
    }

    public function login (Request $request) {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect based on role
            $user = Auth::user();
            switch ($user->role) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'buyer':
                    return redirect()->route('buyer.dashboard');
                case 'seller':
                    return redirect()->route('seller.dashboard');
                default:
                    return redirect()->route('home');
            }
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout(Request $request) {
        Auth::logout();
    
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect('/')->with('status', 'Logged out successfully');
    }
    

    public function showLoginForm()
    {
        return view('login');
    }

    public function showRegisterForm()
    {
        return view('register');
    }


    public function trackOrder(User $user)
    {
        // Ensure only the logged-in buyer can track *their* orders
        if (Auth::id() !== $user->id || $user->role !== 'buyer') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Get orders via relationship
        $orders = $user->orders;

        return response()->json([
            'buyer'  => $user,
            'orders' => $orders,
        ]);
    }

    public function filterOrders(Request $request)
    {
        $query = Order::query();

        // Optional filters (only applied if passed in request)
        if ($request->filled('buyer_id')) {
            $query->where('buyer_id', $request->buyer_id);
        }

        if ($request->filled('butcher_service')) {
            $query->where('butcher_service', $request->butcher_service);
        }

        if ($request->filled('delivery_service')) {
            $query->where('delivery_service', $request->delivery_service);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Get filtered results
        $orders = $query->with(['buyer', 'listing'])->get();

        return response()->json($orders);
    }
}
