<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyewaan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function penyewa()
    {
        return $this->belongsTo(User::class, 'penyewa_id');
    }

    public function detailPenyewaans()
    {
        return $this->hasMany(DetailPenyewaan::class, 'penyewaan_id');
    }
}