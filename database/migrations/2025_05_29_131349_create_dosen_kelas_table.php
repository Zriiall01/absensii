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
        Schema::create('dosen_kelas', function (Blueprint $table) {
            $table->id();
        $table->unsignedInteger('dosen_id'); // pastikan ini tipe yg sesuai
        $table->unsignedBigInteger('kelas_id');

        $table->foreign('dosen_id')->references('dosen_id')->on('dosen')->onDelete('cascade');
        $table->foreign('kelas_id')->references('kelas_id')->on('kelas')->onDelete('cascade');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosen_kelas');
    }
};
