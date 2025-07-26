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
        Schema::create('laporan_kegiatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kegiatan_id')->constrained('desa_kegiatans')->onDelete('cascade');
            $table->foreignId('user_id')->onDelete('cascade');
            $table->string('kode_kegiatan')->unique(); // Tambahkan kolom kode_kegiatan
            $table->string('tujuan_kegiatan');
            $table->string('hasil');
            $table->string('evaluasi');
            $table->string('keterangan');
            $table->boolean('is_approved')->nullable(); // NULL = belum diproses, TRUE = disetujui, FALSE = ditolak
            $table->text('keterangan_tolak')->nullable();
            $table->timestamps();
            
            // Optional: bisa juga diberi indeks untuk pencarian lebih cepat
            $table->index('kode_kegiatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_kegiatans');
    }
};
