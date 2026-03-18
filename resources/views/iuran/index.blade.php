<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manajemen Iuran') }}
            </h2>
            @if(Auth::user()->role == 'admin')
            <a href="{{ route('iuran.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                + Tambah Iuran
            </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Warga</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Bulan/Tahun</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tgl Bayar</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($iurans as $index => $iuran)
                                <tr>
                                    <td class="px-6 py-4">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4">{{ $iuran->warga->user->name ?? 'N/A' }}</td>
                                    <td class="px-6 py-4">{{ $iuran->bulan }} {{ $iuran->tahun }}</td>
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
                                    <td class="px-6 py-4">
                                        @if(Auth::user()->role == 'admin')
                                        <a href="{{ route('iuran.edit', $iuran->id) }}" class="text-blue-600 hover:text-blue-900 mr-2">Edit</a>
                                        <form action="{{ route('iuran.destroy', $iuran->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">Belum ada data iuran</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        {{ $iurans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>