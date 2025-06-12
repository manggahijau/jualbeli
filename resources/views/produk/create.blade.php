@extends('layouts.main')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Tambah Produk Baru</h1>
            <p class="text-lg text-gray-600">Lengkapi informasi produk dengan detail yang akurat</p>
        </div>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded-lg mb-6 shadow-sm">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">Terdapat beberapa kesalahan:</h3>
                        <ul class="mt-2 text-sm text-red-700 list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <!-- Main Form -->
        <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl shadow-xl overflow-hidden">
            @csrf
            
            <div class="p-8">
                <!-- Basic Information Section -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Informasi Dasar Produk
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Produk -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama Produk <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="nama_produk" 
                                   class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 placeholder-gray-400" 
                                   value="{{ old('nama_produk') }}" 
                                   placeholder="Masukkan nama produk yang menarik"
                                   required>
                        </div>

                        <!-- Harga -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Harga <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 text-sm font-medium">Rp</span>
                                </div>
                                <input type="number" 
                                       name="harga" 
                                       step="0.01" 
                                       class="w-full border-2 border-gray-200 rounded-lg pl-12 pr-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200" 
                                       value="{{ old('harga') }}" 
                                       placeholder="0"
                                       required>
                            </div>
                        </div>

                        <!-- Stok -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Stok <span class="text-red-500">*</span>
                            </label>
                            <input type="number" 
                                   name="stok" 
                                   class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200" 
                                   value="{{ old('stok') }}" 
                                   placeholder="Jumlah stok tersedia"
                                   required>
                        </div>

                        <!-- Kategori -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Kategori <span class="text-red-500">*</span>
                            </label>
                            <select name="kategori"
                                    class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 placeholder-gray-400"
                                    required>
                                <option value="">Pilih kategori</option>
                                <option value="elektronik" {{ old('kategori') == 'elektronik' ? 'selected' : '' }}>Elektronik</option>
                                <option value="fashion" {{ old('kategori') == 'fashion' ? 'selected' : '' }}>Fashion</option>
                                <option value="buku" {{ old('kategori') == 'buku' ? 'selected' : '' }}>Buku</option>
                                <option value="alat" {{ old('kategori') == 'alat' ? 'selected' : '' }}>Alat</option>
                                <option value="olahraga" {{ old('kategori') == 'olahraga' ? 'selected' : '' }}>Olahraga</option>
                                <option value="lainnya" {{ old('kategori') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>

                        <!-- Ketersediaan -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Ketersediaan <span class="text-red-500">*</span>
                            </label>
                            <div class="flex items-center gap-6">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="status" value="Tersedia"
                                        {{ old('status') == 'Tersedia' ? 'checked' : '' }}
                                        class="text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 text-gray-700">Tersedia</span>
                                </label>

                                <label class="inline-flex items-center">
                                    <input type="radio" name="status" value="Tidak Tersedia"
                                        {{ old('status') == 'Tidak Tersedia' ? 'checked' : '' }}
                                        class="text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 text-gray-700">Tidak Tersedia</span>
                                </label>
                            </div>
                        </div>

                        <!-- Deskripsi -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Produk</label>
                            <textarea name="deskripsi" 
                                        rows="4" 
                                        class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 resize-none" 
                                        placeholder="Jelaskan detail produk, spesifikasi, dan keunggulan...">{{ old('deskripsi') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Image Upload Section -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Gambar Produk
                    </h2>
                    
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition-colors duration-200">
                        <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="text-sm text-gray-600">
                            <label for="gambar" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                <span>Upload gambar produk</span>
                                <input id="gambar" name="gambar" type="file" accept="image/*" class="sr-only">
                            </label>
                            <p class="pl-1">atau drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">PNG, JPG, GIF up to 10MB</p>
                        <!-- Image preview will be shown here -->
                        <div id="imagePreview" class="mt-4"></div>
                    </div>
                </div>

                <!-- Wholesale Discount Section -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                        Pengaturan Diskon Grosir
                    </h2>
                    
                    <div class="bg-gray-50 rounded-lg p-6">
                        <label class="flex items-center mb-4">
                            <input type="checkbox" 
                                   id="toggleGrosir" 
                                   name="is_grosir" 
                                   class="h-5 w-5 text-blue-600 border-2 border-gray-300 rounded focus:ring-blue-500 focus:ring-2" 
                                   {{ old('is_grosir') ? 'checked' : '' }}>
                            <span class="ml-3 text-sm font-medium text-gray-700">
                                Aktifkan diskon grosir untuk produk ini
                            </span>
                        </label>

                        <div id="grosirFields" class="{{ old('is_grosir') ? '' : 'hidden' }}">
                            <div class="bg-white rounded-lg p-4 border border-gray-200">
                                <p class="text-sm text-gray-600 mb-4">Atur diskon berdasarkan jumlah pembelian minimum</p>
                                
                                <div id="grosirContainer" class="space-y-3">
                                    <div class="flex gap-3 items-center">
                                        <div class="flex-1">
                                            <input type="number" 
                                                   name="diskon_grosir[minimal_jumlah][]" 
                                                   placeholder="Minimal Jumlah" 
                                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                                        </div>
                                        <div class="flex-1">
                                            <div class="relative">
                                                <input type="number" 
                                                       name="diskon_grosir[persentase_diskon][]" 
                                                       placeholder="Diskon" 
                                                       class="w-full border border-gray-300 rounded-lg pl-3 pr-8 py-2 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                    <span class="text-gray-500 text-sm">%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <button type="button" 
                                        id="addDiskon" 
                                        class="mt-3 inline-flex items-center text-sm text-blue-600 hover:text-blue-700 font-medium">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Tambah Tingkat Diskon
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="bg-gray-50 px-8 py-6 flex flex-col sm:flex-row gap-4 sm:gap-0 sm:justify-between">
                <a href="{{ url()->previous() }}" 
                   class="inline-flex justify-center items-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
                
                <button type="submit" 
                        class="inline-flex justify-center items-center px-8 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Simpan Produk
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Toggle grosir fields
    document.getElementById('toggleGrosir').addEventListener('change', function () {
        const grosirFields = document.getElementById('grosirFields');
        if (this.checked) {
            grosirFields.classList.remove('hidden');
            grosirFields.classList.add('animate-fadeIn');
        } else {
            grosirFields.classList.add('hidden');
            grosirFields.classList.remove('animate-fadeIn');
        }
    });

    // Add discount tier
    document.getElementById('addDiskon').addEventListener('click', function () {
        const container = document.getElementById('grosirContainer');
        const div = document.createElement('div');
        div.classList.add('flex', 'gap-3', 'items-center', 'animate-fadeIn');
        div.innerHTML = `
            <div class="flex-1">
                <input type="number" 
                       name="diskon_grosir[minimal_jumlah][]" 
                       placeholder="Minimal Jumlah" 
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
            </div>
            <div class="flex-1">
                <div class="relative">
                    <input type="number" 
                           name="diskon_grosir[persentase_diskon][]" 
                           placeholder="Diskon" 
                           class="w-full border border-gray-300 rounded-lg pl-3 pr-8 py-2 text-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <span class="text-gray-500 text-sm">%</span>
                    </div>
                </div>
            </div>
            <button type="button" onclick="this.parentElement.remove()" 
                    class="text-red-500 hover:text-red-700 p-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
            </button>
        `;
        container.appendChild(div);
    });

    // File upload preview
    document.getElementById('gambar').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(ev) {
                // Create or update preview
                let preview = document.getElementById('imagePreview');
                if (!preview) {
                    preview = document.createElement('div');
                    preview.id = 'imagePreview';
                    preview.className = 'mt-4';
                    e.target.closest('.border-dashed').appendChild(preview);
                }
                
                preview.innerHTML = `
                    <div class="relative inline-block">
                        <img src="${ev.target.result}" class="h-32 w-32 object-cover rounded-lg shadow-md">
                        <button type="button" onclick="clearImagePreview()" 
                                class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600">
                            ×
                        </button>
                    </div>
                `;
            };
            reader.readAsDataURL(file);
        } else {
            document.getElementById('imagePreview').innerHTML = '';
        }
    });

    function clearImagePreview() {
        document.getElementById('gambar').value = '';
        document.getElementById('imagePreview').remove();
    }

    // Form validation enhancement
    document.querySelector('form').addEventListener('submit', function(e) {
        const requiredFields = this.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('border-red-500', 'ring-red-500');
                isValid = false;
            } else {
                field.classList.remove('border-red-500', 'ring-red-500');
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            alert('Mohon lengkapi semua field yang wajib diisi');
        }
    });
</script>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .animate-fadeIn {
        animation: fadeIn 0.3s ease-out;
    }
    
    /* Custom scrollbar for textarea */
    textarea::-webkit-scrollbar {
        width: 6px;
    }
    
    textarea::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
    }
    
    textarea::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 3px;
    }
    
    textarea::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
    }
</style>
@endsection