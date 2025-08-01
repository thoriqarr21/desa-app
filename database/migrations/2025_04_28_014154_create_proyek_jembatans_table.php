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
        Schema::create('proyek_jembatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proyek_id')->constrained('pembangunan_proyeks')->onDelete('cascade');
            $table->string('panjang_jembatan');
            $table->string('lebar_jembatan');
            $table->string('kapasitas_beban');
            $table->string('tipe_struktur');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyek_jembatans');
    }
};
