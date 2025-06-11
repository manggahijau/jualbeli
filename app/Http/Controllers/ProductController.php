<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\DiskonGrosir;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

public function allProduct(Request $request)
    {
        $query = Product::with(['user', 'diskonGrosir']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_produk', 'like', '%' . $search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $search . '%');
            });
        }

        // Category filter
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // Sorting
        switch ($request->sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'price_low':
                $query->orderBy('harga', 'asc');
                break;
            case 'price_high':
                $query->orderBy('harga', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('nama_produk', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('nama_produk', 'desc');
                break;
            default: // newest
                $query->orderBy('created_at', 'desc');
                break;
        }

        // Only show products with stock > 0
        $query->where('stok', '>', 0);

        // Paginate results
        $produk = $query->paginate(12);

        return view('produk.produk', compact('produk'));
    }

public function create()
{
    $produk = Product::latest()->take(6)->get(); // Atau query lain yang sesuai
    return view('produk.create', compact('produk'));
}


public function store(Request $request)
{
    $validated = $request->validate([
        'nama_produk' => 'required',
        'deskripsi' => 'nullable',
        'harga' => 'required|numeric',
        'stok' => 'required|integer',
        'kategori' => 'required|string',
        'status' => 'required|in:Tersedia,Tidak Tersedia',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'is_grosir' => 'nullable', 
        'diskon_grosir.minimal_jumlah.*' => 'nullable|integer|min:1',
        'diskon_grosir.persentase_diskon.*' => 'nullable|numeric|min:1|max:100',
    ]);

    try {
        // Gunakan DB transaction untuk keamanan
        DB::beginTransaction();

        // Handle upload gambar terlebih dahulu
        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('gambar_produk', 'public');
        }

        // Buat produk dengan semua data sekaligus
        $produk = Product::create([
            'nama_produk' => $validated['nama_produk'],
            'deskripsi' => $validated['deskripsi'],
            'harga' => $validated['harga'],
            'stok' => $validated['stok'],
            'kategori' => $validated['kategori'], // <-- INI YANG PENTING!
            'status' => $validated['status'],
            'gambar' => $gambarPath,
            'user_id' => Auth::id(),
            'is_grosir' => $request->has('is_grosir') ? 1 : 0,
        ]);

        // Handle diskon grosir jika ada
        if ($request->has('is_grosir') && $request->filled('diskon_grosir.minimal_jumlah')) {
            foreach ($request->diskon_grosir['minimal_jumlah'] as $index => $min_jumlah) {
                $persen = $request->diskon_grosir['persentase_diskon'][$index] ?? null;

                if ($min_jumlah && $persen) {
                    DiskonGrosir::create([
                        'product_id' => $produk->id,
                        'minimal_jumlah' => $min_jumlah,
                        'persentase_diskon' => $persen,
                    ]);
                }
            }
        }

        DB::commit();
        
        return redirect()->route('produk.create')->with('success', 'Produk berhasil ditambahkan!');
        
    } catch (\Exception $e) {
        DB::rollback();
        
        // Hapus gambar jika sudah terupload tapi ada error
        if ($gambarPath && Storage::disk('public')->exists($gambarPath)) {
            Storage::disk('public')->delete($gambarPath);
        }
        
        return redirect()->back()
                         ->withInput()
                         ->with('error', 'Gagal menambahkan produk: ' . $e->getMessage());
    }
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
    $produk->kategori = $request->kategori;
    $produk->status = $request->status;
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