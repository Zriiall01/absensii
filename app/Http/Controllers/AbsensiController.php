<?php

namespace App\Http\Controllers;

use App\Models\AbsensiModel;
use Illuminate\Http\Request;
use PDF; // jika pakai dompdf
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AbsensiExport;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class AbsensiController extends Controller
{
    public function create()
    {
        return view('dosen.absensi');
    }

    // Simpan absensi
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'nullable',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date|after:waktu_mulai',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'radius' => 'required|numeric'
        ]);

        AbsensiModel::create([
            'dosen_id' => auth()->id(),
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'radius' => $request->radius,
        ]);

        return redirect()->route('absensi.index')->with('success', 'Absensi berhasil dibuat!');
    }

    // Tampilkan daftar absensi dosen
    public function index(Request $request)
{
    $query = AbsensiModel::where('dosen_id', auth()->id())->with('mahasiswaAbsensi.mahasiswa');

    if ($request->has('tanggal') && $request->tanggal) {
        $query->whereDate('waktu_mulai', $request->tanggal);
    }

    $absensis = $query->orderBy('waktu_mulai', 'desc')->get();

    return view('dosen.absensi_dosen', compact('absensis'));
}

public function show($id)
{
    $absensi = AbsensiModel::with('mahasiswaAbsensi.mahasiswa')->findOrFail($id);
    return view('dosen.detail', compact('absensi'));
}

public function download($id)
{
    $absensi = AbsensiModel::with('mahasiswaAbsensi.mahasiswa')->findOrFail($id);

    $format = request('format');

    if ($format == 'pdf') {
        $pdf = FacadePdf::loadView('dosen.pdf', compact('absensi'));
        return $pdf->download('absensi-'.$absensi->judul.'.pdf');
    } elseif ($format == 'excel') {
        return Excel::download(new AbsensiExport($absensi), 'absensi-'.$absensi->judul.'.xlsx');
    } else {
        return back()->with('error', 'Format tidak valid.');
    }
}

public function destroy($id)
{
    $absensi = AbsensiModel::findOrFail($id);

    // Jika ingin hapus relasi mahasiswaAbsensi juga (supaya bersih)
    $absensi->mahasiswaAbsensi()->delete();

    // Hapus absensi
    $absensi->delete();

    return redirect()->route('absensi.index')->with('success', 'Absensi berhasil dihapus.');
}


}
