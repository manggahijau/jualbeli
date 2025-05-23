@extends('layouts.main')

@section('title', 'Beranda')

@section('content')
    <h2>Selamat Datang</h2>
    <p>Ini adalah halaman beranda.</p>
    
@endsection

@auth
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
@endauth
