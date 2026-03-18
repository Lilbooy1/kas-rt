<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>KasRT - Login</title>

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
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Selamat Datang Kembali</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Silakan masuk ke akun Anda</p>
            </div>

            <!-- Login Card -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 border border-gray-100 dark:border-gray-700">
                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full px-3 py-2 text-sm border border-gray-200 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white @error('email') border-red-500 @enderror"
                            placeholder="admin@rt.com">
                        @error('email')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Kata Sandi</label>
                        <input type="password" name="password" required
                            class="w-full px-3 py-2 text-sm border border-gray-200 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white @error('password') border-red-500 @enderror"
                            placeholder="••••••••">
                        @error('password')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember & Forgot -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600">
                            <span class="ml-2 text-xs text-gray-600 dark:text-gray-400">Ingat saya</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-xs text-blue-600 hover:text-blue-700 dark:text-blue-400">Lupa password?</a>
                        @endif
                    </div>

                    <!-- Login Button -->
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-2 px-4 rounded-lg transition duration-200">
                        Masuk
                    </button>

                    <!-- Register Link -->
                    @if (Route::has('register'))
                        <p class="text-center text-xs text-gray-500 dark:text-gray-400">
                            Belum punya akun? 
                            <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-700 dark:text-blue-400 font-medium">Daftar</a>
                        </p>
                    @endif
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