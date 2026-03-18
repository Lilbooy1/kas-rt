<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>KasRT - Daftar</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-gray-900 dark:to-gray-800">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-sm">
            <!-- Logo -->
            <div class="text-center mb-6">
                <span class="text-3xl font-bold text-gray-800 dark:text-white">Kas<span class="text-blue-600">RT</span></span>
            </div>

            <!-- Welcome Text -->
            <div class="text-center mb-6">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Buat Akun Baru</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Daftar untuk mulai menggunakan KasRT</p>
            </div>

            <!-- Register Card -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 border border-gray-100 dark:border-gray-700">
                <form method="POST" action="{{ route('register') }}" class="space-y-3">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}" required autofocus
                            class="w-full px-3 py-2 text-sm border border-gray-200 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white @error('name') border-red-500 @enderror"
                            placeholder="John Doe">
                        @error('name')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full px-3 py-2 text-sm border border-gray-200 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white @error('email') border-red-500 @enderror"
                            placeholder="nama@email.com">
                        @error('email')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Kata Sandi</label>
                        <input type="password" name="password" required
                            class="w-full px-3 py-2 text-sm border border-gray-200 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white @error('password') border-red-500 @enderror"
                            placeholder="Minimal 8 karakter">
                        @error('password')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Konfirmasi Kata Sandi</label>
                        <input type="password" name="password_confirmation" required
                            class="w-full px-3 py-2 text-sm border border-gray-200 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white"
                            placeholder="Ulangi kata sandi">
                    </div>

                    <!-- Register Button -->
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-2 px-4 rounded-lg transition duration-200 mt-4">
                        Daftar
                    </button>

                    <!-- Login Link -->
                    <p class="text-center text-xs text-gray-500 dark:text-gray-400">
                        Sudah punya akun? 
                        <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700 dark:text-blue-400 font-medium">Masuk</a>
                    </p>
                </form>
            </div>

            <!-- Back to Home -->
            <div class="text-center mt-6">
                <a href="/" class="inline-flex items-center text-xs text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</body>
</html>