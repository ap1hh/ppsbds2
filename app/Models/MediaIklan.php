<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaIklan extends Model
{
    use HasFactory;

    // Izinkan semua kolom diisi data, kecuali ID
    protected $guarded = ['id'];

    // Relasi ke User (Pemilik)
    public function pemilik()
    {
        return $this->belongsTo(User::class, 'pemilik_id');
    }

    // Relasi ke Gambar Media
    public function gambarMedias()
    {
        return $this->hasMany(GambarMedia::class, 'media_iklan_id');
    }

    // Relasi ke Paket Harga
    public function paketHargas()
    {
        return $this->hasMany(PaketHarga::class, 'media_iklan_id');
    }
}