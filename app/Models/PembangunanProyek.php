<?php

namespace App\Models;

use App\Models\Jalan;
use Illuminate\Database\Eloquent\Model;

class PembangunanProyek extends Model
{
    protected $fillable = [
        'nama_proyek','jenis_proyek','deskripsi_proyek','anggaran', 'masa_kontrak','tanggal_mulai', 'tanggal_selesai','kontraktor','penanggung_jawab','sumber_dana', 'status','lokasi','gambar'
    ];

    public function proyekJalan()
    {
        return $this->hasOne(ProyekJalan::class, 'proyek_id');
    }
    public function proyekBangunan()
    {
        return $this->hasOne(ProyekBangunan::class, 'proyek_id');
    }
    public function proyekJembatan()
    {
        return $this->hasOne(ProyekJembatan::class, 'proyek_id');
    }
    public function progresTerbaru()
    {
        return $this->hasOne(ProgresPembangunan::class, 'laporan_id')->latestOfMany();
    }

    public function laporanProyek()
{
    return $this->hasOne(LaporanProyek::class, 'proyek_id');
}

}
