@extends('layouts.main')

@section('content')
<h2>Login</h2>
<form action="/login" method="POST">
    @csrf
    <input type="email" name="email" placeholder="Email"><br>
    <input type="password" name="password" placeholder="Password"><br>
    <button type="submit">Masuk</button>
</form>
@endsection
