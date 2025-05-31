@extends('layouts.main')

@section('content')
    <h1 class="text-2xl font-bold mb-4 text-blue-700">Produk Saya</h1>

    @if($produk->isEmpty())
        <p class="text-gray-600">Kamu belum menambahkan produk.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($produk as $product)
                <div class="bg-white shadow rounded p-4">
                    {{-- Tampilkan gambar produk --}}
                    <img src="{{ asset('storage/' . $product->gambar) }}" alt="Gambar Produk" class="w-full h-40 md:h-48 lg:h-56 object-cover object-cover rounded-lg mb-3 shadow-sm">

                    <h2 class="text-lg font-semibold text-blue-700">{{ $product->nama_produk }}</h2>
                    <p class="text-sm text-gray-600">{{ $product->deskripsi }}</p>
                    <p class="mt-2 text-blue-600 font-bold">Rp{{ number_format($product->harga, 0, ',', '.') }}</p>
                    <p class="text-sm text-gray-500">Stok: {{ $product->stok }}</p>
                    <div class="mt-3 flex gap-2">
                        <a href="{{ route('produk.edit', $product->id) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form action="{{ route('produk.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus produk ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
