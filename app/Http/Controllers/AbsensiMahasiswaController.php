<?php

namespace App\Http\Controllers;

use App\Models\AbsensiMahasiswaModel;
use App\Models\AbsensiModel;
use Illuminate\Http\Request;

class AbsensiMahasiswaController extends Controller
{
    public function index()
{
    
    $absensisAktif = AbsensiModel::where('waktu_mulai', '<=', now())
                        ->where('waktu_selesai', '>=', now())
                        ->get();

    return view('mahasiswa.absensi_mahasiswa', compact('absensisAktif'));
}


    // Tampilkan form absen mahasiswa
    public function show($absensi_id)
{
    $absensi = AbsensiModel::findOrFail($absensi_id);

    $absensisAktif = AbsensiModel::where('waktu_mulai', '<=', now())
                        ->where('waktu_selesai', '>=', now())
                        ->get();

    return view('mahasiswa.absensi_mahasiswa', compact('absensi', 'absensisAktif'));
}


    // Mahasiswa absen
  public function store(Request $request, $id)
{
    $absensi = AbsensiModel::findOrFail($id);

    $request->validate([
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
    ]);

    // Hitung jarak antara lokasi mahasiswa dan titik absensi
    $jarak = $this->hitungJarak(
        $request->latitude,
        $request->longitude,
        $absensi->latitude,
        $absensi->longitude
    );

    // Jika jarak lebih besar dari radius yang diizinkan
    if ($jarak > $absensi->radius) {
        return back()->with('error', 'Jarak terlalu jauh dari lokasi absensi.');
    }

    // Simpan absensi hadir
    AbsensiMahasiswaModel::updateOrCreate(
        ['absensi_id' => $id, 'mahasiswa_id' => auth()->id()],
        [
            'waktu_absen' => now(),
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]
    );

    return redirect('/dashboard/mahasiswa')->with('success', 'Absensi hadir berhasil dicatat!');
}

// Fungsi hitung jarak Haversine (dalam meter)
private function hitungJarak($lat1, $lon1, $lat2, $lon2)
{
    $earthRadius = 6371000; // radius bumi dalam meter
    $dLat = deg2rad($lat2 - $lat1);
    $dLon = deg2rad($lon2 - $lon1);

    $a = sin($dLat / 2) * sin($dLat / 2) +
        cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
        sin($dLon / 2) * sin($dLon / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    return $earthRadius * $c;
}

}