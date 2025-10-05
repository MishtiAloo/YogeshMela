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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
        }
        
        nav a {
            color: white;
            text-decoration: none;
            transition: opacity 0.3s;
        }
        
        nav a:hover {
            opacity: 0.8;
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        
        .btn-secondary {
            background: white;
            color: #667eea;
            border: 2px solid #667eea;
        }
        
        .btn-secondary:hover {
            background: #667eea;
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
            color: #667eea;
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
                <li><a href="/login" class="btn btn-secondary" style="padding: 0.5rem 1rem;">Login</a></li>
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
</body>
</html>
