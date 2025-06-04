<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'JualBeliKu')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f7f9fc;
        }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="/"><span style="color: white;">Jual</span><span style="color: black;">Beli</span><span style="color: white;">Ku</span></a>
            <div class="ms-auto">
                @auth
                    <span class="text-white me-3">Halo, {{ Auth::user()->username }}</span>
                    <a href="/home" class="btn btn-light">Home</a>
                    <a href="/produk/produkSaya" class="btn btn-light ms-2">Produk Saya</a>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-light ms-2">Logout</button>
                    </form>
                @else
                    <a href="/login" class="btn btn-light">Login</a>
                    <a href="/register" class="btn btn-outline-light ms-2">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        @yield('content')
    </div>

    <footer class="bg-light mt-5 py-4">
        <div class="container text-center">
            <p class="text-muted mb-0">&copy; {{ date('Y') }} JualBeliKu. Semua hak cipta dilindungi.</p>
        </div>
    </footer>
    @stack('scripts')
</body>
</html>
