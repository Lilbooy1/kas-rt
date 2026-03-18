<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard Iuran RT
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Card -->
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl shadow-lg p-6 mb-6 text-white">
                <div class="flex items-start justify-between">
                    <div>
                        <h1 class="text-2xl font-bold mb-1">Selamat Datang, Admin RT! 😊</h1>
                        <p class="text-blue-100">Anda login sebagai Administrator</p>
                    </div>
                    <div class="bg-white/20 rounded-lg px-4 py-2 text-sm">
                        {{ date('l, d F Y') }}
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Total Warga -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                    <div class="flex items-start justify-between mb-2">
                        <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                        <span class="text-xs text-green-600 bg-green-100 dark:bg-green-900/30 px-2 py-1 rounded-full">+2 minggu ini</span>
                    </div>
                    <h3 class="text-sm text-gray-500 dark:text-gray-400 mb-1">Total Warga</h3>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">3 <span class="text-sm font-normal text-gray-500">(Aktif: 3)</span></p>
                </div>

                <!-- Iuran Bulan Ini -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                    <div class="flex items-start justify-between mb-2">
                        <div class="w-10 h-10 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <span class="text-xs text-green-600 bg-green-100 dark:bg-green-900/30 px-2 py-1 rounded-full">+15%</span>
                    </div>
                    <h3 class="text-sm text-gray-500 dark:text-gray-400 mb-1">Iuran Bulan Ini</h3>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">Rp 200.000</p>
                    <p class="text-xs text-gray-500 mt-1">{{ date('F Y') }}</p>
                </div>

                <!-- Transaksi Baru -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                    <div class="flex items-start justify-between mb-2">
                        <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <span class="text-xs text-purple-600 bg-purple-100 dark:bg-purple-900/30 px-2 py-1 rounded-full">Update</span>
                    </div>
                    <h3 class="text-sm text-gray-500 dark:text-gray-400 mb-1">Transaksi Baru</h3>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">3 <span class="text-sm font-normal text-gray-500">Hari ini</span></p>
                </div>
            </div>

            <!-- Activity & Target Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Aktivitas Iuran Card -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-4">Aktivitas Iuran</h3>
                    
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Pembayaran Masuk</p>
                                <p class="text-xs text-gray-500">Bulan {{ date('F Y') }}</p>
                            </div>
                            <span class="text-lg font-bold text-green-600">+Rp 200.000</span>
                        </div>
                        
                        <div class="relative pt-1">
                            <div class="flex mb-2 items-center justify-between">
                                <div>
                                    <span class="text-xs font-semibold inline-block text-green-600">Progress</span>
                                </div>
                                <div class="text-right">
                                    <span class="text-xs font-semibold inline-block text-green-600">75%</span>
                                </div>
                            </div>
                            <div class="overflow-hidden h-2 text-xs flex rounded bg-green-100 dark:bg-green-900/30">
                                <div style="width:75%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-green-500"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Mini Stats -->
                    <div class="grid grid-cols-2 gap-4 mt-6">
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-3">
                            <p class="text-xs text-gray-500">Total Pemasukan</p>
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">Rp 200.000</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-3">
                            <p class="text-xs text-gray-500">Target Bulanan</p>
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">Rp 300.000</p>
                        </div>
                    </div>
                </div>

                <!-- Target Bulanan Card -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-4">Target Bulanan</h3>
                    
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">Rp 200.000</p>
                            <p class="text-xs text-gray-500">Terkumpul dari Rp 300.000</p>
                        </div>
                        <div class="w-16 h-16">
                            <svg class="w-full h-full" viewBox="0 0 36 36">
                                <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="#E5E7EB" stroke-width="3" stroke-dasharray="75, 100"/>
                                <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="#10B981" stroke-width="3" stroke-dasharray="75, 100"/>
                            </svg>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600 dark:text-gray-400">Sisa Target</span>
                            <span class="font-medium text-gray-900 dark:text-white">Rp 100.000</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600 dark:text-gray-400">Hari Tersisa</span>
                            <span class="font-medium text-gray-900 dark:text-white">12 hari</span>
                        </div>
                    </div>

                    <button class="w-full mt-6 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 py-2 px-4 rounded-lg text-sm font-medium hover:bg-blue-100 dark:hover:bg-blue-900/50 transition-colors">
                        Lihat Detail
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>