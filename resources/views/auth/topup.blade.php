@extends('layouts.main')

@section('content')
    <h1 class="text-2xl font-bold text-blue-700 mb-6">Top-Up Saldo</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('topup.store') }}" method="POST" class="max-w-md bg-white p-6 rounded shadow">
        @csrf
        <label class="block mb-2 font-semibold text-gray-700">Jumlah Top-Up (minimal 1000)</label>
        <input type="number" name="jumlah" step="0.01" min="1000" required
               class="w-full border rounded px-3 py-2 mb-4" value="{{ old('jumlah') }}">

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Tambah Saldo
        </button>
    </form>
@endsection
