<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumentasiProyek extends Model
{
    use HasFactory;

    protected $fillable = ['laporan_id','progres_id', 'file_path','file_type','persentase', 'keterangan', 'is_initial'];

    public function progres()
    {
        return $this->belongsTo(ProgresPembangunan::class, 'progres_id');
    }
    public function laporan()
{
    return $this->belongsTo(LaporanProyek::class, 'laporan_id');
}
public function progresTerbaru()
{
    return $this->hasOne(ProgresPembangunan::class, 'laporan_id')->orderByDesc('persentase');
}
}
