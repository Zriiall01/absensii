@extends('layout.template')

@section('content')
<div class="container">
    <h4>Dashboard Mahasiswa</h4>

    @if(!$mahasiswa)
        <div class="alert alert-warning">
            Belum ada data mahasiswa yang diinput oleh akun ini.
        </div>
    @else
        <div class="card mb-3">
    <div class="card-body">
        {{-- Tambahkan tampilan foto --}}
        <div class="mb-3 text-center">
            <img src="{{ asset('gambar/'.$mahasiswa->foto) }}" alt="Foto Mahasiswa" class="img-thumbnail" style="max-width: 150px;">
        </div>

        <h5 class="card-title">{{ $mahasiswa->nama_mahasiswa }}</h5>
        <p class="card-text">
            <strong>Email:</strong> {{ $mahasiswa->user->email }} <br>
            <strong>NPM:</strong> {{ $mahasiswa->npm_mahasiswa }} <br>
            <strong>Jurusan:</strong> {{ $mahasiswa->jurusan->nama_jurusan }} <br>
            <strong>Kelas:</strong> {{ $mahasiswa->kelas->nama_kelas }} ({{ $mahasiswa->kelas->angkatan }}) <br>
            <strong>Mata Kuliah:</strong>
            @foreach ($mahasiswa->matkuls as $matkul)
                {{ $matkul->nama_matkul }},
            @endforeach
        </p>

        <a href="/mahasiswa/create" class="btn btn-primary">
            Edit Data
        </a>
    </div>
</div>


        @if($absensisAktif->isEmpty())
        <p>Tidak ada absensi aktif saat ini.</p>
    @else
        <h3>Absensi Aktif:</h3>
        <ul>
            @foreach($absensisAktif as $absensi)
                <li>
                    <strong>{{ $absensi->nama_absen }}</strong> <br>
                    Waktu: {{ $absensi->waktu_mulai }} - {{ $absensi->waktu_selesai }}<br>
                    <a href="/mahasiswa/absensi{{ $absensi->id }}">Detail / Absen</a>
                </li>
            @endforeach
        </ul>
    @endif
    @endif
</div>
@endsection
