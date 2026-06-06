<?php

namespace App\Http\Controllers;

use App\Models\MediaIklan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MediaIklanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Menampilkan daftar media iklan milik user yang sedang login
    public function index()
    {
        $mediaIklans = MediaIklan::where('pemilik_id', Auth::id())->latest()->get();
        return view('pemilik.media-iklan.index', compact('mediaIklans'));
    }

    // Menampilkan halaman form tambah media iklan
    public function create()
    {
        return view('pemilik.media-iklan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    // Menyimpan data media iklan baru ke database
    public function store(Request $request)
    {
        // 1. Validasi data dari form (pastikan tidak ada yang kosong/salah)
        $validatedData = $request->validate([
            'nama_lokasi' => 'required|string|max:255',
            'jenis' => 'required|in:reklame,videotron',
            'kapasitas_slot' => 'required|integer|min:1',
            'alamat_lokasi' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        // 2. Suntikkan ID Pemilik (yang sedang login) dan Status Awal
        $validatedData['pemilik_id'] = Auth::id();
        $validatedData['status_ketersediaan'] = 'tersedia';

        // 3. Simpan permanen ke tabel media_iklans
        MediaIklan::create($validatedData);

        // 4. Lempar kembali ke halaman daftar iklan dengan membawa pesan sukses
        return redirect()->route('pemilik.media-iklan.index')
            ->with('success', 'Hore! Media Iklan baru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // Menampilkan halaman form edit dengan data lama
    public function edit(MediaIklan $mediaIklan)
    {
        // Pastikan hanya pemilik asli yang boleh mengedit
        if ($mediaIklan->pemilik_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        return view('pemilik.media-iklan.edit', compact('mediaIklan'));
    }

    // Menyimpan perubahan data ke database
    public function update(Request $request, MediaIklan $mediaIklan)
    {
        // Pastikan hanya pemilik asli yang boleh mengubah
        if ($mediaIklan->pemilik_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        // Validasi isian form
        $validatedData = $request->validate([
            'nama_lokasi' => 'required|string|max:255',
            'jenis' => 'required|in:reklame,videotron',
            'kapasitas_slot' => 'required|integer|min:1',
            'alamat_lokasi' => 'required|string',
            'keterangan' => 'nullable|string',
            'status_ketersediaan' => 'required|in:tersedia,penuh',
        ]);

        // Simpan perubahan
        $mediaIklan->update($validatedData);

        // Kembalikan ke halaman tabel dengan pesan sukses
        return redirect()->route('pemilik.media-iklan.index')
            ->with('success', 'Data Media Iklan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    // Menghapus data dari database
    public function destroy(MediaIklan $mediaIklan)
    {
        // Keamanan tambahan: Pastikan yang menghapus adalah pemilik aslinya
        if ($mediaIklan->pemilik_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        $mediaIklan->delete();

        return redirect()->route('pemilik.media-iklan.index')
            ->with('success', 'Media Iklan berhasil dihapus.');
    }
}
