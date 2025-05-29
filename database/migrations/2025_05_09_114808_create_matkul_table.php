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
        Schema::create('matkul', function (Blueprint $table) {
            $table->bigIncrements('matkul_id');
            $table->string('nama_matkul');
            $table->string('sks');
            $table->unsignedBigInteger('jurusan_id');
            $table->foreign('jurusan_id')->references('jurusan_id')->on('jurusan')->onDelete('cascade');
            $table->unsignedBigInteger('kelas_id');
            $table->foreign('kelas_id')->references('kelas_id')->on('kelas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matkul');
    }
};
