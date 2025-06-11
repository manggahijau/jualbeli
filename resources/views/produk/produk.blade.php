@extends('layouts.main')

@section('title', 'Semua Produk')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Semua Produk</h1>
                    <p class="mt-2 text-gray-600">Temukan berbagai produk terbaik dari penjual terpercaya</p>
                </div>
                @auth
                    <div class="mt-4 md:mt-0">
                        <a href="{{ route('produk.create') }}" 
                           class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah Produk
                        </a>
                    </div>
                @endauth
            </div>
        </div>

        <!-- Filter dan Search Section -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
            <form method="GET" action="{{ route('produk.produk') }}" class="space-y-4 md:space-y-0 md:flex md:items-center md:space-x-4">
                <!-- Search -->
                <div class="flex-1">
                    <div class="relative">
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}"
                               placeholder="Cari produk..." 
                               class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Kategori Filter -->
                <div class="md:w-48">
                    <select name="kategori" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Semua Kategori</option>
                        <option value="elektronik" {{ request('kategori') == 'elektronik' ? 'selected' : '' }}>Elektronik</option>
                        <option value="fashion" {{ request('kategori') == 'fashion' ? 'selected' : '' }}>Fashion</option>
                        <option value="makanan" {{ request('kategori') == 'makanan' ? 'selected' : '' }}>Makanan</option>
                        <option value="perabot" {{ request('kategori') == 'perabot' ? 'selected' : '' }}>Perabot</option>
                        <option value="olahraga" {{ request('kategori') == 'olahraga' ? 'selected' : '' }}>Olahraga</option>
                        <option value="buku" {{ request('kategori') == 'buku' ? 'selected' : '' }}>Buku</option>
                        <option value="lainnya" {{ request('kategori') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>

                <!-- Sort By -->
                <div class="md:w-48">
                    <select name="sort" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Harga Terendah</option>
                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Harga Tertinggi</option>
                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama A-Z</option>
                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama Z-A</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" 
                            class="w-full md:w-auto px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                        Filter
                    </button>
                </div>

                <!-- Reset Button -->
                @if(request()->hasAny(['search', 'kategori', 'sort']))
                    <div>
                        <a href="{{ route('produk.produk') }}" 
                           class="w-full md:w-auto inline-block px-6 py-2 bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-lg transition-colors duration-200 text-center">
                            Reset
                        </a>
                    </div>
                @endif
            </form>
        </div>

        <!-- Products Grid -->
        <div class="mb-6">
            @if($produk->count() > 0)
                <p class="text-gray-600">Menampilkan {{ $produk->count() }} dari {{ $produk->total() }} produk</p>
            @endif
        </div>

        @forelse ($produk as $product)
            @if($loop->first)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
            @endif
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <!-- Product Image -->
                    @if($product->gambar)
                        <div class="aspect-w-16 aspect-h-9 relative">
                            <img src="{{ asset('storage/' . $product->gambar) }}" 
                                alt="{{ $product->nama_produk }}" 
                                class="w-full h-48 object-cover">
                            <!-- Kategori Badge -->
                            <div class="absolute top-2 left-2">
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                    {{ ucfirst($product->kategori) }}
                                </span>
                            </div>
                            @if($product->is_grosir)
                                <div class="absolute top-2 right-2">
                                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                        Grosir
                                    </span>
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center relative">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <!-- Kategori Badge -->
                            <div class="absolute top-2 left-2">
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                    {{ ucfirst($product->kategori) }}
                                </span>
                            </div>
                            @if($product->is_grosir)
                                <div class="absolute top-2 right-2">
                                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                        Grosir
                                    </span>
                                </div>
                            @endif
                        </div>
                    @endif
                    
                    <!-- Product Info -->
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2 hover:text-blue-600 transition-colors duration-200">
                            {{ $product->nama_produk }}
                        </h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ $product->deskripsi }}</p>
                        
                        <!-- Price and Stock -->
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-2xl font-bold text-green-600">
                                Rp{{ number_format($product->harga, 0, ',', '.') }}
                            </span>
                            <div class="text-right">
                                <span class="text-sm text-gray-500 block">Stok: {{ $product->stok }}</span>
                                <span class="text-xs text-gray-400">oleh {{ $product->user->username ?? 'Unknown' }}</span>
                            </div>
                        </div>

                        <!-- Wholesale Discount Info -->
                        @if($product->is_grosir && $product->diskonGrosir->count() > 0)
                            <div class="bg-blue-50 rounded-lg p-3 mb-4">
                                <div class="flex items-center mb-2">
                                    <svg class="w-4 h-4 text-blue-600 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                    <span class="text-sm font-medium text-blue-700">Diskon Grosir</span>
                                </div>
                                <div class="space-y-1">
                                    @foreach($product->diskonGrosir as $diskon)
                                        <div class="text-xs text-blue-600">
                                            Minimal {{ $diskon->minimal_jumlah }} pcs - {{ $diskon->persentase_diskon }}% off
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Action Buttons -->
                        @auth
                            @if($product->user_id != Auth::id())
                                <form method="POST" action="{{ route('produk.beli', $product->id) }}" class="space-y-3">
                                    @csrf
                                    <div class="flex space-x-2">
                                        <input type="number" 
                                            name="jumlah" 
                                            class="flex-1 border-2 border-gray-200 rounded-lg px-3 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200" 
                                            min="1" 
                                            max="{{ $product->stok }}" 
                                            value="1"
                                            placeholder="Qty" 
                                            required>
                                        <button type="submit" 
                                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m1.6 8L6 21H4M7 13v8a2 2 0 002 2h6a2 2 0 002-2v-8m-8 0V9a2 2 0 012-2h4a2 2 0 012 2v4"></path>
                                            </svg>
                                            Beli
                                        </button>
                                    </div>
                                </form>
                            @else
                                <div class="bg-gray-50 border border-gray-200 rounded-lg p-3 text-center">
                                    <span class="text-sm text-gray-600 flex items-center justify-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        Produk Anda
                                    </span>
                                </div>
                            @endif
                        @else
                            <a href="{{ route('login') }}" 
                               class="block w-full bg-gray-100 hover:bg-gray-200 text-gray-700 text-center py-3 rounded-lg font-medium transition-colors duration-200">
                                Login untuk Membeli
                            </a>
                        @endauth
                    </div>
                </div>
            @if($loop->last)
                </div>
            @endif
        @empty
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2-2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                </svg>
                <h3 class="mt-2 text-lg font-medium text-gray-900">
                    @if(request()->hasAny(['search', 'kategori']))
                        Tidak ada produk yang sesuai
                    @else
                        Belum ada produk
                    @endif
                </h3>
                <p class="mt-1 text-gray-500">
                    @if(request()->hasAny(['search', 'kategori']))
                        Coba ubah kata kunci atau filter pencarian Anda
                    @else
                        Jadilah yang pertama untuk menambahkan produk!
                    @endif
                </p>
                @auth
                    <div class="mt-6">
                        <a href="{{ route('produk.create') }}" 
                           class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah Produk
                        </a>
                    </div>
                @endauth
            </div>
        @endforelse

        <!-- Pagination -->
        @if($produk->hasPages())
            <div class="mt-8">
                {{ $produk->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection