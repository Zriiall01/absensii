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
        Schema::create('dosen', function (Blueprint $table) {
            $table->increments('dosen_id');
            $table->string('nama_dosen');
            $table->string('nip');
            $table->unsignedBigInteger('jurusan_id');
            $table->foreign('jurusan_id')->references('jurusan_id')->on('jurusan')->onDelete('cascade');
            $table->unsignedBigInteger('kelas_id');
            $table->foreign('kelas_id')->references('kelas_id')->on('kelas')->onDelete('cascade');
            $table->unsignedBigInteger('matkul_id');
            $table->foreign('matkul_id')->references('matkul_id')->on('matkul')->onDelete('cascade');
            $table->unsignedBigInteger('users');
            $table->foreign('users')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosen');
    }
};
