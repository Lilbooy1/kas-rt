<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Anggota') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Error Message --}}
            @if(isset($error))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ $error }}
                </div>
            @endif

            {{-- Success Message --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 animate-fade-in">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Error Message --}}
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 animate-fade-in">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Welcome Card -->
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white overflow-hidden shadow-xl sm:rounded-lg mb-6 transform hover:scale-[1.01] transition-all duration-300">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-2xl font-bold mb-2">Selamat Datang, {{ $user->name }}! 👋</h1>
                            <p class="text-blue-100">Anda login sebagai <span class="font-semibold">Anggota</span></p>
                            @if($warga)
                                <p class="mt-2 text-sm text-blue-200">
                                    No. Rumah: {{ $warga->no_rumah }} | NIK: {{ $warga->nik }}
                                </p>
                            @endif
                        </div>
                        <div class="hidden md:block">
                            <svg class="w-24 h-24 text-white opacity-20" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            @if($warga)
                <!-- Stat Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Total Iuran -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden transform hover:-translate-y-1 transition-all duration-300">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-blue-100 dark:bg-blue-900/30 rounded-lg p-3">
                                    <svg class="h-8 w-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Total Iuran</dt>
                                        <dd class="flex items-baseline">
                                            <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalIuran }}x</div>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class="bg-blue-50 dark:bg-blue-900/20 px-5 py-2">
                            <div class="text-sm text-blue-600 dark:text-blue-400">
                                Total pembayaran iuran
                            </div>
                        </div>
                    </div>

                    <!-- Total Pembayaran -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden transform hover:-translate-y-1 transition-all duration-300">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-green-100 dark:bg-green-900/30 rounded-lg p-3">
                                    <svg class="h-8 w-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Total Pembayaran</dt>
                                        <dd class="flex items-baseline">
                                            <div class="text-2xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($totalLunas, 0, ',', '.') }}</div>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class="bg-green-50 dark:bg-green-900/20 px-5 py-2">
                            <div class="text-sm text-green-600 dark:text-green-400">
                                Total yang sudah dibayar
                            </div>
                        </div>
                    </div>

                    <!-- Menunggu Konfirmasi -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden transform hover:-translate-y-1 transition-all duration-300">
                        <div class="p-5">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 bg-yellow-100 dark:bg-yellow-900/30 rounded-lg p-3">
                                    <svg class="h-8 w-8 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-5 w-0 flex-1">
                                    <dl>
                                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">Menunggu Konfirmasi</dt>
                                        <dd class="flex items-baseline">
                                            <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $iuranPending }}</div>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                        <div class="bg-yellow-50 dark:bg-yellow-900/20 px-5 py-2">
                            <div class="text-sm text-yellow-600 dark:text-yellow-400">
                                Pembayaran pending
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Status Iuran Bulan Ini -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg mb-8">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Status Iuran Bulan {{ $bulanIni }} {{ $tahunIni }}</h3>
                        
                        @if($iuranBulanIni)
                            {{-- Sudah ada iuran --}}
                            <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700 rounded-lg mb-4">
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Status:</p>
                                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full 
                                        @if($iuranBulanIni->status == 'lunas') bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400
                                        @elseif($iuranBulanIni->status == 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400
                                        @else bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400 @endif">
                                        {{ ucfirst($iuranBulanIni->status) }}
                                    </span>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Jumlah:</p>
                                    <p class="text-xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($iuranBulanIni->jumlah, 0, ',', '.') }}</p>
                                </div>
                                @if($iuranBulanIni->tanggal_bayar)
                                <div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Tanggal Bayar:</p>
                                    <p class="text-gray-900 dark:text-white">{{ $iuranBulanIni->tanggal_bayar->format('d/m/Y') }}</p>
                                </div>
                                @endif
                            </div>
                            
                            {{-- Pesan status --}}
                            <div class="text-sm p-3 rounded-lg
                                @if($iuranBulanIni->status == 'lunas') bg-green-50 text-green-700 dark:bg-green-900/30 dark:text-green-400
                                @elseif($iuranBulanIni->status == 'pending') bg-yellow-50 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400
                                @else bg-red-50 text-red-700 dark:bg-red-900/30 dark:text-red-400 @endif">
                                {{ $pesanBulanIni }}
                            </div>
                            
                        @else
                            {{-- Belum bayar --}}
                            <div class="text-center py-8">
                                <div class="mb-4">
                                    <svg class="w-16 h-16 mx-auto text-gray-400 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <p class="text-gray-500 dark:text-gray-400 mb-4">{{ $pesanBulanIni }}</p>
                                <button onclick="openBayarModal()" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition duration-200">
                                    Bayar Iuran Sekarang
                                </button>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Riwayat Iuran -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Riwayat Iuran Saya</h3>
                        
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">No</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Bulan</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tahun</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Jumlah</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tanggal Bayar</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @forelse($riwayatIuran as $index => $iuran)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{ $index + 1 }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{ $iuran->bulan }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{ $iuran->tahun }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">Rp {{ number_format($iuran->jumlah, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if($iuran->status == 'lunas') bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400
                                                @elseif($iuran->status == 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400
                                                @else bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400 @endif">
                                                {{ ucfirst($iuran->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ $iuran->tanggal_bayar ? $iuran->tanggal_bayar->format('d/m/Y') : '-' }}
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center justify-center">
                                                <svg class="w-16 h-16 text-gray-300 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                                </svg>
                                                <p class="text-gray-500 dark:text-gray-400 text-lg">Belum ada riwayat iuran</p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal Bayar Iuran -->
    <div id="bayarModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden" style="z-index: 1000;">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-gray-800">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">Form Pembayaran Iuran</h3>
                    <button onclick="closeBayarModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <form action="{{ route('anggota.bayar-iuran') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-medium mb-2">Bulan</label>
                        <select name="bulan" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white" required>
                            <option value="{{ date('F') }}">{{ date('F') }}</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-medium mb-2">Tahun</label>
                        <select name="tahun" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white" required>
                            <option value="{{ date('Y') }}">{{ date('Y') }}</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-medium mb-2">Jumlah (Rp)</label>
                        <input type="number" name="jumlah" value="50000" min="10000" step="1000" 
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white" required>
                    </div>

                    <div class="flex items-center justify-end space-x-3 mt-6">
                        <button type="button" onclick="closeBayarModal()" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition duration-200">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition duration-200">
                            Kirim Permintaan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openBayarModal() {
            document.getElementById('bayarModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        
        function closeBayarModal() {
            document.getElementById('bayarModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('bayarModal');
            if (event.target == modal) {
                closeBayarModal();
            }
        }
    </script>
</x-app-layout>