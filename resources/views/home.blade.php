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
        <a class="navbar-brand" href="/">JualBeliKu</a>
        <div class="ms-auto">
            @auth
                <a href="/produk/produkSaya" class="btn btn-light">Produk Saya</a>
                <a href="/logout" class="btn btn-outline-light ms-2">Logout</a>
            @else
                <a href="/login" class="btn btn-light">Login</a>
                <a href="/register" class="btn btn-outline-light ms-2">Register</a>
            @endauth
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h1 class="mb-4 text-primary">Produk Terbaru</h1>
    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if($product->gambar)
                        <img src="{{ asset('storage/' . $product->gambar) }}" alt="Gambar Produk" class="w-full h-40 md:h-48 lg:h-56 object-cover object-cover rounded-lg mb-3 shadow-sm">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->nama_produk }}</h5>
                        <p class="card-text">{{ $product->deskripsi }}</p>
                        <p class="card-text fw-bold">Rp{{ number_format($product->harga, 0, ',', '.') }}</p>
                        <form method="POST" action="{{ route('produk.beli', $product->id) }}">
                            @csrf
                            <div class="input-group mb-2">
                                <input type="number" name="jumlah" class="form-control" min="1" placeholder="Jumlah">
                                <button class="btn btn-primary" type="submit">Beli</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
</body>
</html>