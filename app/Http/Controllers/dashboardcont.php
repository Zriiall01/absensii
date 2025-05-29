<?php

namespace App\Http\Controllers;

use App\Models\DosenModel;
use App\Models\JurusanModel;
use App\Models\KelasModel;
use App\Models\MatkulModel;
use Illuminate\Http\Request;

class dashboardcont extends Controller
{
     public function index()
    {
        $jurusan = JurusanModel::all();
        $kelas = KelasModel::with('jurusan')->get();
        $matkul = MatkulModel::with('jurusan')->get();

        // Misal kamu juga mau hitung total data seperti di template sebelumnya
        $totalJurusan = $jurusan->count();
        $totalKelas = $kelas->count();
        $totalMatkul = $matkul->count();

        return view('db_admin', compact(
            'jurusan', 'kelas', 'matkul',
            'totalJurusan', 'totalKelas', 'totalMatkul'
        ));
    }


}
