<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DosenModel;
use App\Models\JurusanModel;
use App\Models\MatkulModel;
use App\Models\KelasModel;
use Illuminate\Support\Facades\Auth;

class DosenController extends Controller
{
    public function dashboard()
    {
        $userId = Auth::id();

        $dosen = DosenModel::with(['matkul', 'jurusan', 'kelas'])
            ->where('users', $userId)
            ->first();

        return view('dosen.dashboard', compact('dosen'));
    }

    public function editOrCreate()
{
    $dosen = DosenModel::with('kelas')->where('users', auth()->id())->first();
    $jurusan = JurusanModel::all();
    $matkul = MatkulModel::select('nama_matkul')->distinct()->get();

    return view('dosen.biodata', compact('dosen', 'jurusan', 'matkul'));
}

public function storeOrUpdate(Request $request)
{
    $request->validate([
        'nama_dosen' => 'required|string|max:255',
        'nip' => 'required|string|max:20|unique:dosen,nip,' . (auth()->user()->dosen->dosen_id ?? 'NULL') . ',dosen_id',
        'jurusan_id' => 'required|exists:jurusan,jurusan_id',
        'matkul_id' => 'required|exists:matkul,matkul_id',
        'kelas_id' => 'required|array',
        'kelas_id.*' => 'exists:kelas,kelas_id',
    ]);

    // Cek apakah data dosen sudah ada
    $dosen = DosenModel::where('users', auth()->id())->first();

    if (!$dosen) {
        $dosen = new DosenModel();
        $dosen->users = auth()->id();
    }

    $dosen->nama_dosen = $request->nama_dosen;
    $dosen->nip = $request->nip;
    $dosen->jurusan_id = $request->jurusan_id;
    $dosen->matkul_id = $request->matkul_id;
    $dosen->save();

    // Sync kelas
    $dosen->kelas()->sync($request->kelas_id);

    return redirect()->back()->with('success', 'Data dosen berhasil disimpan/diupdate.');
}

public function getKelas(Request $request)
{
    $request->validate([
        'jurusan_id' => 'required|integer',
        'matkul_id' => 'required|integer',
        'angkatan' => 'required|integer',
    ]);

    $kelas = \App\Models\KelasModel::where('jurusan_id', $request->jurusan_id)
        ->where('angkatan', $request->angkatan)
        ->get();

    return response()->json($kelas);
}

}
