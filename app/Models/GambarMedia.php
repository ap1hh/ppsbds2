<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GambarMedia extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi balik ke MediaIklan
    public function mediaIklan()
    {
        return $this->belongsTo(MediaIklan::class, 'media_iklan_id');
    }
}