<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('desa_kegiatans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kegiatan');
            $table->foreignId('kategori_id')->constrained('kategori_kegiatans')->onDelete('cascade');
            $table->foreignId('user_id')->onDelete('cascade');
            $table->text('deskripsi_kegiatan');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('lama_hari')->nullable();
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->string('status');
            $table->string('gambar');
            $table->string('lokasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desa_kegiatans');
    }
};
