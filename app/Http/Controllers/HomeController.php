<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $produk = Product::latest()->get(); // Ambil semua produk
        return view('home', compact('produk')); // Kirim ke view
    }
}