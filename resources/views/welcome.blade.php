<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Aplikasi Kas RT Modern</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|poppins:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .gradient-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900">
    <!-- Navbar -->
    <nav class="fixed w-full z-50 glass-effect dark:bg-gray-900/25">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                        {{ config('app.name', 'KasRT') }}
                    </a>
                </div>
                
                <div class="flex items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" 
                               class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-lg transition-all duration-200 transform hover:scale-105">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" 
                               class="px-4 py-2 text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">
                                Log in
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" 
                                   class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-lg transition-all duration-200 transform hover:scale-105">
                                    Register
                                </a>
                            @endif
                        @endauth
                    @endif
                    
                    <!-- Dark Mode Toggle -->
                    <button id="darkModeToggle" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                        <svg class="w-5 h-5 dark:hidden" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/>
                        </svg>
                        <svg class="w-5 h-5 hidden dark:block" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-white to-purple-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
            <div class="absolute inset-0 opacity-30">
                <svg class="absolute left-0 top-0" width="100%" height="100%" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <defs>
                        <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                            <path d="M 10 0 L 0 0 0 10" fill="none" stroke="currentColor" stroke-width="0.5" class="text-gray-300 dark:text-gray-600"/>
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#grid)" />
                </svg>
            </div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32">
            <div class="text-center animate-fade-in">
                <h1 class="text-5xl md:text-7xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-6">
                    Aplikasi Kas RT
                </h1>
                <p class="text-xl md:text-2xl text-gray-600 dark:text-gray-300 mb-12 max-w-3xl mx-auto">
                    Kelola iuran warga dengan mudah, cepat, dan transparan. 
                    Dilengkapi fitur modern untuk kemudahan administrasi RT.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center animate-slide-up">
                    @guest
                        <a href="{{ route('register') }}" 
                           class="px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl font-semibold hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                            Mulai Sekarang
                        </a>
                        <a href="#features" 
                           class="px-8 py-4 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-xl font-semibold hover:shadow-lg transform hover:scale-105 transition-all duration-200 border border-gray-200 dark:border-gray-700">
                            Pelajari Fitur
                        </a>
                    @else
                        <a href="{{ url('/dashboard') }}" 
                           class="px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl font-semibold hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                            Buka Dashboard
                        </a>
                    @endguest
                </div>
            </div>

            <!-- Stats Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-20 animate-slide-up">
                <div class="glass-effect dark:bg-gray-800/25 rounded-2xl p-6 text-center">
                    <div class="text-4xl font-bold text-primary-600 dark:text-primary-400">100%</div>
                    <div class="text-gray-600 dark:text-gray-400 mt-2">Transparan</div>
                </div>
                <div class="glass-effect dark:bg-gray-800/25 rounded-2xl p-6 text-center">
                    <div class="text-4xl font-bold text-primary-600 dark:text-primary-400">Real-time</div>
                    <div class="text-gray-600 dark:text-gray-400 mt-2">Update Data</div>
                </div>
                <div class="glass-effect dark:bg-gray-800/25 rounded-2xl p-6 text-center">
                    <div class="text-4xl font-bold text-primary-600 dark:text-primary-400">24/7</div>
                    <div class="text-gray-600 dark:text-gray-400 mt-2">Akses Online</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Fitur Lengkap</h2>
                <p class="text-xl text-gray-600 dark:text-gray-300">Semua yang Anda butuhkan untuk mengelola iuran warga</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Fitur 1 -->
                <div class="group relative bg-gray-50 dark:bg-gray-700 rounded-2xl p-6 hover:shadow-xl transition-all duration-200 transform hover:-translate-y-1">
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Manajemen Warga</h3>
                    <p class="text-gray-600 dark:text-gray-300">Kelola data warga dengan mudah</p>
                </div>

                <!-- Fitur 2 -->
                <div class="group relative bg-gray-50 dark:bg-gray-700 rounded-2xl p-6 hover:shadow-xl transition-all duration-200 transform hover:-translate-y-1">
                    <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-green-600 dark:text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Iuran Bulanan</h3>
                    <p class="text-gray-600 dark:text-gray-300">Catat pembayaran iuran warga</p>
                </div>

                <!-- Fitur 3 -->
                <div class="group relative bg-gray-50 dark:bg-gray-700 rounded-2xl p-6 hover:shadow-xl transition-all duration-200 transform hover:-translate-y-1">
                    <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-purple-600 dark:text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Laporan Kas</h3>
                    <p class="text-gray-600 dark:text-gray-300">Lihat laporan keuangan real-time</p>
                </div>

                <!-- Fitur 4 -->
                <div class="group relative bg-gray-50 dark:bg-gray-700 rounded-2xl p-6 hover:shadow-xl transition-all duration-200 transform hover:-translate-y-1">
                    <div class="w-12 h-12 bg-yellow-100 dark:bg-yellow-900 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Notifikasi</h3>
                    <p class="text-gray-600 dark:text-gray-300">Pengingat jatuh tempo iuran</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="gradient-bg py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl font-bold text-white mb-6">Siap Mengelola Iuran dengan Mudah?</h2>
            <p class="text-xl text-white/90 mb-10 max-w-2xl mx-auto">
                Bergabunglah dengan ribuan RT lainnya yang sudah menggunakan aplikasi kami.
            </p>
            @guest
                <a href="{{ route('register') }}" 
                   class="inline-block px-8 py-4 bg-white text-blue-600 rounded-xl font-semibold hover:shadow-xl transform hover:scale-105 transition-all duration-200">
                    Daftar Sekarang
                </a>
            @else
                <a href="{{ url('/dashboard') }}" 
                   class="inline-block px-8 py-4 bg-white text-blue-600 rounded-xl font-semibold hover:shadow-xl transform hover:scale-105 transition-all duration-200">
                    Buka Dashboard
                </a>
            @endguest
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 dark:bg-gray-950 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <div class="text-2xl font-bold bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent mb-4">
                    {{ config('app.name', 'KasRT') }}
                </div>
                <p class="text-gray-400 mb-4">
                    Aplikasi Kas RT Modern | Kelola iuran warga dengan mudah dan transparan
                </p>
                <p class="text-gray-500 text-sm">
                    &copy; {{ date('Y') }} {{ config('app.name', 'KasRT') }}. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <script>
        // Dark Mode Toggle
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }

        document.getElementById('darkModeToggle')?.addEventListener('click', function() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.theme = 'light';
            } else {
                document.documentElement.classList.add('dark');
                localStorage.theme = 'dark';
            }
        });

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>