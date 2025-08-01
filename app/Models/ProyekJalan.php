<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProyekJalan extends Model
{
    protected $table = 'proyek_jalans';
    protected $fillable = [
        'proyek_id','panjang_jalan', 'lebar_jalan','jenis_permukaan', 'kondisi_jalan'
    ];

    public function pembangunanProyek()
    {
        return $this->belongsTo(PembangunanProyek::class, 'proyek_id');
    }
}
