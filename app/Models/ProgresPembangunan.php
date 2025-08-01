<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgresPembangunan extends Model
{

    use HasFactory;
    protected $fillable = ['laporan_id', 'persentase'];

    public function laporan()
{
    return $this->belongsTo(LaporanProyek::class, 'laporan_id');
}
public function dokumentasi()
{
    return $this->hasMany(DokumentasiProyek::class, 'progres_id');
}
}
