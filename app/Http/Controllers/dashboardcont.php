<?php

namespace App\Http\Controllers;

use App\Models\AbsenModel;
use App\Models\AbsensiModel;
use App\Models\DosenModel;
use App\Models\JurusanModel;
use App\Models\KelasModel;
use App\Models\MahasiswaModel;
use App\Models\MatkulModel;
use Illuminate\Http\Request;

class dashboardcont extends Controller
{
     public function index()
    {
    $jurusan = JurusanModel::all();
    $kelas = KelasModel::with('jurusan')->get();

    // Ambil matkul unik (tidak duplikat nama)
    $matkul = MatkulModel::select('nama_matkul', 'jurusan_id', 'sks')
                ->groupBy('nama_matkul', 'jurusan_id', 'sks')
                ->with('jurusan')
                ->get();

    $totalJurusan = $jurusan->count();
    $totalKelas = $kelas->count();
    $totalMatkul = $matkul->count();

    return view('db_admin', compact(
        'jurusan', 'kelas', 'matkul',
        'totalJurusan', 'totalKelas', 'totalMatkul'
    ));

    }

public function mahasiswaDashboard()
{
    $user = auth()->user();

    // Ambil data mahasiswa yang terhubung dgn user login
    $mahasiswa = MahasiswaModel::where('users', $user->id)->with('user', 'jurusan', 'kelas', 'matkuls')->first();

    // Cek apakah ada absen yang belum diisi
    // Ini contoh logika (bisa sesuaikan dgn table absensi kamu!)
    $absensisAktif = AbsensiModel::where('waktu_mulai', '<=', now())
            ->where('waktu_selesai', '>=', now())
            ->get();

    return view('mahasiswa.dasboard', compact('mahasiswa', 'absensisAktif'));
}

}
