<!DOCTYPE html>
<html>
<head>
    <title>Absensi {{ $absensi->judul }}</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h2>Absensi: {{ $absensi->judul }}</h2>
    <p><strong>Deskripsi:</strong> {{ $absensi->deskripsi }}</p>
    <p><strong>Waktu Mulai:</strong> {{ $absensi->waktu_mulai }}</p>
    <p><strong>Waktu Selesai:</strong> {{ $absensi->waktu_selesai }}</p>

    <h4>Rekapitulasi Kehadiran Mahasiswa</h4>
<table>
    <thead>
        <tr>
            <th>Nama Mahasiswa</th>
            <th>Waktu / Keterangan</th>
            <th>Latitude</th>
            <th>Longitude</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($absensi->mahasiswaAbsensi ?? [] as $mahasiswaAbsen)
            <tr>
                <td>{{ optional($mahasiswaAbsen->mahasiswa)->name ?? '-' }}</td>
                <td>{{ $mahasiswaAbsen->waktu_absen }}</td>
                <td>{{ $mahasiswaAbsen->latitude }}</td>
                <td>{{ $mahasiswaAbsen->longitude }}</td>
                <td>Hadir</td>
            </tr>
        @empty
            <tr>
                <td colspan="5">Belum ada mahasiswa yang hadir.</td>
            </tr>
        @endforelse

        @foreach ($absensi->izinMahasiswa ?? [] as $izin)
            <tr>
                <td>{{ optional($izin->mahasiswa)->name ?? '-' }}</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>Izin</td>
            </tr>
        @endforeach

        @foreach ($absensi->sakitMahasiswa ?? [] as $sakit)
            <tr>
                <td>{{ optional($sakit->mahasiswa)->name ?? '-' }}</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>Sakit</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
