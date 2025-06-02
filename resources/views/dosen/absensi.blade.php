@extends('layout.template')

@section('content')
<div class="container">
    <h2>Buat Absensi Baru</h2>

    {{-- Notifikasi error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('absensi.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="judul">Judul Absensi:</label>
            <input type="text" name="judul" id="judul" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi">Deskripsi:</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="waktu_mulai">Waktu Mulai:</label>
            <input type="datetime-local" name="waktu_mulai" id="waktu_mulai" class="form-control" required>
            <small class="text-muted">Gunakan format 24 jam. AM = 00:00–11:59, PM = 12:00–23:59.</small>
        </div>

        <div class="mb-3">
            <label for="waktu_selesai">Waktu Selesai:</label>
            <input type="datetime-local" name="waktu_selesai" id="waktu_selesai" class="form-control" required>
            <small class="text-muted">Gunakan format 24 jam. AM = 00:00–11:59, PM = 12:00–23:59.</small>
        </div>

        {{-- Map untuk lokasi --}}
        <div class="mb-3">
            <label for="lokasi">Lokasi Kampus (klik pada peta untuk memilih lokasi):</label>
            <div id="map" style="height: 300px;"></div>
        </div>

        <div class="mb-3">
            <label for="radius">Radius (dalam meter):</label>
            <input type="number" name="radius" id="radius" class="form-control" value="100" required>
        </div>

        {{-- Hidden input untuk lat/long --}}
        <input type="hidden" name="latitude" id="latitude">
        <input type="hidden" name="longitude" id="longitude">

        <button type="submit" class="btn btn-success">Simpan Absensi</button>
    </form>
</div>

{{-- Leaflet CDN --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    // Koordinat default di Kampus UNIBA Bahaudin Mudhary Madura
    const defaultLat = -7.033477;
    const defaultLng = 113.849898;

    // Inisialisasi map
    const map = L.map('map').setView([defaultLat, defaultLng], 16);

    // Tambahkan tile layer (OpenStreetMap)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Tambahkan marker draggable
    let marker = L.marker([defaultLat, defaultLng], {draggable: true}).addTo(map);

    // Set hidden input default
    document.getElementById('latitude').value = defaultLat;
    document.getElementById('longitude').value = defaultLng;

    // Update lat/lng kalau marker digeser
    marker.on('dragend', function(e) {
        const position = marker.getLatLng();
        document.getElementById('latitude').value = position.lat;
        document.getElementById('longitude').value = position.lng;
    });

    // Update marker & input kalau peta diklik
    map.on('click', function(e) {
        const lat = e.latlng.lat;
        const lng = e.latlng.lng;
        marker.setLatLng([lat, lng]);
        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;
    });
</script>

@endsection
