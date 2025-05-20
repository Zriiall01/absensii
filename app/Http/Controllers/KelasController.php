<?php

namespace App\Http\Controllers;

use App\Http\Requests\KelasRequest;
use App\Models\JurusanModel;
use App\Models\KelasModel;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = KelasModel::with('jurusan')
                ->orderBy('jurusan_id')   // urut berdasarkan jurusan
                ->orderBy('angkatan')     // lalu urut berdasarkan angkatan
                ->get();

    $no = 1;


        return view('mahasiswa.kelas.kelas', compact('kelas', 'no'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jurusan = JurusanModel::all();
        return view('mahasiswa.kelas.tambah_kelas', compact('jurusan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KelasRequest $request)
    {
        $data = [
            'nama_kelas' => $request->nama_kelas,
            'angkatan' => $request->angkatan,
            'jurusan_id' => $request->jurusan_id,
        ];

        KelasModel::create($data);
        return redirect('/kelas');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $data = KelasModel::where('kelas_id', $id)->first();
        $jurusan = JurusanModel::all();

        return view('mahasiswa.kelas.edit', compact('data', 'jurusan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KelasRequest $request, int $id)
    {
        KelasModel::where('kelas_id', $id)->update([
            'nama_kelas' => $request->nama_kelas,
            'angkatan' => $request->angkatan,
            'jurusan_id' => $request->jurusan_id,
        ]);

        return redirect('/kelas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         try {
        kelasModel::where('kelas_id', $id)->delete();
        return redirect('/kelas')->with('success', 'Data berhasil dihapus.');
    } catch (\Exception $e) {
        return redirect('/kelas')->with('error', 'Data tidak dapat dihapus karena sedang digunakan.');
    }
    }
}
