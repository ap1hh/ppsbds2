<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketHarga extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi balik ke MediaIklan
    public function mediaIklan()
    {
        return $this->belongsTo(MediaIklan::class, 'media_iklan_id');
    }

    // Satu paket harga bisa disewa berkali-kali
    public function penyewaans()
    {
        return $this->hasMany(Penyewaan::class, 'paket_harga_id');
    }
}