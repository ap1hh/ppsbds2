<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi balik ke User (Penyewa)
    public function detailPenyewaan()
    {
        return $this->belongsTo(DetailPenyewaan::class, 'detail_penyewaan_id');
    }
}