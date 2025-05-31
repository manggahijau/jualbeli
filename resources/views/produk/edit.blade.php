@extends('layouts.main')

@section('content')
    <h1 class="text-2xl font-bold text-blue-700 mb-4">Edit Produk</h1>

    <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow max-w-lg">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Nama Produk</label>
            <input type="text" name="nama_produk" value="{{ $produk->nama_produk }}" class="mt-1 w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
            <textarea name="deskripsi" class="mt-1 w-full border rounded px-3 py-2" required>{{ $produk->deskripsi }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Harga</label>
            <input type="number" name="harga" value="{{ $produk->harga }}" class="mt-1 w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Stok</label>
            <input type="number" name="stok" value="{{ $produk->stok }}" class="mt-1 w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Gambar Produk (opsional)</label>
            <input type="file" name="gambar" class="mt-1 w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_grosir" {{ $produk->is_grosir ? 'checked' : '' }} class="mr-2">
                Produk ini memiliki diskon grosir
            </label>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update Produk</button>
    </form>
@endsection
