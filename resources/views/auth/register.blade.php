
@extends('layouts.main')

@section('content')
<h2>Register</h2>
<form action="/register" method="POST">
    @csrf
    <input type="text" name="username" placeholder="Username"><br>
    <input type="email" name="email" placeholder="Email"><br>
    <input type="password" name="password" placeholder="Password"><br>
    <input type="password" name="password_confirmation" placeholder="Ulangi Password"><br>
    <button type="submit" >Daftar</button>
</form>
@endsection
