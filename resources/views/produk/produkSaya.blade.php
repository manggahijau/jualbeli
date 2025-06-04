@extends('layouts.main')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6 text-blue-700">Produk Saya</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        {{-- Produk List --}}
        @foreach($produk as $product)
            <div class="bg-white rounded-lg shadow p-4 flex flex-col justify-between">
                <div>
                    @if($product->gambar)
                        <img src="{{ asset('storage/' . $product->gambar) }}" alt="Gambar Produk" class="w-full h-40 object-cover rounded mb-3 border">
                    @endif
                    <h2 class="font-bold text-black text-md">{{ $product->nama_produk }}</h2>
                    <p class="text-sm text-gray-600">{{ $product->deskripsi }}</p>
                    <p class="text-sm text-black mt-1">Rp{{ number_format($product->harga, 0, ',', '.') }}</p>
                </div>
                <div class="mt-3 flex justify-between gap-2">
                    <a href="{{ route('produk.edit', $product->id) }}" class="flex-1 text-center border border-blue-500 text-blue-600 font-semibold py-1 rounded hover:bg-blue-100">
                        Edit
                    </a>
                    <form action="{{ route('produk.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full text-white bg-red-600 hover:bg-red-700 font-semibold py-1 rounded">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        @endforeach

        {{-- Kartu Tambah Produk --}}
        <form action="{{ route('produk.create') }}" method="GET" class="flex items-center justify-center">
            <button type="submit" class="w-full h-full flex flex-col items-center justify-center bg-white rounded-lg shadow border-2 border-dashed border-gray-300 hover:border-blue-400 p-4 text-center">
                <div class="text-4xl text-black mb-2">+</div>
                <p class="text-green-600 font-semibold">Tambah Produk</p>
            </button>
        </form>
    </div>
</div>
@endsection
