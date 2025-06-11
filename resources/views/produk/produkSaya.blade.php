@extends('layouts.main')

@section('content')
<div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
    <h1 class="text-3xl font-bold text-blue-700 mb-6">📦 Produk Saya</h1>

    {{-- @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif --}}

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        {{-- Daftar Produk --}}
        @foreach($produk as $product)
            <div class="bg-white shadow-md rounded-xl overflow-hidden flex flex-col justify-between hover:shadow-lg transition">
                <div>
                    @if($product->gambar)
                        <img src="{{ asset('storage/' . $product->gambar) }}"
                             alt="Gambar Produk"
                             class="w-full h-40 object-cover border-b">
                    @else
                        <div class="w-full h-40 bg-gray-200 flex items-center justify-center text-gray-500">
                            Tidak Ada Gambar
                        </div>
                    @endif

                    <div class="p-4">
                        <h2 class="text-lg font-semibold text-gray-800 truncate">{{ $product->nama_produk }}</h2>
                        <p class="text-sm text-gray-500 mb-1">{{ $product->deskripsi }}</p>
                        <p class="text-md font-bold text-blue-600 mb-1">Rp{{ number_format($product->harga, 0, ',', '.') }}</p>
                        <p class="text-sm text-gray-700">Stok: {{ $product->stok }}</p>

                        {{-- Badge Diskon Grosir --}}
                        @if($product->is_grosir)
                            <span class="inline-block mt-2 px-2 py-1 text-xs bg-green-100 text-green-700 font-semibold rounded">
                                Diskon Grosir Tersedia
                            </span>
                        @endif
                    </div>
                </div>

                <div class="px-4 pb-4 mt-auto flex justify-between gap-2">
                    <a href="{{ route('produk.edit', $product->id) }}"
                       class="flex-1 text-center text-sm bg-yellow-400 hover:bg-yellow-500 text-white font-semibold py-1 rounded">
                        Edit
                    </a>
                    <form action="{{ route('produk.destroy', $product->id) }}" method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus produk ini?')" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="w-full text-sm bg-red-500 hover:bg-red-600 text-white font-semibold py-1 rounded">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        @endforeach

        {{-- Kartu Tambah Produk --}}
        <a href="{{ route('produk.create') }}"
           class="flex items-center justify-center bg-white rounded-xl shadow-md hover:shadow-lg transition border-2 border-dashed border-gray-300 p-4 text-center">
            <div class="flex flex-col items-center">
                <div class="text-5xl text-gray-600 mb-2">+</div>
                <p class="text-blue-600 font-semibold">Tambah Produk</p>
            </div>
        </a>
    </div>
</div>
@endsection
