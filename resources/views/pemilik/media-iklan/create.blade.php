<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Media Iklan Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form action="{{ route('pemilik.media-iklan.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Nama Lokasi (Judul)</label>
                            <input type="text" name="nama_lokasi" class="w-full border-gray-300 rounded-md shadow-sm" required placeholder="Misal: Baliho Simpang Lima">
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-gray-700 font-bold mb-2">Jenis Media</label>
                                <select name="jenis" class="w-full border-gray-300 rounded-md shadow-sm" required>
                                    <option value="reklame">Reklame / Baliho</option>
                                    <option value="videotron">Videotron</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-gray-700 font-bold mb-2">Kapasitas Slot</label>
                                <input type="number" name="kapasitas_slot" class="w-full border-gray-300 rounded-md shadow-sm" required min="1" value="1">
                                <p class="text-xs text-gray-500 mt-1">Isi 1 untuk reklame. Bisa lebih dari 1 untuk videotron.</p>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Alamat Lokasi</label>
                            <textarea name="alamat_lokasi" rows="3" class="w-full border-gray-300 rounded-md shadow-sm" required placeholder="Alamat lengkap jalan..."></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Keterangan / Spesifikasi</label>
                            <textarea name="keterangan" rows="4" class="w-full border-gray-300 rounded-md shadow-sm" placeholder="Ukuran, aturan penerangan, dll..."></textarea>
                        </div>

                        <div class="flex justify-end mt-6">
                            <a href="{{ route('pemilik.media-iklan.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md mr-2 hover:bg-gray-600">Batal</a>
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Simpan Data</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>