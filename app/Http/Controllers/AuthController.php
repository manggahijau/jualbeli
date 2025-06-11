<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function showRegister() {
        return view('auth.register');
    }

    public function register(Request $request) {
        $request->validate([
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ], [
            'password.min' => 'password minimal 6 karakter'
        ]);

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'saldo' => 0, // Set saldo awal 0
        ]);

        return redirect('/login')->with('success', 'Pendaftaran berhasil!');
    }

    public function showLogin() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // Redirect ke /home setelah login berhasil
            return redirect()->intended('/home');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman main setelah logout
        return redirect('/');
    }

    public function showTopup() {
        return view('auth.topup');
    }

    public function topup(Request $request) {
        $request->validate([
            'jumlah' => 'required|numeric|min:1000',
        ], [
            'jumlah.required' => 'Jumlah topup harus diisi',
            'jumlah.numeric' => 'Jumlah topup harus berupa angka',
            'jumlah.min' => 'Jumlah topup minimal Rp 1.000',
        ]);

        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }

        try {
            DB::transaction(function () use ($request) {
                $user = Auth::user();
                $user->saldo = $user->saldo + $request->jumlah;
                $user->save();
            });

            return redirect()->route('topup.form')->with('success', 'Topup saldo berhasil! Saldo Anda sekarang: Rp ' . number_format(Auth::user()->saldo, 0, ',', '.'));
        } catch (\Exception $e) {
            return redirect()->route('topup.form')->with('error', 'Gagal melakukan topup. Silakan coba lagi.');
        }
    }
}