@extends('layouts.main')

@section('title', 'Beranda')

@section('content')
    <h2>Selamat Datang di Situs Jual Beli</h2>
    <p>Silakan login atau daftar untuk melanjutkan.</p>

    <a href="{{ route('login') }}">
        <button>Login</button>
    </a>

    <a href="{{ route('register') }}">
        <button>Register</button>
    </a>
@endsection
