<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JualBeliKu</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/bootstrap.js') }}" defer></script>
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
            <a href="{{ url('/dashboard') }}">Dashboard</a>
            <a href="{{ route('logout') }}">Logout</a>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <footer>
        &copy; {{ date('Y') }} JualBeliKu. All rights reserved.
    </footer>
</body>
</html>
