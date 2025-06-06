@extends('layout.template')

@section('content')
<div class="container">
    <h2>Daftar Absensi yang Telah Dibuat</h2>

    {{-- Filter tanggal --}}
    <form method="GET" action="{{ route('absensi.index') }}" class="mb-3">
        <label for="tanggal">Filter Tanggal:</label>
        <input type="date" name="tanggal" id="tanggal" value="{{ request('tanggal') }}" class="form-control w-25 d-inline-block">
        <button type="submit" class="btn btn-secondary btn-sm">Filter</button>
    </form>

    {{-- Hitung total hadir, izin, sakit --}}


    @if (session('success'))
        <div class="alert alert-success mt-2">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-3">
        <a href="{{ route('absensi.create') }}" class="btn btn-primary btn-sm">+ Tambah Absensi</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Waktu Mulai</th>
                <th>Waktu Selesai</th>
                <th>Jumlah Mahasiswa Absen</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($absensis as $absen)
                <tr>
                    <td>{{ $absen->judul }}</td>
                    <td>{{ $absen->deskripsi }}</td>
                    <td>{{ $absen->waktu_mulai }}</td>
                    <td>{{ $absen->waktu_selesai }}</td>
                    <td>
    {{ $absen->mahasiswaAbsensi->count() + $absen->izinMahasiswa->count() + $absen->sakitMahasiswa->count() }}
</td>

                    <td>
                        <a href="{{ route('absensi.show', $absen->id) }}" class="btn btn-info btn-sm">Detail</a>

                        <form action="{{ route('absensi.destroy', $absen->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin mau hapus absensi ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Tidak ada absensi ditemukan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
