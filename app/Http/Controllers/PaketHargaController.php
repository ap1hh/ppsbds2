<?php

namespace App\Http\Controllers;

use App\Models\MediaIklan;
use App\Models\PaketHarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaketHargaController extends Controller
{
    // Menampilkan halaman kelola harga untuk satu media iklan spesifik
    public function index(MediaIklan $mediaIklan)
    {
        // Keamanan: Pastikan media iklan ini benar milik user yang login
        if ($mediaIklan->pemilik_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        // Ambil semua paket harga yang dimiliki iklan ini
        $paketHargas = PaketHarga::where('media_iklan_id', $mediaIklan->id)->latest()->get();
        
        return view('pemilik.paket-harga.index', compact('mediaIklan', 'paketHargas'));
    }

    // Menyimpan paket harga baru
    public function store(Request $request, MediaIklan $mediaIklan)
    {
        if ($mediaIklan->pemilik_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        // 1. Tambahkan validasi nama_paket
        $request->validate([
            'nama_paket' => 'required|string|max:255',
            'durasi_hari' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
        ]);

        // 2. Tambahkan nama_paket saat menyimpan
        PaketHarga::create([
            'media_iklan_id' => $mediaIklan->id,
            'nama_paket' => $request->nama_paket,
            'durasi_hari' => $request->durasi_hari,
            'harga' => $request->harga,
        ]);

        return back()->with('success', 'Paket harga baru berhasil ditambahkan!');
    }

    // Menghapus paket harga
    public function destroy(PaketHarga $paketHarga)
    {
        // Cari induk medianya dulu untuk cek kepemilikan
        $mediaIklan = MediaIklan::findOrFail($paketHarga->media_iklan_id);
        
        if ($mediaIklan->pemilik_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        $paketHarga->delete();

        return back()->with('success', 'Paket harga berhasil dihapus!');
    }
}