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
    $mahasiswaId = auth()->id();

    // Semua absensi aktif
    $absensisAktifSemua = AbsensiModel::where('waktu_selesai', '>=', now())->get();

    // Absensi yang sudah diisi oleh mahasiswa, dengan status dan info
    // Misal kamu punya relasi ke tabel hadir, izin, sakit, tinggal cari yang sudah ada recordnya

    $absensisSudahIsi = collect();

    foreach ($absensisAktifSemua as $absensi) {
        // Cek apakah mahasiswa sudah isi absen hadir
        $hadir = $absensi->mahasiswaAbsensi()->where('mahasiswa_id', $mahasiswaId)->first();
        if ($hadir) {
            $hadir->status = 'hadir';
            $absensisSudahIsi->push($hadir);
            continue;
        }

        // Cek izin
        $izin = $absensi->izinMahasiswa()->where('mahasiswa_id', $mahasiswaId)->first();
        if ($izin) {
            $izin->status = 'izin';
            $absensisSudahIsi->push($izin);
            continue;
        }

        // Cek sakit
        $sakit = $absensi->sakitMahasiswa()->where('mahasiswa_id', $mahasiswaId)->first();
        if ($sakit) {
            $sakit->status = 'sakit';
            $absensisSudahIsi->push($sakit);
            continue;
        }
    }

    // Filter absensi yang belum diisi
    $absensisSudahIsiIds = $absensisSudahIsi->pluck('absensi_id')->toArray();

    $absensisAktif = $absensisAktifSemua->filter(function ($item) use ($absensisSudahIsiIds) {
        return !in_array($item->id, $absensisSudahIsiIds);
    });

    return view('mahasiswa.dasboard', [
        'mahasiswa' => auth()->user()->mahasiswa, // contoh data mahasiswa
        'absensisAktif' => $absensisAktif,
        'absensisSudahIsi' => $absensisSudahIsi,
    ]);
}

}
