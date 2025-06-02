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

    <h4>Mahasiswa yang Sudah Absen</h4>
    <table>
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
</body>
</html>
