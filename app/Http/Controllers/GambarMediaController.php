<?php

namespace App\Http\Controllers;

use App\Models\MediaIklan;
use App\Models\GambarMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // <-- Wajib ada untuk urus file

class GambarMediaController extends Controller
{
    // Menampilkan halaman galeri foto untuk satu iklan
    public function index(MediaIklan $mediaIklan)
    {
        if ($mediaIklan->pemilik_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        $gambarMedias = GambarMedia::where('media_iklan_id', $mediaIklan->id)->latest()->get();
        return view('pemilik.gambar-media.index', compact('mediaIklan', 'gambarMedias'));
    }

    // Menerima upload foto baru
    public function store(Request $request, MediaIklan $mediaIklan)
    {
        if ($mediaIklan->pemilik_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        // Validasi: Wajib gambar (jpg, jpeg, png) dan maksimal ukuran 2MB
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 1. Simpan fisik fotonya ke folder storage/app/public/galeri_iklan
        $path = $request->file('foto')->store('galeri_iklan', 'public');

        // 2. Simpan nama/jalur fotonya ke database
        GambarMedia::create([
            'media_iklan_id' => $mediaIklan->id,
            'path_gambar' => $path,
        ]);

        return back()->with('success', 'Foto berhasil diunggah dan ditambahkan ke galeri!');
    }

    // Menghapus foto
    public function destroy(GambarMedia $gambarMedia)
    {
        $mediaIklan = MediaIklan::findOrFail($gambarMedia->media_iklan_id);
        
        if ($mediaIklan->pemilik_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        // 1. Hapus file fisiknya dari folder storage
        if (Storage::disk('public')->exists($gambarMedia->path_gambar)) {
            Storage::disk('public')->delete($gambarMedia->path_gambar);
        }

        // 2. Hapus datanya dari database
        $gambarMedia->delete();

        return back()->with('success', 'Foto berhasil dihapus!');
    }
}