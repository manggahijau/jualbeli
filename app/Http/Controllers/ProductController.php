<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

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
    ]);

    $validated['user_id'] = Auth::id();

    Product::create($validated);

    return redirect()->route('produk.saya')->with('success', 'Produk berhasil ditambahkan.');
}

public function destroy($id)
{
    $produk = Product::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
    $produk->delete();

    return redirect()->route('produk.saya')->with('success', 'Produk berhasil dihapus.');
}


public function myProducts()
{
    $produk = Product::where('user_id', Auth::id())->get();
    return view('produk.saya', compact('produk'));
}

public function edit($id)
{
    $produk = Product::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
    return view('produk.edit', compact('produk'));
}

public function update(Request $request, $id)
{
    $validated = $request->validate([
        'nama_produk' => 'required',
        'deskripsi' => 'nullable',
        'harga' => 'required|numeric',
        'stok' => 'required|integer',
    ]);

    $produk = Product::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
    $produk->update($validated);

    return redirect()->route('produk.saya')->with('success', 'Produk berhasil diupdate.');
}



}
