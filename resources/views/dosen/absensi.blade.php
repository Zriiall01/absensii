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
            <label for="judul" class="form-label">Judul Absensi:</label>
            <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul') }}" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi:</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control">{{ old('deskripsi') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="waktu_mulai" class="form-label">Waktu Mulai:</label>
            <input type="text" name="waktu_mulai" id="waktu_mulai" class="form-control" required>
            <small class="text-muted">Gunakan format 24 jam.</small>
        </div>

        <div class="mb-3">
            <label for="waktu_selesai" class="form-label">Waktu Selesai:</label>
            <input type="text" name="waktu_selesai" id="waktu_selesai" class="form-control" required>
            <small class="text-muted">Gunakan format 24 jam.</small>
        </div>

        {{-- Tambahkan filter jurusan, matkul, angkatan --}}
        <div class="mb-3">
            <label for="jurusan_id" class="form-label">Jurusan:</label>
            <select name="jurusan_id" id="jurusan_id" class="form-select" required>
                <option value="">-- Pilih Jurusan --</option>
                @foreach ($jurusanList as $j)
                    <option value="{{ $j->jurusan_id }}">{{ $j->nama_jurusan }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="angkatan" class="form-label">Angkatan:</label>
            <input type="number" name="angkatan" id="angkatan" class="form-control" required>
        </div>

        {{-- Dropdown kelas dinamis --}}
        <div class="mb-3">
            <label for="kelas_id" class="form-label">Pilih Kelas:</label>
            <select name="kelas_id" id="kelas_id" class="form-select" required>
                <option value="">-- Pilih Kelas --</option>
                {{-- Data kelas akan diisi otomatis via AJAX --}}
            </select>
        </div>

        {{-- Map untuk lokasi --}}
        <div class="mb-3">
            <label for="lokasi" class="form-label">Lokasi Kampus (klik pada peta untuk memilih lokasi):</label>
            <div id="map" style="height: 300px;"></div>
        </div>

        <div class="mb-3">
            <label for="radius" class="form-label">Radius (dalam meter):</label>
            <input type="number" name="radius" id="radius" class="form-control" value="{{ old('radius', 100) }}" required>
        </div>

        {{-- Hidden input untuk lat/long --}}
        <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', -7.033477) }}">
        <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude', 113.849898) }}">

        <button type="submit" class="btn btn-success">Simpan Absensi</button>
    </form>
</div>

{{-- Leaflet CDN --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

{{-- Flatpickr CDN --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    // Inisialisasi map
    const defaultLat = parseFloat(document.getElementById('latitude').value) || -7.033477;
    const defaultLng = parseFloat(document.getElementById('longitude').value) || 113.849898;
    const map = L.map('map').setView([defaultLat, defaultLng], 16);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '&copy; OpenStreetMap contributors' }).addTo(map);

    let marker = L.marker([defaultLat, defaultLng], { draggable: true }).addTo(map);

    marker.on('dragend', function() {
        const pos = marker.getLatLng();
        document.getElementById('latitude').value = pos.lat;
        document.getElementById('longitude').value = pos.lng;
    });

    map.on('click', function(e) {
        const lat = e.latlng.lat;
        const lng = e.latlng.lng;
        marker.setLatLng([lat, lng]);
        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;
    });

    // Flatpickr dengan default waktu realtime (prioritaskan old input jika ada)
    function parseDate(dateStr) {
        return dateStr ? new Date(dateStr.replace(' ', 'T')) : null;
    }

    flatpickr("#waktu_mulai", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        time_24hr: true,
        defaultDate: parseDate("{{ old('waktu_mulai') }}") || new Date(),
    });

    flatpickr("#waktu_selesai", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        time_24hr: true,
        defaultDate: parseDate("{{ old('waktu_selesai') }}") || new Date(new Date().getTime() + 60*60*1000), // default 1 jam setelah sekarang
    });

    // AJAX untuk load kelas
    document.addEventListener('DOMContentLoaded', function() {
        const jurusanSelect = document.getElementById('jurusan_id');
        const angkatanInput = document.getElementById('angkatan');
        const kelasSelect = document.getElementById('kelas_id');

        function loadKelas() {
            const jurusanId = jurusanSelect.value;
            const angkatan = angkatanInput.value;

            if (jurusanId  && angkatan) {
                fetch(`/get-kelas?jurusan_id=${jurusanId}&angkatan=${angkatan}`)
                    .then(res => res.json())
                    .then(data => {
                        kelasSelect.innerHTML = '<option value="">-- Pilih Kelas --</option>';
                        data.forEach(k => {
                            let opt = document.createElement('option');
                            opt.value = k.kelas_id;
                            opt.text = `${k.nama_kelas} (${k.angkatan})`;
                            kelasSelect.appendChild(opt);
                        });
                    });
            }
        }

        jurusanSelect.addEventListener('change', loadKelas);
        angkatanInput.addEventListener('input', loadKelas);
    });
</script>
@endsection
