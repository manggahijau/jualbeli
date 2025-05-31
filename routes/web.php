<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return view('home');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');



Route::get('/', function () {
    $products = \App\Models\Product::all();
    return view('home', compact('products'));
});
Route::get('/dashboard', function () {
    $products = \App\Models\Product::all();
    return view('dashboard', compact('products'));
})->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/produk/saya', [ProductController::class, 'saya'])->name('produk.saya');
    Route::get('/produk/saya', [ProductController::class, 'myProducts'])->name('produk.saya');
    Route::get('/produk/create', [ProductController::class, 'create'])->name('produk.create');
    Route::post('/produk', [ProductController::class, 'store'])->name('produk.store');
    Route::get('/produk/{id}/edit', [ProductController::class, 'edit'])->name('produk.edit');
    Route::put('/produk/{id}', [ProductController::class, 'update'])->name('produk.update');
    Route::delete('/produk/{id}', [ProductController::class, 'destroy'])->name('produk.destroy');
});


Route::post('/produk/{id}/beli', [TransactionController::class, 'store'])->name('produk.beli');
