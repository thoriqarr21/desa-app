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
        Schema::create('laporan_proyeks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proyek_id')->constrained('pembangunan_proyeks')->onDelete('cascade');
            $table->foreignId('user_id')->onDelete('cascade');
            $table->string('kode_laporan')->unique(); // Tambahan: kode unik laporan
            $table->string('keterangan');
            $table->string('kendala');
            $table->string('evaluasi');
            $table->boolean('is_approved')->nullable(); // NULL = belum diproses, TRUE = disetujui, FALSE = ditolak
            $table->text('keterangan_tolak')->nullable();
            $table->timestamps();

            $table->index('kode_laporan'); // Optional untuk pencarian cepat
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_proyeks');
    }
};
