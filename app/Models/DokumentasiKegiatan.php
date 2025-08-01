<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumentasiKegiatan extends Model
{
    use HasFactory;

    protected $fillable = ['laporan_id', 'file_path','file_type'];

    public function kegiatan()
    {
        return $this->belongsTo(DesaKegiatan::class, 'kegiatan_id');
    }
    public function laporan()
{
    return $this->belongsTo(LaporanKegiatan::class, 'laporan_id');
}
}
