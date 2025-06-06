@extends('layout.template')

@section('content')
<div class="container">
    <h2>Absen: {{ $absensi->judul }}</h2>
    <p>Deskripsi: {{ $absensi->deskripsi }}</p>
    <p>Waktu Mulai: {{ \Carbon\Carbon::parse($absensi->waktu_mulai)->format('d M Y H:i') }}</p>
    <p>Waktu Selesai: {{ \Carbon\Carbon::parse($absensi->waktu_selesai)->format('d M Y H:i') }}</p>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('mahasiswa.absensi.store', $absensi->id) }}">
        @csrf

        <div class="mb-3">
            <label for="latitude">Latitude Kamu</label>
            <input 
                type="text" name="latitude" id="latitude" class="form-control" required readonly value="{{ old('latitude') }}" placeholder="Latitude akan terisi otomatis">
        </div>

        <div class="mb-3">
            <label for="longitude">Longitude Kamu</label>
            <input 
                type="text" name="longitude" id="longitude" class="form-control" required readonly value="{{ old('longitude') }}" placeholder="Longitude akan terisi otomatis">
        </div>

        <button type="submit" class="btn btn-success">Absen Sekarang</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const latInput = document.getElementById('latitude');
    const lngInput = document.getElementById('longitude');
    const statusEl = document.createElement('small');
    statusEl.style.color = 'gray';
    latInput.parentNode.appendChild(statusEl);

    if (navigator.geolocation) {
        statusEl.textContent = 'Mencari lokasi...';

        navigator.geolocation.getCurrentPosition(
            position => {
                latInput.value = position.coords.latitude.toFixed(6);
                lngInput.value = position.coords.longitude.toFixed(6);
                statusEl.textContent = 'Lokasi berhasil diambil';
            },
            error => {
                statusEl.textContent = 'Gagal mendapatkan lokasi: ' + error.message;
            },
            {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 0
            }
        );
    } else {
        statusEl.textContent = 'Geolocation tidak didukung oleh browser kamu';
    }
});
</script>

@endsection