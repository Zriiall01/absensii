<?php

use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MatkulController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

    Route::get('/jurusan', [JurusanController::class, 'index']);
    Route::get('/tambah_jurusan', [JurusanController::class, 'tambah']);
    Route::post('/tambah_jurusan', [JurusanController::class, 'tambah_action']);
    Route::get('/edit_jrs/{id}/edit', [JurusanController::class, 'edit']);
    Route::post('/edit_jrs/{id}/edit', [JurusanController::class, 'edit_action']);
    Route::get('/hapus_jrs/{id}/hapus', [JurusanController::class, 'hapus']);

    Route::get('/kelas', [KelasController::class, 'index']);
    Route::get('/tambah_kelas', [KelasController::class, 'create']);
    Route::post('/tambah_kelas', [KelasController::class, 'store']);
    Route::get('/edit_kelas/{id}/edit', [KelasController::class, 'edit']);
    Route::post('/edit_kelas/{id}/edit', [KelasController::class, 'update']);
    Route::get('/hapus_kelas/{id}/hapus', [KelasController::class, 'destroy']);

    Route::get('/matkul', [MatkulController::class, 'index'])->name('matkul.index');
    Route::get('/matkul/create', [MatkulController::class, 'create'])->name('matkul.create');
    Route::post('/matkul/create', [MatkulController::class, 'store'])->name('matkul.store');
    Route::get('/matkul/{id}/edit', [MatkulController::class, 'edit'])->name('matkul.edit');
    Route::put('/matkul/{id}', [MatkulController::class, 'update'])->name('matkul.update');
    Route::delete('/matkul/{id}', [MatkulController::class, 'destroy'])->name('matkul.destroy');

    Route::get('/matkul/get-kelas', [MatkulController::class, 'getKelas'])->name('matkul.getKelas');
