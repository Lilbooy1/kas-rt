<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Iuran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('iuran.update', $iuran->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Warga</label>
                            <select name="warga_id" class="shadow border rounded w-full py-2 px-3 text-gray-700" required>
                                <option value="">Pilih Warga</option>
                                @foreach($wargas as $warga)
                                <option value="{{ $warga->id }}" {{ $iuran->warga_id == $warga->id ? 'selected' : '' }}>
                                    {{ $warga->user->name }} - {{ $warga->no_rumah }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Bulan</label>
                                <select name="bulan" class="shadow border rounded w-full py-2 px-3 text-gray-700" required>
                                    <option value="">Pilih Bulan</option>
                                    @foreach($bulan as $b)
                                    <option value="{{ $b }}" {{ $iuran->bulan == $b ? 'selected' : '' }}>{{ $b }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Tahun</label>
                                <select name="tahun" class="shadow border rounded w-full py-2 px-3 text-gray-700" required>
                                    <option value="">Pilih Tahun</option>
                                    @foreach($tahun as $t)
                                    <option value="{{ $t }}" {{ $iuran->tahun == $t ? 'selected' : '' }}>{{ $t }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Jumlah (Rp)</label>
                            <input type="number" name="jumlah" value="{{ $iuran->jumlah }}" 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight" required>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Status</label>
                                <select name="status" class="shadow border rounded w-full py-2 px-3 text-gray-700">
                                    <option value="pending" {{ $iuran->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="lunas" {{ $iuran->status == 'lunas' ? 'selected' : '' }}>Lunas</option>
                                    <option value="batal" {{ $iuran->status == 'batal' ? 'selected' : '' }}>Batal</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Tanggal Bayar</label>
                                <input type="date" name="tanggal_bayar" value="{{ $iuran->tanggal_bayar ? $iuran->tanggal_bayar->format('Y-m-d') : '' }}" 
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Keterangan</label>
                            <textarea name="keterangan" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight">{{ $iuran->keterangan }}</textarea>
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update
                            </button>
                            <a href="{{ route('iuran.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>