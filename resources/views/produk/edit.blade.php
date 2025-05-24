@extends('layouts.main')
<form action="{{ route('produk.update', $produk->id) }}" method="POST">
    @csrf
    @method('PUT')

    <input type="text" name="nama_produk" value="{{ $produk->nama_produk }}" required>
    <textarea name="deskripsi">{{ $produk->deskripsi }}</textarea>
    <input type="number" name="harga" value="{{ $produk->harga }}" required>
    <input type="number" name="stok" value="{{ $produk->stok }}" required>

    <button type="submit">Perbarui Produk</button>
</form>
