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
        Schema::create('progres_pembangunans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laporan_id')->constrained('laporan_proyeks')->onDelete('cascade');
            $table->integer('persentase');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progres_pembangunans');
    }
};
