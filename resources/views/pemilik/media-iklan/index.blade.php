<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Media Iklan Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if(session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="mb-4">
                        <a href="{{ route('pemilik.media-iklan.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                            + Tambah Media Iklan
                        </a>
                    </div>

                    <table class="w-full text-left border-collapse mt-4">
                        <thead>
                            <tr class="border-b">
                                <th class="py-2 px-4">Nama Lokasi</th>
                                <th class="py-2 px-4">Jenis</th>
                                <th class="py-2 px-4">Kapasitas Slot</th>
                                <th class="py-2 px-4">Status</th>
                                <th class="py-2 px-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($mediaIklans as $iklan)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-2 px-4">{{ $iklan->nama_lokasi }}</td>
                                    <td class="py-2 px-4 uppercase">{{ $iklan->jenis }}</td>
                                    <td class="py-2 px-4">{{ $iklan->kapasitas_slot }}</td>
                                    <td class="py-2 px-4">
                                        <span class="px-2 py-1 rounded text-sm {{ $iklan->status_ketersediaan == 'tersedia' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ ucfirst($iklan->status_ketersediaan) }}
                                        </span>
                                    </td>
                                    <td class="py-2 px-4">
                                        <a href="{{ route('pemilik.gambar-media.index', $iklan->id) }}" class="text-purple-600 font-bold hover:underline mr-3">📸 Foto</a>
                                        <a href="{{ route('pemilik.paket-harga.index', $iklan->id) }}" class="text-green-600 font-bold hover:underline mr-3">💰 Harga</a>
                                        <a href="{{ route('pemilik.media-iklan.edit', $iklan->id) }}" class="text-blue-500 hover:underline">Edit</a>
                                        
                                        <form action="{{ route('pemilik.media-iklan.destroy', $iklan->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus media iklan ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline ml-2">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-4 text-center text-gray-500">Belum ada data media iklan. Silakan tambah baru.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>