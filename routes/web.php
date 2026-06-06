<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MediaIklanController;

Route::get('/', function () {
    return view('welcome');
});

// --- ROUTE PENGARAH DASHBOARD ---
// Saat user login dan lari ke /dashboard, kita arahkan ke ruangan masing-masing
// --- ROUTE PENGARAH DASHBOARD ---
// --- ROUTE PENGARAH DASHBOARD ---
Route::get('/dashboard', function () {
    /** @var \App\Models\User $user */
    $user = Auth::user();
    
    $role = $user->role;
    
    if ($role === 'admin') return redirect('/admin/dashboard');
    if ($role === 'pemilik') return redirect('/pemilik/dashboard');
    return redirect('/penyewa/dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// --- RUANGAN ADMIN ---
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard', ['pesan' => 'Selamat Datang di Ruangan Pusat ADMIN']);
    });
});

// --- RUANGAN PEMILIK IKLAN ---
Route::middleware(['auth', 'role:pemilik'])->prefix('pemilik')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard', ['pesan' => 'Selamat Datang di Ruangan Kelola PEMILIK IKLAN']);
    });
});

// --- RUANGAN PENYEWA ---
Route::middleware(['auth', 'role:penyewa'])->prefix('penyewa')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard', ['pesan' => 'Selamat Datang di Ruangan Cari Iklan PENYEWA']);
    });
});

// --- FITUR PROFILE (Bawaan Breeze) ---
Route::middleware('auth')->group(function () {
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [\App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- RUANGAN PEMILIK IKLAN ---
Route::middleware(['auth', 'role:pemilik'])->prefix('pemilik')->name('pemilik.')->group(function () {
    
    Route::get('/dashboard', function () {
        return view('dashboard', ['pesan' => 'Selamat Datang di Ruangan Kelola PEMILIK IKLAN']);
    })->name('dashboard');

    // Mendaftarkan seluruh rute CRUD untuk Media Iklan
    Route::resource('media-iklan', MediaIklanController::class);
    // --- Rute Kelola Paket Harga ---
    Route::get('/media-iklan/{media_iklan}/paket-harga', [\App\Http\Controllers\PaketHargaController::class, 'index'])->name('paket-harga.index');
    Route::post('/media-iklan/{media_iklan}/paket-harga', [\App\Http\Controllers\PaketHargaController::class, 'store'])->name('paket-harga.store');
    Route::delete('/paket-harga/{paket_harga}', [\App\Http\Controllers\PaketHargaController::class, 'destroy'])->name('paket-harga.destroy');
    // --- Rute Kelola Gambar Media ---
    Route::get('/media-iklan/{media_iklan}/gambar', [\App\Http\Controllers\GambarMediaController::class, 'index'])->name('gambar-media.index');
    Route::post('/media-iklan/{media_iklan}/gambar', [\App\Http\Controllers\GambarMediaController::class, 'store'])->name('gambar-media.store');
    Route::delete('/gambar-media/{gambar_media}', [\App\Http\Controllers\GambarMediaController::class, 'destroy'])->name('gambar-media.destroy');
});


require __DIR__.'/auth.php';
