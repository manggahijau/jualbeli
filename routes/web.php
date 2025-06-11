<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\HomeController;


// Route untuk halaman main (user belum login) - menampilkan produk tanpa bisa beli
Route::get('/', function () {
    $produk = \App\Models\Product::all();
    return view('landpage', compact('produk'));
})->name('landpage');

// Routes untuk authentication
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Routes yang memerlukan authentication
Route::middleware('auth')->group(function () {
    // Route untuk halaman home (user sudah login) - bisa beli produk
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Route untuk kategori
    Route::get('/kategori/{slug}', [App\Http\Controllers\KategoriController::class, 'show'])->name('kategori.show');
    Route::get('/kategori', [App\Http\Controllers\KategoriController::class, 'index'])->name('kategori.index');
    
    // Routes untuk produk
    Route::get('/produk/produk', [ProductController::class, 'allProduct'])->name('produk.produk');
    Route::get('/produk/produkSaya', [ProductController::class, 'myProducts'])->name('produk.produkSaya');
    Route::get('/produk/create', [ProductController::class, 'create'])->name('produk.create');
    Route::post('/produk', [ProductController::class, 'store'])->name('produk.store');
    Route::get('/produk/{id}/edit', [ProductController::class, 'edit'])->name('produk.edit');
    Route::put('/produk/{id}', [ProductController::class, 'update'])->name('produk.update');
    Route::delete('/produk/{id}', [ProductController::class, 'destroy'])->name('produk.destroy');
    
    // Route untuk topup saldo
    Route::get('/topup', [AuthController::class, 'showTopup'])->name('topup.form');
    Route::post('/topup', [AuthController::class, 'topup'])->name('topup.store');

    // Route untuk pembelian
    Route::post('/produk/{id}/beli', [TransactionController::class, 'store'])->name('produk.beli');
    
    // Route logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/logout', [AuthController::class, 'logout']);
});