<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kelola Harga: ') }} <span class="text-blue-600">{{ $mediaIklan->nama_lokasi }}</span>
            </h2>
            <a href="{{ route('pemilik.media-iklan.index') }}" class="text-gray-600 hover:text-gray-900 border border-gray-300 px-3 py-1 rounded">
                &larr; Kembali ke Daftar Iklan
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col md:flex-row gap-6">
            
            <div class="w-full md:w-1/3">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="font-bold text-lg mb-4">Tambah Paket Baru</h3>
                    
                    <form action="{{ route('pemilik.paket-harga.store', $mediaIklan->id) }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Nama Paket</label>
                            <input type="text" name="nama_paket" class="w-full border-gray-300 rounded-md shadow-sm" placeholder="Misal: Paket Promo Bulanan" required>
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Durasi (dalam Hari)</label>
                            <input type="number" name="durasi_hari" class="w-full border-gray-300 rounded-md shadow-sm" placeholder="Misal: 30 untuk sebulan" required min="1">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Harga (Rp)</label>
                            <input type="number" name="harga" class="w-full border-gray-300 rounded-md shadow-sm" placeholder="Misal: 1500000" required min="0">
                            <p class="text-xs text-gray-500 mt-1">Tulis angka saja tanpa titik/koma.</p>
                        </div>

                        <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                            + Simpan Paket
                        </button>
                    </form>
                </div>
            </div>

            <div class="w-full md:w-2/3">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="font-bold text-lg mb-4">Daftar Paket Tersedia</h3>

                    @if(session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <table class="w-full text-left border-collapse mt-2">
                        <thead>
                            <tr class="border-b bg-gray-50">
                                <th class="py-2 px-4">Nama Paket</th>
                                <th class="py-2 px-4">Durasi</th>
                                <th class="py-2 px-4">Harga Sewa</th>
                                <th class="py-2 px-4 w-24">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($paketHargas as $paket)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-2 px-4">{{ $paket->nama_paket }}</td>
                                    <td class="py-2 px-4 font-bold">{{ $paket->durasi_hari }} Hari</td>
                                    <td class="py-2 px-4 text-green-600">Rp {{ number_format($paket->harga, 0, ',', '.') }}</td>
                                    <td class="py-2 px-4">
                                        <form action="{{ route('pemilik.paket-harga.destroy', $paket->id) }}" method="POST" onsubmit="return confirm('Hapus paket ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline text-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="py-4 text-center text-gray-500">Belum ada paket harga. Silakan buat di form sebelah kiri.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>