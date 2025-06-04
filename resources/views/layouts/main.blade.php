<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JualBeliKu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f7f9fc;
        }
    </style>
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
        <div class="row">
            <div class="col-12">
                <div class="jumbotron bg-primary text-white p-5 rounded mb-5">
                    <h1 class="display-4">Selamat Datang di Website <a class="navbar-brand" href="/"><span style="color: white;">Jual</span><span style="color: black;">Beli</span><span style="color: white;">Ku</span></a>!</h1>
                    <p class="lead">Platform jual beli online terpercaya untuk semua kebutuhan Anda.</p>
                    @guest
                        <div class="mt-4">
                            <a href="/login" class="btn btn-light btn-lg me-3">Login</a>
                            <a href="/register" class="btn btn-outline-light btn-lg">Daftar Sekarang</a>
                        </div>
                        <small class="d-block mt-3">Login untuk dapat melakukan pembelian produk</small>
                    @endguest   
                </div>
            </div>
        </div>

        <h2 class="mb-4 text-primary">Produk Terbaru</h2>
        <div class="row">
            @forelse ($produk as $product)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        @if($product->gambar)
                            <img src="{{ asset('storage/' . $product->gambar) }}" 
                                 alt="Gambar Produk" 
                                 class="card-img-top" 
                                 style="height: 200px; object-fit: cover;">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->nama_produk }}</h5>
                            <p class="card-text">{{ Str::limit($product->deskripsi, 100) }}</p>
                            <p class="card-text fw-bold text-primary">Rp{{ number_format($product->harga, 0, ',', '.') }}</p>
                            
                            @guest
                                <div class="alert alert-info">
                                    <small>Silakan <a href="/login">login</a> untuk dapat membeli produk ini</small>
                                </div>
                            @else
                                <a href="/home" class="btn btn-primary">Lihat Detail & Beli</a>
                            @endguest
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <h4>Belum ada produk tersedia</h4>
                        <p>Produk akan segera ditambahkan. Silakan cek kembali nanti.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <footer class="bg-light mt-5 py-4">
        <div class="container text-center">
            <p class="text-muted mb-0">&copy; {{ date('Y') }} JualBeliKu. Semua hak cipta dilindungi.</p>
        </div>
    </footer>
</body>
</html></footer>
</body>
</html>
</footer>
</body>
</html>
</footer>
</body>
</html>
