<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\AbsensiModel;
use App\Models\IzinModel;
use App\Models\SakitModel;

class MahasiswaAbsensiController extends Controller
{
    public function show($id)
    {
        $absensi = AbsensiModel::findOrFail($id);
        // Misal: logic absensi di sini...
        return view('mahasiswa.absensi_show', compact('absensi'));
    }

    public function izinForm($id)
    {
        $absensi = AbsensiModel::findOrFail($id);
        return view('mahasiswa.izin_form', compact('absensi'));
    }

    public function izinSubmit(Request $request, $id)
{
    $request->validate([
        'alasan' => 'required|string',
        'foto_surat' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
    ]);

    $izin = new IzinModel();
    $izin->absensi_id = $id;
    $izin->mahasiswa_id = auth()->id();
    $izin->alasan = $request->alasan;
    $izin->status = 'izin';

    $izin->waktu_absen = now();

    // Simpan foto surat kalau ada
    if ($request->hasFile('foto_surat')) {
        $fotoFile = $request->file('foto_surat');
        $fotoName = uniqid() . '.' . $fotoFile->getClientOriginalExtension();
        $fotoFile->move(public_path('gambar'), $fotoName);
        $izin->foto_surat = $fotoName;
    }

    $izin->save();

    return redirect('/dashboard/mahasiswa')->with('success', 'Izin berhasil diajukan.');
}


    public function sakitForm($id)
    {
        $absensi = AbsensiModel::findOrFail($id);
        return view('mahasiswa.sakit_form', compact('absensi'));
    }

public function sakitSubmit(Request $request, $id)
{
    $request->validate([
        'alasan' => 'required|string',
        'foto_surat' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
    ]);

    $izin = new SakitModel();
    $izin->absensi_id = $id;
    $izin->mahasiswa_id = auth()->id();
    $izin->alasan = $request->alasan;
    $izin->status = 'sakit';

    // Simpan waktu absen real-time
    $izin->waktu_absen = now();  // atau bisa juga Carbon::now()

    // Simpan foto surat kalau ada
    if ($request->hasFile('foto_surat')) {
        $fotoFile = $request->file('foto_surat');
        $fotoName = uniqid() . '.' . $fotoFile->getClientOriginalExtension();
        $fotoFile->move(public_path('gambar'), $fotoName);
        $izin->foto_surat = $fotoName;
    }

    $izin->save();

    return redirect('/dashboard/mahasiswa')->with('success', 'Izin berhasil diajukan.');
}

}
