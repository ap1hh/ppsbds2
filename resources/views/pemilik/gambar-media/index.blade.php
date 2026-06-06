<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Galeri Foto: ') }} <span class="text-blue-600">{{ $mediaIklan->nama_lokasi }}</span>
            </h2>
            <a href="{{ route('pemilik.media-iklan.index') }}" class="text-gray-600 hover:text-gray-900 border border-gray-300 px-3 py-1 rounded">
                &larr; Kembali ke Daftar Iklan
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="flex flex-col md:flex-row gap-6">
                <div class="w-full md:w-1/3">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="font-bold text-lg mb-4">Unggah Foto Baru</h3>
                        
                        <form action="{{ route('pemilik.gambar-media.store', $mediaIklan->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Pilih Foto (Max: 2MB, JPG/PNG)</label>
                                <input type="file" name="foto" class="w-full border border-gray-300 rounded-md p-1" required accept="image/jpeg, image/png, image/jpg">
                            </div>
                            <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                                ⬆️ Unggah Foto
                            </button>
                        </form>
                    </div>
                </div>

                <div class="w-full md:w-2/3">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="font-bold text-lg mb-4">Galeri Foto Tersimpan</h3>
                        
                        @if($gambarMedias->isEmpty())
                            <p class="text-gray-500 text-center py-8 border-2 border-dashed rounded-lg">Belum ada foto yang diunggah.</p>
                        @else
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                @foreach($gambarMedias as $gambar)
                                    <div class="relative group border rounded-lg overflow-hidden shadow-sm">
                                        <img src="{{ asset('storage/' . $gambar->path_gambar) }}" alt="Foto Iklan" class="w-full h-40 object-cover">
                                        
                                        <div class="absolute bottom-0 left-0 right-0 bg-white bg-opacity-90 p-2 text-center border-t">
                                            <form action="{{ route('pemilik.gambar-media.destroy', $gambar->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus foto ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800 font-bold text-sm">🗑️ Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>