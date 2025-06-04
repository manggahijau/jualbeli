<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JualBeliKu - Selamat Datang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="/">JualBeliKu</a>
        <div class="ms-auto">
            <a href="/login" class="btn btn-light">Login</a>
            <a href="/register" class="btn btn-outline-light ms-2">Register</a>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="bg-primary text-white p-5 rounded mb-4">
                <h1 class="mb-3">Selamat Datang di <strong>JualBeliKu</strong>!</h1>
                <p class="lead">Platform jual beli online terpercaya untuk semua kebutuhan Anda.</p>
                <p class="mb-0">Silakan login atau daftar untuk mulai berbelanja atau menjual produk Anda.</p>
                <div class="mt-4">
                    <a href="/login" class="btn btn-light btn-lg me-3">Login</a>
                    <a href="/register" class="btn btn-outline-light btn-lg">Daftar Sekarang</a>
                </div>
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
                        <p class="card-text">{{ \Illuminate\Support\Str::limit($product->deskripsi, 100) }}</p>
                        <p class="card-text fw-bold text-primary">Rp{{ number_format($product->harga, 0, ',', '.') }}</p>
                        <a href="/login" class="btn btn-outline-primary">Login untuk Membeli</a>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
