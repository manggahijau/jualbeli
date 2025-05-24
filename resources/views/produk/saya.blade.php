@extends('layouts.main')

@section('content')
<div class="container">
    <h2>Produk Saya</h2>
    <a href="{{ route('produk.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>

    @foreach ($produk as $item)
        <div class="card mb-2">
            <div class="card-body">
                <h5>{{ $item->nama_produk }}</h5>
                <p>{{ $item->deskripsi }}</p>
                <p>Harga: Rp {{ number_format($item->harga) }}</p>
                <p>Stok: {{ $item->stok }}</p>
                <a href="{{ route('produk.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('produk.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection
