<?php

namespace App\Http\Controllers;

use App\Models\AbsensiModel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AbsensiExport;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\JurusanModel;
use App\Models\KelasModel;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    /**
     * Tampilkan form buat absensi baru.
     */
    public function create()
    {
        $jurusanList = JurusanModel::all();
        return view('dosen.absensi', compact('jurusanList'));
    }

    /**
     * Simpan absensi yang baru dibuat.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'waktu_mulai' => 'required|date_format:Y-m-d H:i',
            'waktu_selesai' => 'required|date_format:Y-m-d H:i|after_or_equal:waktu_mulai',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'radius' => 'required|numeric',
            'kelas_id' => 'required'
        ]);

        $absensi = AbsensiModel::create([
            'dosen_id' => auth()->id(),
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
            'kelas_id' => $validated['kelas_id'],
            'waktu_mulai' => $validated['waktu_mulai'],
            'waktu_selesai' => $validated['waktu_selesai'],
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
            'radius' => $validated['radius'],
        ]);

        // Hubungkan absensi dengan kelas (many-to-many)
        $absensi->kelas()->sync($validated['kelas_id']);

        return redirect()->route('absensi.index')->with('success', 'Absensi berhasil dibuat.');
    }

    /**
     * Tampilkan daftar absensi yang dibuat dosen.
     */
   public function index(Request $request)
{
    $query = AbsensiModel::where('dosen_id', auth()->id())
        ->with([
            'mahasiswaAbsensi.mahasiswa',
            'izinMahasiswa.mahasiswa',
            'sakitMahasiswa.mahasiswa'
        ]);

    if ($request->has('tanggal') && $request->tanggal) {
        $query->whereDate('waktu_mulai', $request->tanggal);
    }

    $absensis = $query->orderBy('waktu_mulai', 'desc')->get();

    // Hitung total masing-masing status
    $totalHadir = 0;
    $totalIzin = 0;
    $totalSakit = 0;

    foreach ($absensis as $absen) {
        $totalHadir += $absen->mahasiswaAbsensi->count();
        $totalIzin += $absen->izinMahasiswa->count();
        $totalSakit += $absen->sakitMahasiswa->count();
    }

    return view('dosen.absensi_dosen', compact('absensis', 'totalHadir', 'totalIzin', 'totalSakit'));
}

    /**
     * Tampilkan detail absensi beserta data hadir, izin, dan sakit.
     */
    public function show($id)
    {
        $absensi = AbsensiModel::with([
            'mahasiswaAbsensi.mahasiswa',
            'izinMahasiswa.mahasiswa',
            'sakitMahasiswa.mahasiswa'
        ])->findOrFail($id);

        return view('dosen.detail', compact('absensi'));
    }

    /**
     * Unduh data absensi dalam PDF atau Excel.
     */
    public function download($id)
    {
        $absensi = AbsensiModel::with([
            'mahasiswaAbsensi.mahasiswa',
            'izinMahasiswa.mahasiswa',
            'sakitMahasiswa.mahasiswa'
        ])->findOrFail($id);

        $format = request('format');

        if ($format === 'pdf') {
            $pdf = Pdf::loadView('dosen.pdf', compact('absensi'));
            return $pdf->download('absensi-' . $absensi->judul . '.pdf');
        } elseif ($format === 'excel') {
            return Excel::download(new AbsensiExport($absensi), 'absensi-' . $absensi->judul . '.xlsx');
        } else {
            return back()->with('error', 'Format tidak valid.');
        }
    }

    /**
     * Hapus data absensi.
     */
    public function destroy($id)
    {
        $absensi = AbsensiModel::findOrFail($id);

        // Hapus relasi data absensi mahasiswa (hadir, izin, sakit) jika perlu
        $absensi->mahasiswaAbsensi()->delete();
        $absensi->izinMahasiswa()->delete();
        $absensi->sakitMahasiswa()->delete();

        // Hapus data absensi
        $absensi->delete();

        return redirect()->route('absensi.index')->with('success', 'Absensi berhasil dihapus.');
    }

    /**
     * Mendapatkan kelas berdasarkan jurusan dan angkatan.
     */
    public function getKelas(Request $request)
    {
        $jurusanId = $request->query('jurusan_id');
    $angkatan = $request->query('angkatan');

    $kelas = KelasModel::where('jurusan_id', $jurusanId)
                  ->where('angkatan', $angkatan)
                  ->get(['kelas_id', 'nama_kelas', 'angkatan']);

    return response()->json($kelas);
    }
}
