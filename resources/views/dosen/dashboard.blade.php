@extends('layout.template')

@section('content')
<div class="container">
    <h4>Dashboard Dosen</h4>

    @if(!$dosen)
        <div class="alert alert-warning">
            Belum ada data dosen yang diinput oleh akun ini.
        </div>
    @else
        {{-- <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $dosen->nama_dosen }}</h5>
                <p class="card-text">
                    <strong>Email:</strong> {{ $dosen->user->email }} <br>
                    <strong>NIP:</strong> {{ $dosen->nip }} <br>
                    <strong>Jurusan:</strong> {{ $dosen->jurusan->nama_jurusan }} <br>
                    <strong>Mata Kuliah:</strong> {{ $dosen->matkul->nama_matkul }} <br>
                </p>

                <a href="/data_diri/dosen" class="btn btn-primary">
                    Edit Data
                </a>
            </div>
        </div> --}}

        <h5>Kelas yang Diampu:</h5>
        <ul class="list-group">
            @foreach ($dosen->kelas as $kls)
                <li class="list-group-item">
                    {{ $kls->nama_kelas }} ({{ $kls->angkatan }})
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
