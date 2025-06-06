@extends('layout.template')

@section('content')
<div class="container">
    <h4>Dashboard Mahasiswa</h4>


    {{-- Absensi yang belum diisi --}}
    @if($absensisAktif->isEmpty())
        <p>Tidak ada absensi aktif yang belum diisi.</p>
    @else
        <h3>Absensi Aktif (Belum Diisi):</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Absensi</th>
                    <th>Waktu Mulai</th>
                    <th>Waktu Selesai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($absensisAktif as $absensi)
                <tr>
                    <td>{{ $absensi->judul }}</td>
                    <td>{{ $absensi->waktu_mulai }}</td>
                    <td>{{ $absensi->waktu_selesai }}</td>
                    <td>
                        <a href="/mahasiswa/absensi{{ $absensi->id }}" class="btn btn-primary btn-sm">Absen</a>
                        <a href="/mahasiswa/absensi/{{ $absensi->id }}/izin" class="btn btn-warning btn-sm">Izin</a>
                        <a href="/mahasiswa/absensi/{{ $absensi->id }}/sakit" class="btn btn-danger btn-sm">Sakit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    {{-- Absensi yang sudah diisi --}}
    @if($absensisSudahIsi->isNotEmpty())
        <h3>Absensi yang Sudah Diisi:</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Absensi</th>
                    <th>Status</th>
                    <th>Waktu Absen / Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($absensisSudahIsi as $absensi)
                <tr>
                    <td>{{ $absensi->judul }}</td>
                    <td>
                        @if($absensi->status === 'hadir')
                            Hadir
                        @elseif($absensi->status === 'izin')
                            Izin
                        @elseif($absensi->status === 'sakit')
                            Sakit
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if($absensi->status === 'hadir')
                            {{ $absensi->waktu_absen ?? '-' }}
                        @else
                            {{ $absensi->alasan ?? '-' }}
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</div>
@endsection
