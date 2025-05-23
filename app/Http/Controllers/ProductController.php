<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function create() {
    return view('product.create');
}

public function store(Request $request) {
    $request->validate([
        'nama_produk' => 'required',
        'deskripsi' => 'nullable',
        'harga' => 'required|numeric',
        'stok' => 'required|integer',
    ]);

    Product::create($request->all());

    return redirect('/dashboard')->with('success', 'Produk berhasil ditambahkan!');
}
}
