@extends('layout.template')

@section('content')
<div class="container">
    <h2>Detail Absensi: {{ $absensi->judul }}</h2>
    <p><strong>Deskripsi:</strong> {{ $absensi->deskripsi }}</p>
    <p><strong>Waktu Mulai:</strong> {{ $absensi->waktu_mulai }}</p>
    <p><strong>Waktu Selesai:</strong> {{ $absensi->waktu_selesai }}</p>

    {{-- Tombol Download --}}
    <div class="mt-3">
        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#downloadModal">
            Download
        </button>
    </div>

    {{-- Modal Download --}}
    <div class="modal fade" id="downloadModal" tabindex="-1" aria-labelledby="downloadModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="downloadModalLabel">Pilih Format Download</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>
          <div class="modal-body text-center">
            <a href="{{ route('absensi.download', ['id' => $absensi->id, 'format' => 'pdf']) }}" class="btn btn-danger m-2">
                <i class="bi bi-file-earmark-pdf"></i> PDF
            </a>
            <a href="{{ route('absensi.download', ['id' => $absensi->id, 'format' => 'excel']) }}" class="btn btn-success m-2">
                <i class="bi bi-file-earmark-excel"></i> Excel
            </a>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          </div>
        </div>
      </div>
    </div>

    {{-- Data Hadir --}}
    <h4 class="mt-4">Mahasiswa Hadir</h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nama Mahasiswa</th>
                <th>Waktu Absen</th>
                <th>Lokasi (Lat, Long)</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($absensi->mahasiswaAbsensi as $hadir)
            <tr>
                <td>{{ $hadir->mahasiswa->name }}</td>
                <td>{{ $hadir->waktu_absen }}</td>
                <td>{{ $hadir->latitude }}, {{ $hadir->longitude }}</td>
                <td>Hadir</td>
            </tr>
        @empty
            <tr>
                <td colspan="4">Belum ada mahasiswa yang hadir.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{-- Data Izin --}}
    <h4 class="mt-4">Mahasiswa Izin</h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nama Mahasiswa</th>
                <th>Alasan</th>
                <th>Foto Surat</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($absensi->izinMahasiswa as $izin)
            <tr>
                <td>{{ optional($izin->mahasiswa)->name ?? '-' }}</td>
                <td>{{ $izin->alasan }}</td>
                <td>
                    @if ($izin->foto_surat)
                        <a href="{{ asset('gambar/' . $izin->foto_surat) }}" target="_blank">Lihat Surat</a>
                    @else
                        Tidak ada
                    @endif
                </td>
                <td>Izin</td>
            </tr>
        @empty
            <tr>
                <td colspan="4">Tidak ada data izin.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{-- Data Sakit --}}
    <h4 class="mt-4">Mahasiswa Sakit</h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nama Mahasiswa</th>
                <th>Alasan</th>
                <th>Foto Surat</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($absensi->sakitMahasiswa as $sakit)
            <tr>
                <td>{{ optional($sakit->mahasiswa)->name ?? '-' }}</td>
                <td>{{ $sakit->alasan }}</td>
                <td>
                    @if ($sakit->foto_surat)
                        <a href="{{ asset('gambar/' . $sakit->foto_surat) }}" target="_blank">Lihat Surat</a>
                    @else
                        Tidak ada
                    @endif
                </td>
                <td>Sakit</td>
            </tr>
        @empty
            <tr>
                <td colspan="4">Tidak ada data sakit.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <a href="{{ route('absensi.index') }}" class="btn btn-secondary btn-sm mt-3">Kembali</a>
</div>

{{-- Tambahkan Bootstrap & icon Bootstrap kalau belum ada --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
