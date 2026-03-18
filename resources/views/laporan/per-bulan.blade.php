<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Iuran Bulan :bulan :tahun', ['bulan' => $bulan, 'tahun' => $tahun]) }}
            </h2>
            <a href="{{ route('laporan.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Stat Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-white overflow-hidden shadow rounded-lg border-l-4 border-green-500">
                    <div class="p-5">
                        <p class="text-sm font-medium text-gray-500 truncate">Total Penerimaan</p>
                        <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($total, 0, ',', '.') }}</p>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow rounded-lg border-l-4 border-blue-500">
                    <div class="p-5">
                        <p class="text-sm font-medium text-gray-500 truncate">Lunas</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $lunas }} Warga</p>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow rounded-lg border-l-4 border-yellow-500">
                    <div class="p-5">
                        <p class="text-sm font-medium text-gray-500 truncate">Pending</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $pending }} Warga</p>
                    </div>
                </div>
            </div>

            {{-- Tabel Detail --}}
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Warga</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tgl Bayar</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($iurans as $index => $iuran)
                            <tr>
                                <td class="px-6 py-4">{{ $index + 1 }}</td>
                                <td class="px-6 py-4">{{ $iuran->warga->user->name }}</td>
                                <td class="px-6 py-4">Rp {{ number_format($iuran->jumlah, 0, ',', '.') }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if($iuran->status == 'lunas') bg-green-100 text-green-800
                                        @elseif($iuran->status == 'pending') bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ ucfirst($iuran->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">{{ $iuran->tanggal_bayar ? \Carbon\Carbon::parse($iuran->tanggal_bayar)->format('d/m/Y') : '-' }}</td>
                                <td class="px-6 py-4">{{ $iuran->keterangan ?? '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>