<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DesaKegiatan extends Model
{
    protected $fillable = [
        'kategori_id', 'user_id', 'nama_kegiatan','deskripsi_kegiatan','tanggal_mulai', 'tanggal_selesai','lama_hari','waktu_mulai', 'waktu_selesai', 'status','gambar', 'lokasi'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function kategoriKegiatan()
    {
        return $this->belongsTo(KategoriKegiatan::class, 'kategori_id');
    }
}
