@extends('layout.template')

@section('content')
<div class="container">
    <h2>Detail Absensi: {{ $absensi->judul }}</h2>
    <p><strong>Deskripsi:</strong> {{ $absensi->deskripsi }}</p>
    <p><strong>Waktu Mulai:</strong> {{ $absensi->waktu_mulai }}</p>
    <p><strong>Waktu Selesai:</strong> {{ $absensi->waktu_selesai }}</p>
    <div class="mt-3">
    <form action="{{ route('absensi.download', $absensi->id) }}" method="GET">
        <label for="format">Download sebagai:</label>
        <select name="format" id="format" class="form-select w-auto d-inline-block">
            <option value="pdf">PDF</option>
            <option value="excel">Excel</option>
        </select>
        <button type="submit" class="btn btn-primary btn-sm">Download</button>
    </form>
</div>


    <h4 class="mt-4">Mahasiswa yang Sudah Absen</h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nama Mahasiswa</th>
                <th>Waktu Absen</th>
                <th>Lokasi (Lat, Long)</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($absensi->mahasiswaAbsensi as $mahasiswaAbsen)
            <tr>
                <td>{{ $mahasiswaAbsen->mahasiswa->name }}</td>
                <td>{{ $mahasiswaAbsen->waktu_absen }}</td>
                <td>{{ $mahasiswaAbsen->latitude }}, {{ $mahasiswaAbsen->longitude }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3">Belum ada mahasiswa yang absen.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <a href="{{ route('absensi.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
</div>
@endsection
