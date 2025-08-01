<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProyekJembatan extends Model
{
    
    protected $fillable = [
        'proyek_id','panjang_jembatan', 'lebar_jembatan','kapasitas_beban', 'tipe_struktur'
    ];

    public function pembangunanProyek()
    {
        return $this->belongsTo(PembangunanProyek::class, 'proyek_id');
    }
}
