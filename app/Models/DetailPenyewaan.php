<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenyewaan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function penyewaan()
    {
        return $this->belongsTo(Penyewaan::class, 'penyewaan_id');
    }

    public function mediaIklan()
    {
        return $this->belongsTo(MediaIklan::class, 'media_iklan_id');
    }

    public function paketHarga()
    {
        return $this->belongsTo(PaketHarga::class, 'paket_harga_id');
    }

    public function ulasans()
    {
        return $this->hasMany(Ulasan::class, 'detail_penyewaan_id');
    }
}