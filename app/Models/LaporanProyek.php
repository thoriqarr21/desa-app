<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanProyek extends Model
{
    protected $table = 'laporan_proyeks';
    protected $fillable = ['proyek_id','kode_laporan', 'user_id','keterangan','kendala','evaluasi', 'is_approved', 'keterangan_tolak'];

    public function proyek()
    {
        return $this->belongsTo(PembangunanProyek::class, 'proyek_id');
    }
    public function progres()
    {
        return $this->hasMany(ProgresPembangunan::class, 'laporan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function semuaDokumentasi()
    {
        return $this->hasManyThrough(DokumentasiProyek::class, ProgresPembangunan::class);
    }
    
    public function progresTerbaru()
    {
        return $this->hasOne(ProgresPembangunan::class, 'laporan_id')->orderByDesc('persentase');
    }
    
    public function dokumentasi()
    {
        return $this->hasManyThrough(DokumentasiProyek::class, ProgresPembangunan::class, 'laporan_id', 'progres_id');
    }
}
