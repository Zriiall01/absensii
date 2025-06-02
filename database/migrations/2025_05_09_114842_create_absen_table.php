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
    Schema::create('absensis', function (Blueprint $table) {
    $table->id();
    $table->foreignId('dosen_id')->constrained('users'); // Relasi ke user dosen
    $table->string('judul');
    $table->text('deskripsi')->nullable();
    $table->timestamp('waktu_mulai');
    $table->timestamp('waktu_selesai');
    $table->decimal('latitude', 10, 7);
    $table->decimal('longitude', 10, 7);
    $table->float('radius')->default(100); // radius dalam meter
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absenis');
    }
};
