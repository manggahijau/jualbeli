<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JualBeliKu</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/bootstrap.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f7f9fc;
        }

        nav {
            background-color: #007bff;
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav a {
            color: white;
            margin-left: 1rem;
            text-decoration: none;
        }

        nav a:hover {
            text-decoration: underline;
        }

        .container {
            padding: 2rem;
        }

        footer {
            text-align: center;
            padding: 1rem;
            background: #e9ecef;
            margin-top: 2rem;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <nav>
        <div class="brand">
            <strong>JualBeliKu</strong>
        </div>
        <div class="nav-links">
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ url('/produk/produkSaya') }}">Produk Saya</a>
            @auth
                <span style="margin-left: 1rem;">Halo, {{ Auth::user()->username }}</span>
                <a href="{{ route('logout') }}" style="margin-left: 1rem;">Logout</a>
            @else
                <a href="{{ route('login') }}" style="margin-left: 1rem;">Login</a>
                <a href="{{ route('register') }}" style="margin-left: 1rem;">Register</a>
            @endauth
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <footer>
        &copy; {{ date('Y') }} JualBeliKu.
    </footer>
</body>
</html>
