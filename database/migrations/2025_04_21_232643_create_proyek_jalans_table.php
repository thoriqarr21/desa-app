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
        Schema::create('proyek_jalans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proyek_id')->constrained('pembangunan_proyeks')->onDelete('cascade');
            $table->string('panjang_jalan');
            $table->string('lebar_jalan');
            $table->string('jenis_permukaan');
            $table->string('kondisi_jalan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyek_jalans');
    }
};
