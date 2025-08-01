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
        return $this->hasOneThrough(
            \App\Models\ProgresPembangunan::class,
            \App\Models\LaporanProyek::class,
            'proyek_id',      
            'laporan_id',    
            'id',             
            'id'              
        )->latestOfMany();
    }
    public function semuaProgres()
{
    return $this->hasManyThrough(
        \App\Models\ProgresPembangunan::class,
        \App\Models\LaporanProyek::class,
        'proyek_id',    
        'laporan_id',   
        'id',           
        'id'            
    );
}
public function getLatitudeAttribute()
{
    $lokasi = explode(',', $this->lokasi);
    return $lokasi[0] ?? null;
}

public function getLongitudeAttribute()
{
    $lokasi = explode(',', $this->lokasi);
    return $lokasi[1] ?? null;
}


    public function laporanProyek()
{
    return $this->hasOne(LaporanProyek::class, 'proyek_id');
}

}
