@extends('layouts.main')

@section('title', 'Kategori Produk')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Kategori Produk</h1>
            <p class="text-gray-600">Jelajahi berbagai kategori produk pilihan</p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
            @foreach($kategoris as $slug => $kategori)
            <a href="{{ route('kategori.show', $slug) }}" 
               class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-xl transform hover:scale-105 transition-all duration-200 cursor-pointer">
                <div class="w-16 h-16 bg-{{ $kategori['color'] }}-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-{{ $kategori['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $kategori['icon'] }}"></path>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 text-lg">{{ $kategori['name'] }}</h3>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endsection