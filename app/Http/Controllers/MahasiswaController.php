<?php

namespace App\Http\Controllers;

use App\Models\JurusanModel;
use App\Models\KelasModel;
use App\Models\MahasiswaModel;
use App\Models\MatkulModel;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class MahasiswaController extends Controller
{
        public function create()
    {
        $userId = FacadesAuth::id();
        $jurusans = JurusanModel::all();

        // Cek apakah user sudah ada data mahasiswa
        $mahasiswa = MahasiswaModel::with('matkuls')->where('users', $userId)->first();

        $kelasList = [];
        $matkulList = [];

        // Jika edit, isi kelasList dan matkulList sesuai jurusan dan kelas mahasiswa
        if ($mahasiswa) {
            $kelasList = KelasModel::where('jurusan_id', $mahasiswa->jurusan_id)->get();
            $matkulList = MatkulModel::where('kelas_id', $mahasiswa->kelas_id)->get();
        }

        return view('mahasiswa.profil.data_diri', compact('jurusans', 'mahasiswa', 'kelasList', 'matkulList'));
    }

    // Store atau update data mahasiswa sekaligus
    public function storeOrUpdate(Request $request)
    {
         $userId = FacadesAuth::id();


        $mahasiswa = MahasiswaModel::where('users', $userId)->first();

        // Validasi
        $rules = [
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'nama_mahasiswa' => 'required',
            'gender' => 'required',
            'alamat' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jurusan_id' => 'required',
            'kelas_id' => 'required',
            'matkuls' => 'required|array',
        ];

        // Kalau tambah baru, npm wajib unik
        if (!$mahasiswa) {
            $rules['npm_mahasiswa'] = 'required|unique:mahasiswa,npm_mahasiswa';
        } else {
            // Kalau update, npm harus unik kecuali milik data ini sendiri
            $rules['npm_mahasiswa'] = 'required|unique:mahasiswa,npm_mahasiswa,' . $mahasiswa->mahasiswa_id . ',mahasiswa_id';
        }

        $request->validate($rules);

        // Kalau belum ada data, buat baru
        if (!$mahasiswa) {
            $mahasiswa = new MahasiswaModel();
            $mahasiswa->users = $userId;
        }

        // Upload foto jika ada file baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama kalau ada
            if ($mahasiswa->foto && file_exists(public_path('gambar/' . $mahasiswa->foto))) {
                unlink(public_path('gambar/' . $mahasiswa->foto));
            }

            $fotoFile = $request->file('foto');
            $fotoName = uniqid() . '.' . $fotoFile->getClientOriginalExtension();
            $fotoFile->move(public_path('gambar'), $fotoName);
            $mahasiswa->foto = $fotoName;
        }

        // Isi data lainnya
        $mahasiswa->nama_mahasiswa = $request->nama_mahasiswa;
        $mahasiswa->gender = $request->gender;
        $mahasiswa->alamat = $request->alamat;
        $mahasiswa->tempat_lahir = $request->tempat_lahir;
        $mahasiswa->tanggal_lahir = $request->tanggal_lahir;
        $mahasiswa->npm_mahasiswa = $request->npm_mahasiswa;
        $mahasiswa->jurusan_id = $request->jurusan_id;
        $mahasiswa->kelas_id = $request->kelas_id;

        $mahasiswa->save();

        // Sync mata kuliah many-to-many
        $mahasiswa->matkuls()->sync($request->matkuls);

        return redirect('/dashboard/mahasiswa')->with('success', 'Data mahasiswa berhasil disimpan!');
    }

    // Endpoint AJAX - get Kelas by Jurusan
    public function getKelas($jurusanId)
    {
        $kelas = KelasModel::where('jurusan_id', $jurusanId)->get();
        return response()->json($kelas);
    }

    // Endpoint AJAX - get Matkul by Kelas
    public function getMatkul($kelasId)
    {
        $matkuls = MatkulModel::where('kelas_id', $kelasId)->get();
        return response()->json($matkuls);
    }
}
