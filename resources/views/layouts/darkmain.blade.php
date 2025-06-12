<!DOCTYPE html>
<html lang="id" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'NigaStore')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        html, body {
            color-scheme: dark;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #232946 0%, #1a1a2e 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            color: #e5e7eb;
        }

        .main-content {
            flex: 1;
            background-color: #181824;
            margin-top: 0;
            padding-top: 2rem;
        }

        /* Navbar Styles */
        .navbar-custom, .bg-white {
            background: linear-gradient(135deg, #232946 0%, #1a1a2e 100%) !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .navbar-brand, .text-gray-900 {
            font-weight: 700;
            font-size: 1.5rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            color: #fff !important;
        }

        .navbar-nav .nav-link, .text-gray-600 {
            font-weight: 500;
            padding: 0.5rem 1rem;
            margin: 0 0.25rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            color: #bfc9d1 !important;
        }

        .navbar-nav .nav-link:hover, .hover\:text-blue-600:hover {
            background-color: rgba(255, 255, 255, 0.05);
            color: #38bdf8 !important;
            transform: translateY(-1px);
        }

        .text-blue-600 {
            color: #38bdf8 !important;
        }
        .border-blue-600 {
            border-color: #38bdf8 !important;
        }

        .btn-navbar {
            border-radius: 8px;
            padding: 0.5rem 1rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .btn-navbar-primary {
            background-color: #232946;
            color: #38bdf8;
            border-color: #38bdf8;
        }

        .btn-navbar-primary:hover {
            background-color: #1a1a2e;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(56, 189, 248, 0.15);
        }

        .btn-navbar-outline {
            background-color: transparent;
            color: #38bdf8;
            border-color: #38bdf8;
        }

        .btn-navbar-outline:hover {
            background-color: #38bdf8;
            color: #232946;
            transform: translateY(-1px);
        }

        /* Mobile Menu */
        .navbar-toggler {
            border: none;
            padding: 0.25rem 0.5rem;
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* Footer Styles */
        .footer-custom {
            background: linear-gradient(135deg, #181824 0%, #232946 100%);
            color: #e5e7eb;
            margin-top: auto;
            padding: 3rem 0 2rem 0;
            position: relative;
            overflow: hidden;
        }

        .footer-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.08), transparent);
        }

        .footer-content {
            position: relative;
            z-index: 1;
        }

        .footer-brand {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .footer-text {
            color: #bfc9d1;
            margin-bottom: 0;
            font-size: 0.9rem;
        }

        .footer-links {
            display: flex;
            gap: 2rem;
            margin-bottom: 1rem;
        }

        .footer-links a {
            color: #bfc9d1;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: #fff;
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background-color: rgba(56, 189, 248, 0.08);
            color: #38bdf8;
            border-radius: 50%;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            background-color: rgba(56, 189, 248, 0.2);
            color: #fff;
            transform: translateY(-2px);
        }

        /* Notification Styles */
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            max-width: 400px;
            z-index: 9999;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            animation: slideInRight 0.3s ease-out;
        }

        .notification.success {
            background: linear-gradient(135deg, #059669 0%, #065f46 100%);
            color: #e5e7eb;
        }

        .notification.error {
            background: linear-gradient(135deg, #b91c1c 0%, #7f1d1d 100%);
            color: #e5e7eb;
        }

        .notification.warning {
            background: linear-gradient(135deg, #b45309 0%, #78350f 100%);
            color: #e5e7eb;
        }

        .notification.info {
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
            color: #e5e7eb;
        }

        .notification-content {
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .notification-icon {
            flex-shrink: 0;
            width: 24px;
            height: 24px;
        }

        .notification-close {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            background: none;
            border: none;
            color: inherit;
            cursor: pointer;
            padding: 0.25rem;
            border-radius: 4px;
            opacity: 0.7;
            transition: opacity 0.2s ease;
        }

        .notification-close:hover {
            opacity: 1;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOutRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }

        .notification.hiding {
            animation: slideOutRight 0.3s ease-in forwards;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.25rem;
            }
            
            .navbar-nav {
                margin-top: 1rem;
                padding-top: 1rem;
                border-top: 1px solid rgba(255, 255, 255, 0.05);
            }
            
            .navbar-nav .nav-item {
                margin-bottom: 0.5rem;
            }
            
            .footer-links {
                flex-direction: column;
                gap: 0.5rem;
                text-align: center;
            }
            
            .social-links {
                justify-content: center;
            }
            
            .notification {
                top: 10px;
                right: 10px;
                left: 10px;
                max-width: none;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Navigation -->
    <!-- Modern Navbar -->  
    <nav class="navbar-custom shadow-lg border-b border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo & Brand -->
                <div class="flex items-center">
                    <a href="{{ Auth::check() ? '/home' : '/' }}" class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold text-gray-900">NigaStore</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    @auth
                        <a href="/produk/produk"
                        class="{{ request()->is('produk/produk') ? 'text-blue-600 font-semibold border-b-2 border-blue-600 pb-1' : 'text-gray-600 hover:text-blue-600 transition-colors duration-200' }}">
                        Semua Produk
                        </a>

                        <a href="/kategori"
                        class="{{ request()->is('kategori') ? 'text-blue-600 font-semibold border-b-2 border-blue-600 pb-1' : 'text-gray-600 hover:text-blue-600 transition-colors duration-200' }}">
                        Kategori
                        </a>

                        <a href="/produk/produkSaya"
                        class="{{ request()->is('produk/produkSaya') ? 'text-blue-600 font-semibold border-b-2 border-blue-600 pb-1' : 'text-gray-600 hover:text-blue-600 transition-colors duration-200' }}">
                        Produk Saya
                        </a>
                    @endauth
                </div>

                <!-- User Actions -->
                <div class="flex items-center space-x-4">
                    @auth
                        <!-- User Info -->
                        <div class="hidden md:flex items-center space-x-4">
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-900">{{ Auth::user()->username }}</p>
                                <p class="text-xs text-gray-500">Saldo: Rp{{ number_format(Auth::user()->saldo, 0, ',', '.') }}</p>
                            </div>
                            <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center">
                                <span class="text-white text-sm font-medium">{{ substr(Auth::user()->username, 0, 1) }}</span>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('topup.form') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200">
                                Top-Up
                            </a>
                            <a href="/produk/create" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200">
                                Jual Barang
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-gray-600 hover:text-red-600 p-2 rounded-lg transition-colors duration-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="flex items-center space-x-3">
                            <a href="/login" class="text-gray-600 hover:text-blue-600 font-medium transition-colors duration-200">Masuk</a>
                            <a href="/register" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">Daftar</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer-custom">
        <div class="container">
            <div class="footer-content">
                <div class="row">
                    <div class="col-lg-6 col-md-6 mb-4 mb-md-0">
                        <div class="footer-brand">
                            <i class="fas fa-store me-2"></i>
                            <span style="color: white;">Nig</span><span style="color: #24befb;">aSto</span><span style="color: white;">re</span>
                        </div>
                        <p class="footer-text">
                            Platform jual beli online terpercaya untuk semua kebutuhan Anda. 
                            Jual dan beli dengan mudah, aman, dan terpercaya.
                        </p>
                        <div class="social-links">
                            <a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
                            <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                            <a href="#" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="row">
                            <div class="col-sm-6">
                                <h6 class="text-white mb-3">Layanan</h6>
                                <div class="footer-links flex-column">
                                    <a href="#">Cara Jual</a>
                                    <a href="#">Cara Beli</a>
                                    <a href="#">Keamanan</a>
                                    <a href="#">Bantuan</a>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <h6 class="text-white mb-3">Perusahaan</h6>
                                <div class="footer-links flex-column">
                                    <a href="#">Tentang Kami</a>
                                    <a href="#">Karir</a>
                                    <a href="#">Kebijakan Privasi</a>
                                    <a href="#">Syarat & Ketentuan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-4" style="border-color: rgba(255, 255, 255, 0.08);">
                <div class="text-center">
                    <p class="footer-text">
                        &copy; {{ date('Y') }} Nigastore.
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Notification Container -->
    <div id="notification-container"></div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Notification Script -->
    <script>
        // Show notification function
        function showNotification(message, type = 'success', duration = 5000) {
            const container = document.getElementById('notification-container');
            const notification = document.createElement('div');
            notification.className = `notification ${type}`;
            
            const icons = {
                success: 'fas fa-check-circle',
                error: 'fas fa-exclamation-circle',
                warning: 'fas fa-exclamation-triangle',
                info: 'fas fa-info-circle'
            };
            
            notification.innerHTML = `
                <div class="notification-content">
                    <i class="${icons[type]} notification-icon"></i>
                    <span>${message}</span>
                </div>
                <button class="notification-close" onclick="closeNotification(this.parentElement)">
                    <i class="fas fa-times"></i>
                </button>
            `;
            
            container.appendChild(notification);
            
            // Auto remove after duration
            setTimeout(() => {
                closeNotification(notification);
            }, duration);
        }
        
        // Close notification function
        function closeNotification(notification) {
            notification.classList.add('hiding');
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
            }, 300);
        }
        
        // Check for Laravel session messages
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                showNotification('{{ session('success') }}', 'success');
            @endif
            
            @if(session('error'))
                showNotification('{{ session('error') }}', 'error');
            @endif
            
            @if(session('warning'))
                showNotification('{{ session('warning') }}', 'warning');
            @endif
            
            @if(session('info'))
                showNotification('{{ session('info') }}', 'info');
            @endif
        });
    </script>
    
    @stack('scripts')
</body>
</html>