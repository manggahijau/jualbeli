<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JualBeliKu - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="/home">JualBeliKu</a>
        <div class="ms-auto">
            @auth
                <span class="text-white me-3">Halo, {{ Auth::user()->username }}</span>
                <a href="/produk/produkSaya" class="btn btn-light">Produk Saya</a>
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
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="bg-success text-white p-4 rounded mb-4">
                <h1 class="mb-2">Selamat Datang di JualBeliKu!</h1>
                <p class="mb-0">Anda sekarang dapat melakukan pembelian produk. Selamat berbelanja!</p>
            </div>
        </div>
    </div>

    <h1 class="mb-4 text-primary">Produk Terbaru</h1>
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
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->nama_produk }}</h5>
                        <p class="card-text flex-grow-1">{{ $product->deskripsi }}</p>
                        <p class="card-text fw-bold text-success fs-5">Rp{{ number_format($product->harga, 0, ',', '.') }}</p>
                        
                        @auth
                            @if($product->user_id != Auth::id())
                                <form method="POST" action="{{ route('produk.beli', $product->id) }}">
                                    @csrf
                                    <div class="input-group mb-2">
                                        <input type="number" 
                                                name="jumlah" 
                                                class="form-control" 
                                                min="1" 
                                                max="99" 
                                                value="1"
                                                placeholder="Jumlah" 
                                                required>
                                        <button class="btn btn-primary" type="submit">
                                            <i class="bi bi-cart-plus"></i> Beli Sekarang
                                        </button>
                                    </div>
                                </form>
                            @else
                                <div class="alert alert-secondary">
                                    <small>Ini adalah produk Anda sendiri</small>
                                </div>
                            @endif
                        @else
                            <a href="/login" class="btn btn-outline-primary">Login untuk Membeli</a>
                        @endauth
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <h4>Belum ada produk tersedia</h4>
                    <p>Jadilah yang pertama untuk <a href="/produk/create">menambahkan produk</a>!</p>
                </div>
            </div>
        @endforelse
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>