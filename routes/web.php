<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

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


Route::get('/produk/create', [ProductController::class, 'create'])->middleware('auth');
Route::post('/produk', [ProductController::class, 'store'])->middleware('auth');
Route::get('/', function () {
    $products = \App\Models\Product::all();
    return view('home', compact('products'));
});
Route::get('/dashboard', function () {
    $products = \App\Models\Product::all();
    return view('dashboard', compact('products'));
})->middleware('auth');