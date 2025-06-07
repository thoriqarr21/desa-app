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
        Schema::create('proyek_bangunans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proyek_id')->constrained('pembangunan_proyeks')->onDelete('cascade');
            $table->string('nama_bangunan');
            $table->string('jumlah_lantai');
            $table->string('luas_bangunan');    // penjelasan
            $table->string('fungsi');    // penjelasan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyek_bangunans');
    }
};
