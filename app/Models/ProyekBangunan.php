<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProyekBangunan extends Model
{
    protected $fillable = [
        'proyek_id', 'nama_bangunan','jumlah_lantai','luas_bangunan', 'fungsi'
    ];

    public function pembangunanProyek()
    {
        return $this->belongsTo(PembangunanProyek::class, 'proyek_id');
    }
}
