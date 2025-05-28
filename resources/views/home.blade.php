@extends('layouts.main')

@section('title', 'Beranda')

@section('content')
    <h2>Selamat Datang di Situs Jual Beli</h2>
    <p>Silakan login atau daftar untuk melanjutkan.</p>

    <a href="{{ route('login') }}">
        <button>Login</button>
    </a>

    <a href="{{ route('register') }}">
        <button>Register</button>
    </a>
@endsection

@foreach ($products as $produk)
  <div class="produk">
    <h3>{{ $produk->nama_produk }}</h3>
    <p>{{ $produk->deskripsi }}</p>
    <p>Harga: Rp{{ number_format($produk->harga, 0, ',', '.') }}</p>
    <p>Stok: {{ $produk->stok }}</p>
    <p>Penjual: {{ $produk->user->username }}</p>

    @if($produk->gambar)
    <img src="{{ asset('storage/' . $produk->gambar) }}" alt="Gambar Produk" width="100">
    @endif

    @if ($produk->is_grosir && $produk->diskonGrosir && $produk->diskonGrosir->count())
    <strong>Diskon Grosir:</strong>
    <ul>
        @foreach ($produk->diskonGrosir->sortBy('minimal_jumlah') as $diskon)
            <li>
                Beli minimal {{ $diskon->minimal_jumlah }}: Diskon {{ $diskon->persentase_diskon }}% (jadi Rp{{ number_format($produk->harga * (1 - $diskon->persentase_diskon / 100), 0, ',', '.') }})
            </li>
        @endforeach
    </ul>
@endif

    @auth   
    <form method="POST" action="{{ route('produk.beli', $produk->id) }}">
      @csrf
      <input type="number" name="jumlah" min="1" max="{{ $produk->stok }}" required>
      <button type="submit">Beli Sekarang</button>
    
    </form>
    @endauth

    @guest
    <p><em>Login dulu untuk membeli produk ini.</em></p>
    <a href="{{ route('login') }}">
        <button>Login untuk Beli</button>
    </a>
    @endguest
  </div>
@endforeach


