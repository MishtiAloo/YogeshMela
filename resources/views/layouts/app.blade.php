<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'YogeshMela - Animal Marketplace for Qurbani')</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        /* Navigation */
        nav {
            background: linear-gradient(135deg, #14b8a6 0%, #134e4a 100%);
            color: white;
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        nav .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        nav .logo {
            font-size: 1.8rem;
            font-weight: bold;
            text-decoration: none;
            color: white;
        }
        
        nav ul {
            display: flex;
            list-style: none;
            gap: 2rem;
            align-items: center;
        }
        
        nav ul li {
            display: flex;
            align-items: center;
        }
        
        nav a {
            color: white;
            text-decoration: none;
            transition: opacity 0.3s;
        }
        
        nav a:hover {
            opacity: 0.8;
        }
        
        /* Dropdown Menu */
        .dropdown {
            position: relative;
            display: flex;
            align-items: center;
        }
        
        .dropdown-toggle {
            background: white;
            color: #14b8a6;
            border: 2px solid white;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s;
            margin: 0;
        }
        
        .dropdown-toggle:hover {
            background: rgba(255, 255, 255, 0.9);
        }
        
        .dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            top: calc(100% + 0.25rem);
            background: white;
            min-width: 220px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            overflow: hidden;
            z-index: 1000;
            padding-top: 0.25rem;
        }
        
        /* Create invisible bridge between button and menu */
        .dropdown-menu::before {
            content: '';
            position: absolute;
            top: -0.5rem;
            right: 0;
            left: 0;
            height: 0.5rem;
            background: transparent;
        }
        
        .dropdown:hover .dropdown-menu,
        .dropdown-menu:hover {
            display: block;
        }
        
        .dropdown-menu a,
        .dropdown-menu button {
            display: block;
            width: 100%;
            padding: 0.75rem 1rem;
            color: #333;
            text-decoration: none;
            text-align: left;
            border: none;
            background: none;
            cursor: pointer;
            transition: background 0.2s;
            font-size: 0.95rem;
        }
        
        .dropdown-menu a:hover,
        .dropdown-menu button:hover {
            background: #f7fafc;
            opacity: 1;
        }
        
        .dropdown-menu .divider {
            height: 1px;
            background: #e2e8f0;
            margin: 0.25rem 0;
        }
        
        .dropdown-menu .logout-btn {
            color: #e53e3e;
            font-weight: 600;
        }
        
        .dropdown-menu .logout-btn:hover {
            background: #fff5f5;
        }
        
        .user-info {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #e2e8f0;
            background: #f7fafc;
        }
        
        .user-info .user-name {
            font-weight: 600;
            color: #2d3748;
            display: block;
        }
        
        .user-info .user-role {
            font-size: 0.8rem;
            color: #718096;
            text-transform: capitalize;
        }
        
        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #14b8a6 0%, #0f766e 100%);
            color: white;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(20, 184, 166, 0.4);
        }
        
        .btn-secondary {
            background: white;
            color: #14b8a6;
            border: 2px solid #14b8a6;
        }
        
        .btn-secondary:hover {
            background: #14b8a6;
            color: white;
        }
        
        /* Footer */
        footer {
            background: #2d3748;
            color: white;
            padding: 3rem 0 1rem;
            margin-top: 4rem;
        }
        
        footer .container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }
        
        footer h3 {
            margin-bottom: 1rem;
            color: #14b8a6;
        }
        
        footer ul {
            list-style: none;
        }
        
        footer ul li {
            margin-bottom: 0.5rem;
        }
        
        footer a {
            color: #cbd5e0;
            text-decoration: none;
        }
        
        footer a:hover {
            color: white;
        }
        
        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid #4a5568;
            color: #cbd5e0;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="container">
            <a href="/" class="logo">🐄 YogeshMela</a>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/listings">Browse Animals</a></li>
                <li><a href="/about">About</a></li>
                <li><a href="/contact">Contact</a></li>
                
                <!-- Cart Icon -->
                <li>
                    <a href="{{ route('cart.index') }}" style="position: relative; display: flex; align-items: center; gap: 5px;">
                        <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span id="cart-badge" style="position: absolute; top: -8px; right: -8px; background-color: #f97316; color: white; border-radius: 50%; width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: bold; display: none;">0</span>
                    </a>
                </li>
    
                @guest
                    <!-- Show login if not logged in -->
                    <li>
                        <a href="{{ route('login') }}" class="btn btn-secondary" style="padding: 0.5rem 1rem;">Login</a>
                    </li>
                @endguest
    
                @auth
                    <!-- Dashboard Dropdown -->
                    <li class="dropdown">
                        <div class="dropdown-toggle">
                            <span>👤 Dashboard</span>
                            <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                        <div class="dropdown-menu">
                            <!-- User Info -->
                            <div class="user-info">
                                <span class="user-name">{{ auth()->user()->name }}</span>
                                <span class="user-role">{{ auth()->user()->role }}</span>
                            </div>
                            
                            <!-- Dashboard Links based on role -->
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}">
                                    📊 Admin Dashboard
                                </a>
                            @elseif(auth()->user()->role === 'seller')
                                <a href="{{ route('seller.dashboard') }}">
                                    📊 Seller Dashboard
                                </a>
                            @elseif(auth()->user()->role === 'buyer')
                                <a href="{{ route('buyer.dashboard') }}">
                                    📊 Buyer Dashboard
                                </a>
                            @endif
                            
                            <!-- Common Links -->
                            <a href="#">⚙️ Settings</a>
                            <a href="#">👤 Profile</a>
                            
                            <div class="divider"></div>
                            
                            <!-- Logout -->
                            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" class="logout-btn">
                                    🚪 Logout
                                </button>
                            </form>
                        </div>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>
    

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div>
                <h3>YogeshMela</h3>
                <p>Your trusted marketplace for Qurbani animals. Connecting buyers and sellers across Bangladesh.</p>
            </div>
            <div>
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/listings">Browse Animals</a></li>
                    <li><a href="/sellers">Become a Seller</a></li>
                    <li><a href="/delivery">Delivery Services</a></li>
                </ul>
            </div>
            <div>
                <h3>Services</h3>
                <ul>
                    <li><a href="/butcher">Butcher Service</a></li>
                    <li><a href="/delivery">Home Delivery</a></li>
                    <li><a href="/verification">Seller Verification</a></li>
                    <li><a href="/promotions">Featured Listings</a></li>
                </ul>
            </div>
            <div>
                <h3>Contact</h3>
                <ul>
                    <li>📞 +880 1700-000000</li>
                    <li>📧 info@yogeshmela.com</li>
                    <li>📍 Dhaka, Bangladesh</li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} YogeshMela. All rights reserved.</p>
        </div>
    </footer>

    <!-- Cart Badge Update Script -->
    <script>
        // Update cart badge count on page load
        function updateCartBadge() {
            fetch('{{ route('cart.count') }}')
                .then(response => response.json())
                .then(data => {
                    const badge = document.getElementById('cart-badge');
                    if (data.count > 0) {
                        badge.textContent = data.count;
                        badge.style.display = 'flex';
                    } else {
                        badge.style.display = 'none';
                    }
                })
                .catch(error => console.error('Error updating cart badge:', error));
        }

        // Run on page load
        updateCartBadge();

        // Update every 30 seconds (optional, for real-time updates)
        setInterval(updateCartBadge, 30000);
    </script>
</body>
</html>
