<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AbsensiMahasiswaController;
use App\Http\Controllers\Auth\ForgotPasswordController as AuthForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController as AuthResetPasswordController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\dashboardcont;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MahasiswaAbsensiController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatkulController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\Usercontroller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing_page.index');
});

Route::middleware(['guest'])->group(function(){
    Route::get('/login', [AuthController::class, 'showlogin']);
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register/mahasiswa', [AuthController::class, 'register']);
    Route::post('/register/mahasiswa', [AuthController::class, 'register_action_mahasiswa']);

    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm']);
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail']);

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
  });

  

Route::middleware(['auth', 'role:admin'])->group(function(){

    Route::get('/register/admin_dosen', [AuthController::class, 'register']);
    Route::post('/register/admin_dosen', [AuthController::class, 'register_action_dosen']);

    Route::get('/user', [Usercontroller::class, 'index']);
    Route::get('/delete_user/{id}', [Usercontroller::class, 'destroy']);

    Route::get('/dashboard/admin', [dashboardcont::class, 'index']);

    Route::get('/jurusan', [JurusanController::class, 'index']);
    Route::get('/tambah_jurusan', [JurusanController::class, 'tambah']);
    Route::post('/tambah_jurusan', [JurusanController::class, 'tambah_action']);
    Route::get('/edit_jrs/{id}/edit', [JurusanController::class, 'edit']);
    Route::post('/edit_jrs/{id}/edit', [JurusanController::class, 'edit_action']);
    Route::get('/hapus_jrs/{id}/hapus', [JurusanController::class, 'hapus']);

    Route::get('/kelas', [KelasController::class, 'index'])->name('kelas.index');
    Route::get('/tambah_kelas', [KelasController::class, 'create']);
    Route::post('/tambah_kelas', [KelasController::class, 'store']);
    Route::get('/edit_kelas/{id}/edit', [KelasController::class, 'edit']);
    Route::post('/edit_kelas/{id}/edit', [KelasController::class, 'update']);
    Route::get('/hapus_kelas/{id}/hapus', [KelasController::class, 'destroy']);

    Route::get('/matkul', [MatkulController::class, 'index'])->name('matkul.index');
    Route::get('/matkul/create', [MatkulController::class, 'create'])->name('matkul.create');
    Route::post('/matkul/create', [MatkulController::class, 'store'])->name('matkul.store');
    Route::get('/matkul/{id}/edit', [MatkulController::class, 'edit'])->name('matkul.edit');
    Route::put('/matkul/{id}/edit', [MatkulController::class, 'update'])->name('matkul.update');
    Route::delete('/matkul/{id}', [MatkulController::class, 'destroy'])->name('matkul.destroy');

    Route::get('/matkul/get-kelas', [MatkulController::class, 'getKelas'])->name('matkul.getKelas');

    });

Route::middleware(['auth', 'role:dosen'])->group(function() {

        Route::get('/dashboard-dosen', [DosenController::class, 'dashboard'])->name('dosen.dashboard');

Route::get('/data_diri/dosen', [DosenController::class, 'editOrCreate'])->name('dosen.form');
Route::post('/data_diri/dosen', [DosenController::class, 'storeOrUpdate'])->name('dosen.store_or_update');
Route::get('/get-kelas', [DosenController::class, 'getKelas'])->name('get.kelas');


Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi.index'); // daftar absensi (filter by tanggal)
    Route::get('/absensi/create', [AbsensiController::class, 'create'])->name('absensi.create'); // form buat absensi
    Route::post('/absensi', [AbsensiController::class, 'store'])->name('absensi.store'); // simpan absensi
    Route::get('/absensi/{id}', [AbsensiController::class, 'show'])->name('absensi.show');
    Route::get('/absensi/{id}/download', [AbsensiController::class, 'download'])->name('absensi.download');
    Route::delete('/absensi/{id}', [AbsensiController::class, 'destroy'])->name('absensi.destroy');
    Route::get('/get-kelas', [AbsensiController::class, 'getKelas']);


});



Route::middleware(['auth', 'role:mahasiswa'])->group(function(){
        Route::get('/dashboard/mahasiswa', [DashboardCont::class, 'mahasiswaDashboard']);

        Route::get('/mahasiswa/create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
Route::post('/mahasiswa/create', [MahasiswaController::class, 'storeOrUpdate']);
Route::get('/getKelas/{jurusanId}', [MahasiswaController::class, 'getKelas']);
Route::get('/getMatkul/{kelasId}', [MahasiswaController::class, 'getMatkul']);

// Route::get('/mahasiswa/absensi', [AbsensiMahasiswaController::class, 'index'])->name('mahasiswa.absensi.index');
    Route::get('/mahasiswa/absensi{id}', [AbsensiMahasiswaController::class, 'show'])->name('mahasiswa.absensi.show');
    Route::post('/mahasiswa/absensi{id}', [AbsensiMahasiswaController::class, 'store'])->name('mahasiswa.absensi.store');
    Route::get('/mahasiswa/absensi/{id}/izin', [MahasiswaAbsensiController::class, 'izinForm'])->name('mahasiswa.absensi.izin.form');
    Route::post('/mahasiswa/absensi/{id}/izin', [MahasiswaAbsensiController::class, 'izinSubmit'])->name('mahasiswa.absensi.izin.submit');
    Route::get('/mahasiswa/absensi/{id}/sakit', [MahasiswaAbsensiController::class, 'sakitForm'])->name('mahasiswa.absensi.sakit.form');
    Route::post('/mahasiswa/absensi/{id}/sakit', [MahasiswaAbsensiController::class, 'sakitSubmit'])->name('mahasiswa.absensi.sakit.submit');
    });


Route::middleware(['auth'])->group(function(){
        Route::get('/logout', [AuthController::class, 'logout']);
    });

