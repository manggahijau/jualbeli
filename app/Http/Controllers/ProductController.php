<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\DiskonGrosir;

class ProductController extends Controller
{
    public function create()
{
    return view('produk.create');
}

public function store(Request $request)
{
    
    $validated = $request->validate([
        'nama_produk' => 'required',
        'deskripsi' => 'nullable',
        'harga' => 'required|numeric',
        'stok' => 'required|integer',
        'is_grosir' => 'nullable|boolean', // Validasi untuk checkbox is_grosir
        'minimal_jumlah' => 'nullable|integer|min:1',
        'persentase_diskon' => 'nullable|numeric|min:1|max:100',
    ]);

    
    $validated['user_id'] = Auth::id();

    $produk = Product::create([
        'nama_produk' => $request->nama_produk,
        'deskripsi' => $request->deskripsi,
        'harga' => $request->harga,
        'stok' => $request->stok,
        'user_id' => Auth::id(),
        'is_grosir' => $request->has('is_grosir') ? 1 : 0, // Menangani checkbox is_grosir
    ]);

    if ($request->hasFile('gambar')) {
    $gambar = $request->file('gambar')->store('gambar_produk', 'public');
    $produk->gambar = $gambar;
}
    $produk->user_id = Auth::id();
    $produk->save();

   if ($request->has('is_grosir') && $request->filled('diskon_grosir.minimal_jumlah')) {
    foreach ($request->diskon_grosir['minimal_jumlah'] as $index => $min_jumlah) {
        $persen = $request->diskon_grosir['persentase_diskon'][$index];

        if ($min_jumlah && $persen) {
            DiskonGrosir::create([
                'product_id' => $produk->id,
                'minimal_jumlah' => $min_jumlah,
                'persentase_diskon' => $persen,
            ]);
        }
    }
}


    return redirect()->route('produk.produkSaya')->with('success', 'Produk berhasil ditambahkan.');
}


public function destroy($id)
{
    $produk = Product::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
    $produk->delete();

    return redirect()->route('produk.produkSaya')->with('success', 'Produk berhasil dihapus.');
}


public function myProducts()
{
    $produk = Product::where('user_id', Auth::id())->get();
    return view('produk.produkSaya', compact('produk'));
}

public function edit($id)
{
    $produk = Product::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
    return view('produk.edit', compact('produk')); // setelah return, kode di bawah tidak akan jalan

    // Kode berikut tidak akan pernah dieksekusi
    $produk->is_grosir = $request->has('is_grosir');
    $produk->save();
}


public function update(Request $request, $id)
{
    $produk = Product::findOrFail($id);

    $produk->nama_produk = $request->nama_produk;
    $produk->deskripsi = $request->deskripsi;
    $produk->harga = $request->harga;
    $produk->stok = $request->stok;
    $produk->is_grosir = $request->has('is_grosir') ? 1 : 0;
    $produk->save();

    if ($request->hasFile('gambar')) {
    $gambar = $request->file('gambar')->store('gambar_produk', 'public');
    $produk->gambar = $gambar;
}
    $produk->user_id = Auth::id();
    $produk->save();

    $produk->diskonGrosir()->delete();

   if ($request->has('is_grosir') && $request->filled('diskon_grosir.minimal_jumlah')) {
    foreach ($request->diskon_grosir['minimal_jumlah'] as $index => $min_jumlah) {
        $persen = $request->diskon_grosir['persentase_diskon'][$index];

        if ($min_jumlah && $persen) {
            DiskonGrosir::create([
                'product_id' => $produk->id,
                'minimal_jumlah' => $min_jumlah,
                'persentase_diskon' => $persen,
            ]);
        }
    }
}

    return redirect()->route('produk.produkSaya')->with('success', 'Produk berhasil diperbarui');
}





}
