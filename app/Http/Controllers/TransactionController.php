<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
class TransactionController extends Controller
{
  public function store(Request $request, $id)
{
    $request->validate([
        'jumlah' => 'required|integer|min:1'
    ]);

    $product = Product::findOrFail($id);

    // Cek stok
    if ($request->jumlah > $product->stok) {
        return back()->with('error', 'Stok tidak cukup. Silakan cari produk lain atau menangis dalam keheningan.');
    }

    // Hitung total harga
    $total = $request->jumlah * $product->harga;

    // Buat transaksi
    Transaction::create([
        'user_id' => Auth::id(),
        'product_id' => $product->id,
        'jumlah' => $request->jumlah,
        'total_harga' => $total
    ]);

    // Kurangi stok produk
    $product->decrement('stok', $request->jumlah);

    return redirect('/dashboard')->with('success', 'Pembelian berhasil! Produk akan segera dikirim… mungkin.');
}

}
