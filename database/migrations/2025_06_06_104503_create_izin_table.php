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
        Schema::create('izin', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('users');
            $table->foreignId('absensi_id')->constrained('absensis')->onDelete('cascade');
            $table->timestamp('waktu_absen')->nullable();
            $table->text('alasan')->nullable();
            $table->string('foto_surat')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('izin');
    }
};
