<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laporan Kas RT') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Stat Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-white overflow-hidden shadow rounded-lg border-l-4 border-blue-500">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-500 truncate">Total Kas</p>
                                <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($totalKas, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow rounded-lg border-l-4 border-green-500">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-500 truncate">Total Warga</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $totalWarga }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow rounded-lg border-l-4 border-yellow-500">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-500 truncate">Total Transaksi</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $totalIuran }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow rounded-lg border-l-4 border-purple-500">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-500 truncate">Transaksi Lunas</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $totalLunas }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Chart --}}
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Grafik Iuran {{ date('Y') }}</h3>
                    <div style="height: 300px; position: relative;">
                        <canvas id="iuranChart" 
                            data-bulan='@json($bulanData)' 
                            data-jumlah='@json($jumlahData)'>
                        </canvas>
                    </div>
                </div>
            </div>

            {{-- 5 Iuran Terbesar --}}
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">5 Iuran Terbesar</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Warga</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Bulan/Tahun</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($iuranTerbesar as $index => $iuran)
                                <tr>
                                    <td class="px-6 py-4">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4">{{ $iuran->warga->user->name ?? 'N/A' }}</td>
                                    <td class="px-6 py-4">{{ $iuran->bulan }} {{ $iuran->tahun }}</td>
                                    <td class="px-6 py-4">Rp {{ number_format($iuran->jumlah, 0, ',', '.') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada data iuran</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Laporan per Bulan --}}
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Rekap per Bulan</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Bulan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tahun</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total Transaksi</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total Nominal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($laporanBulan as $index => $laporan)
                                <tr>
                                    <td class="px-6 py-4">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4">{{ $laporan->bulan }}</td>
                                    <td class="px-6 py-4">{{ $laporan->tahun }}</td>
                                    <td class="px-6 py-4">{{ $laporan->total_transaksi }}x</td>
                                    <td class="px-6 py-4">Rp {{ number_format($laporan->total_nominal, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('laporan.per-bulan', ['bulan' => $laporan->bulan, 'tahun' => $laporan->tahun]) }}" 
                                           class="text-blue-600 hover:text-blue-900">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada data laporan</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $laporanBulan->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Scripts --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script src="{{ asset('js/laporan-chart.js') }}"></script>
</x-app-layout>