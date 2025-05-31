@extends('layouts.main')

@section('content')
    <h1 class="text-2xl font-bold mb-4 text-blue-700">Dashboard</h1>

    <div class="mb-4">
        <a href="{{ route('produk.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            + Tambah Produk Baru
        </a>
    </div>

    <table class="min-w-full bg-white border rounded shadow">
        <thead class="bg-blue-600 text-white">
            <tr>
                <th class="px-4 py-2 text-left">Nama Produk</th>
                <th class="px-4 py-2 text-left">Harga</th>
                <th class="px-4 py-2 text-left">Stok</th>
                <th class="px-4 py-2 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr class="border-t hover:bg-gray-50">
                <td class="px-4 py-2">{{ $product->nama_produk }}</td>
                <td class="px-4 py-2">Rp{{ number_format($product->harga, 0, ',', '.') }}</td>
                <td class="px-4 py-2">{{ $product->stok }}</td>
                <td class="px-4 py-2">
                    <a href="{{ route('produk.edit', $product->id) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
                    <form action="{{ route('produk.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Hapus produk ini?')" class="text-red-600 hover:underline">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach

            @if($products->isEmpty())
            <tr>
                <td colspan="4" class="px-4 py-2 text-center text-gray-500">Belum ada produk yang ditambahkan.</td>
            </tr>
            @endif
        </tbody>
    </table>
@endsection
