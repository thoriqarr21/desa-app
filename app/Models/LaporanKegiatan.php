<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanKegiatan extends Model
{
    protected $table = 'laporan_kegiatans';
    protected $fillable = [
        'kegiatan_id',
        'user_id',
        'kode_kegiatan',
        'tujuan_kegiatan',
        'hasil',
        'evaluasi',
        'keterangan',
        'is_approved',
        'keterangan_tolak',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kegiatan()
    {
        return $this->belongsTo(DesaKegiatan::class, 'kegiatan_id');
    }

    public function semuaDokumentasi()
    {
        return $this->hasMany(DokumentasiKegiatan::class);
    }

    public function dokumentasi()
    {
        return $this->hasMany(DokumentasiKegiatan::class, 'laporan_id' );
    }
}
