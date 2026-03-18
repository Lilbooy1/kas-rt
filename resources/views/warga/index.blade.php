<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manajemen Warga') }}
            </h2>
            <a href="{{ route('warga.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                + Tambah Warga
            </a>
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
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">NIK</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No Rumah</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Alamat</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No HP</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($wargas as $index => $warga)
                                <tr>
                                    <td class="px-6 py-4">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4">{{ $warga->user->name }}</td>
                                    <td class="px-6 py-4">{{ $warga->nik }}</td>
                                    <td class="px-6 py-4">{{ $warga->no_rumah }}</td>
                                    <td class="px-6 py-4">{{ $warga->alamat }}</td>
                                    <td class="px-6 py-4">{{ $warga->no_hp }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $warga->status == 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ ucfirst($warga->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('warga.edit', $warga->id) }}" class="text-blue-600 hover:text-blue-900 mr-2">Edit</a>
                                        <form action="{{ route('warga.destroy', $warga->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-4 text-center text-gray-500">Belum ada data warga</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        {{ $wargas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>