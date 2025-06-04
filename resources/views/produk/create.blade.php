@extends('layouts.main')

@section('content')
    <h1 class="text-2xl font-bold text-blue-700 mb-4">Tambah Produk Baru</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow max-w-lg">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Nama Produk</label>
            <input type="text" name="nama_produk" class="mt-1 w-full border rounded px-3 py-2" value="{{ old('nama_produk') }}" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
            <textarea name="deskripsi" class="mt-1 w-full border rounded px-3 py-2">{{ old('deskripsi') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Harga</label>
            <input type="number" name="harga" step="0.01" class="mt-1 w-full border rounded px-3 py-2" value="{{ old('harga') }}" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Stok</label>
            <input type="number" name="stok" class="mt-1 w-full border rounded px-3 py-2" value="{{ old('stok') }}" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Gambar Produk</label>
            <input type="file" name="gambar" class="mt-1 w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox" id="toggleGrosir" name="is_grosir" class="mr-2" {{ old('is_grosir') ? 'checked' : '' }}>
                Produk ini memiliki diskon grosir
            </label>
        </div>

        <div id="grosirFields" class="{{ old('is_grosir') ? '' : 'hidden' }} mb-4">
            <label class="block font-semibold text-gray-700 mb-2">Diskon Grosir</label>
            <div id="grosirContainer">
                <div class="flex gap-2 mb-2">
                    <input type="number" name="diskon_grosir[minimal_jumlah][]" placeholder="Minimal Jumlah" class="border rounded px-3 py-2 w-1/2">
                    <input type="number" name="diskon_grosir[persentase_diskon][]" placeholder="Diskon (%)" class="border rounded px-3 py-2 w-1/2">
                </div>
            </div>
            <button type="button" id="addDiskon" class="text-blue-600 text-sm hover:underline">+ Tambah Diskon</button>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan Produk</button>
    </form>

    <script>
        document.getElementById('toggleGrosir').addEventListener('change', function () {
            const grosirFields = document.getElementById('grosirFields');
            grosirFields.classList.toggle('hidden', !this.checked);
        });

        document.getElementById('addDiskon').addEventListener('click', function () {
            const container = document.getElementById('grosirContainer');
            const div = document.createElement('div');
            div.classList.add('flex', 'gap-2', 'mb-2');
            div.innerHTML = `
                <input type="number" name="diskon_grosir[minimal_jumlah][]" placeholder="Minimal Jumlah" class="border rounded px-3 py-2 w-1/2">
                <input type="number" name="diskon_grosir[persentase_diskon][]" placeholder="Diskon (%)" class="border rounded px-3 py-2 w-1/2">
            `;
            container.appendChild(div);
        });
    </script>
@endsection
