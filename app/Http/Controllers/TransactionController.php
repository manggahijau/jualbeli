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
   $product = Product::with('diskonGrosir')->findOrFail($id);
    $jumlah = $request->input('jumlah');
    $user = Auth::user();
    $harga = $product->harga;
    $diskon = 0;

    // 💡 Cek apakah produk aktifkan harga grosir
    if ($product->is_grosir) {
        $diskonTepat = $product->diskonGrosir()
            ->where('minimal_jumlah', '<=', $jumlah)
            ->orderByDesc('minimal_jumlah')
            ->first();

        if ($diskonTepat) {
            $diskon = $diskonTepat->persentase_diskon;
        }
    }

    $totalHarga = $harga * $jumlah * ((100 - $diskon) / 100);
    if ($user->saldo < $totalHarga) {
        return redirect()->back()->with('error', 'Saldo tidak cukup untuk melakukan pembelian.');
    }

    $user->saldo -= $totalHarga;
    $user->save();

    $penjual = $product->user;
    $penjual->saldo += $totalHarga;
    $penjual->save();
    // Buat transaksi
    Transaction::create([
        'user_id' => Auth::id(),
        'product_id' => $product->id,
        'jumlah' => $request->jumlah,
        'total_harga' => $totalHarga
    ]);

    // Kurangi stok produk
    $product->decrement('stok', $request->jumlah);

    return redirect('/home')->with('success', 'Pembelian berhasil! Produk akan segera dikirim… mungkin.');
}

}
