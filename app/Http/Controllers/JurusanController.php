<?php

namespace App\Http\Controllers;

use App\Http\Requests\JurusanRequest;
use App\Models\JurusanModel;
use App\Models\KelasModel;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
        {
        $data = [
            'jurusan' => JurusanModel::all(),
            'no' => 1,
        ];
        return view('Mahasiswa.jurusan.jurusan', $data);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function tambah()
    {
        return view('Mahasiswa.Jurusan.Tambah_jurusan');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function tambah_action(JurusanRequest $request)
    {
        $data = [
            'nama_jurusan' => $request->nama_jurusan
        ];

        JurusanModel::create($data);
        return redirect('/jurusan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $data = JurusanModel::where('jurusan_id', $id)->first();
        return view('Mahasiswa.Jurusan.edit_jurusan', compact('data'));
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function edit_action(int $id, JurusanRequest $request)
    {
        JurusanModel::where('jurusan_id', $id)->update([
            'nama_jurusan' => $request->nama_jurusan,
        ]);

        return redirect('/jurusan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function hapus(string $id)
    {
        $jumlahKelas = KelasModel::where('jurusan_id', $id)->count();

    if ($jumlahKelas > 0) {
        return redirect('/jurusan')->with('error', 'Data tidak dapat dihapus karena sedang digunakan oleh ' . $jumlahKelas . ' kelas.');
    }

        try {
        JurusanModel::where('jurusan_id', $id)->delete();
        return redirect('/jurusan')->with('success', 'Data berhasil dihapus.');
    } catch (\Exception $e) {
        return redirect('/jurusan')->with('error', 'Data tidak dapat dihapus karena sedang digunakan.');
    }
    }
}
