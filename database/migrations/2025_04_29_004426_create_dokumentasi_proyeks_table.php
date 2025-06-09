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
        Schema::create('dokumentasi_proyeks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('progres_id')->constrained('progres_pembangunans')->onDelete('cascade');
            $table->foreignId('laporan_id')->constrained('laporan_proyeks')->onDelete('cascade');
            $table->string('file_path');
            $table->string('file_type');
            $table->integer('persentase')->nullable();
            $table->string('keterangan')->nullable(); 
            $table->boolean('is_initial')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumentasi_proyeks');
    }
};
