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
        Schema::create('pembangunan_proyeks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_proyek');
            $table->string('jenis_proyek');
            $table->text('deskripsi_proyek');
            $table->decimal('anggaran', 15, 2);
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('masa_kontrak')->nullable();
            $table->string('sumber_dana');
            $table->string('kontraktor');
            $table->string('penanggung_jawab');
            $table->string('status');
            $table->string('lokasi');
            $table->string('gambar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembangunan_proyeks');
    }
};
