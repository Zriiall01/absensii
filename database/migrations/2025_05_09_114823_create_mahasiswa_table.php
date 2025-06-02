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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->bigIncrements('mahasiswa_id');
            $table->string('foto');
            $table->string('nama_mahasiswa');
            $table->enum('gender', ['L', 'P'])->default('L');
            $table->string('alamat');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('npm_mahasiswa');
            $table->unsignedBigInteger('jurusan_id');
            $table->foreign('jurusan_id')->references('jurusan_id')->on('jurusan')->onDelete('cascade');
            $table->unsignedBigInteger('kelas_id');
            $table->foreign('kelas_id')->references('kelas_id')->on('kelas')->onDelete('cascade');
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
        Schema::dropIfExists('mahasiswa');
    }
};
