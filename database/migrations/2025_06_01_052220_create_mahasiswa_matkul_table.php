<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahasiswaMatkulTable extends Migration
{
    public function up()
    {
        Schema::create('mahasiswa_matkul', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mahasiswa_id');
            $table->unsignedBigInteger('matkul_id');
            $table->timestamps();

            $table->foreign('mahasiswa_id')->references('mahasiswa_id')->on('mahasiswa')->onDelete('cascade');
            $table->foreign('matkul_id')->references('matkul_id')->on('matkul')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('mahasiswa_matkul');
    }
}
