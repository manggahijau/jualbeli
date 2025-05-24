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
    <div>
        <h3>{{ $produk->nama_produk }}</h3>
        <p>{{ $produk->deskripsi }}</p>
        <p>Rp{{ number_format($produk->harga, 0, ',', '.') }}</p>
        <p>Stok: {{ $produk->stok }}</p>
        <p>Penjual: {{ $produk->user->username }}</p>
    </div>
@endforeach

