<?php

namespace App\Http\Controllers;

use App\Http\Requests\MatkulRequest;
use App\Models\JurusanModel;
use App\Models\KelasModel;
use App\Models\MatkulModel;
use Illuminate\Http\Request;

class MatkulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allMatkul = MatkulModel::with(['jurusan', 'kelas'])->get();

    $grouped = $allMatkul->groupBy(function ($item) {
        return $item->nama_matkul . '|' . $item->jurusan->nama_jurusan;
    });

    $matkuls = $grouped->map(function ($items) {
        $first = $items->first();
        return [
            'nama_matkul' => $first->nama_matkul,
            'sks' => $first->sks,
            'jurusan' => $first->jurusan->nama_jurusan,
            'kelas' => $items->map(function ($i) {
                return [
                    'nama_kelas' => $i->kelas->nama_kelas,
                    'angkatan' => $i->kelas->angkatan,
                ];
            }),
        ];
    })->values();

    return view('mahasiswa.matkul.matkul', compact('matkuls'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jurusan = JurusanModel::all();
        return view('mahasiswa.matkul.tambah', compact('jurusan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MatkulRequest $request)
    {
        foreach ($request->kelas_id as $kelasId) {
            MatkulModel::create([
                'nama_matkul' => $request->nama_matkul,
                'sks' => $request->sks,
                'jurusan_id' => $request->jurusan_id,
                'kelas_id' => $kelasId,
            ]);
        }

        return redirect('/matkul');
        
    }

    public function getKelas(Request $request)
{
    $kelas = \App\Models\KelasModel::where('jurusan_id', $request->jurusan_id)
                ->where('angkatan', $request->angkatan)
                ->get();

    return response()->json($kelas);
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $nama_matkul)
{
    // Cari berdasarkan nama_matkul, bukan id
    $matkul = MatkulModel::with('kelas')
        ->where('nama_matkul', $nama_matkul)
        ->firstOrFail();

    $jurusan = JurusanModel::all();

    // Ambil angkatan dari relasi kelas, kalau ada
    $angkatan = $matkul->kelas->first() ? $matkul->kelas->first()->angkatan : '';

    return view('mahasiswa.matkul.edit', compact('matkul', 'jurusan', 'angkatan'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(MatkulRequest $request, string $nama_matkul)
{
    // Cari matkul berdasarkan nama_matkul, bukan id
    $matkul = MatkulModel::where('nama_matkul', $nama_matkul)->firstOrFail();

    $matkul->nama_matkul = $request->nama_matkul;
    $matkul->sks = $request->sks;
    $matkul->jurusan_id = $request->jurusan_id;
    $matkul->save();

    // Sync relasi many-to-many dengan kelas
    $matkul->kelas()->sync($request->kelas_id);

    return redirect('/matkul')->with('success', 'Mata kuliah berhasil diperbarui.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $nama_matkul)
{
    // Cari matkul berdasarkan nama_matkul
    $matkul = MatkulModel::where('nama_matkul', $nama_matkul)->firstOrFail();

    // Hapus data matkul
    $matkul->delete();

    return redirect('/matkul')->with('success', 'Mata kuliah "' . $nama_matkul . '" berhasil dihapus.');
}

}
