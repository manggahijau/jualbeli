@extends('layouts.main')

@section('title', 'Beranda')

@section('content')
    <h2>Selamat Datang</h2>
    <p>Ini adalah halaman beranda.</p>
    
@endsection

@auth
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
        <a href="{{ url('/produk/saya') }}">Tambah Produk</a>
    </form>

    
@endauth

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

    <form method="POST" action="{{ route('produk.beli', $produk->id) }}">
      @csrf
      <input type="number" name="jumlah" min="1" max="{{ $produk->stok }}" required>
      <button type="submit">Beli Sekarang</button>
    </form>
  </div>
@endforeach
