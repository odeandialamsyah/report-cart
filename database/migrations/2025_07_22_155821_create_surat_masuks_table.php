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
        Schema::create('surat_masuks', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('tujuan', 100);
            $table->string('asal', 100);
            $table->string('nomor', 50);
            $table->string('perihal');
            $table->string('file');
            $table->enum('status', ['diajukan','diverifikasi','didisposisi','selesai'])->default('diajukan');
            
            $table->foreignId('pengirim_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_masuks');
    }
};
