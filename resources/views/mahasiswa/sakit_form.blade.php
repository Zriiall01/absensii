@extends('layout.template')

@section('content')
<div class="container">
    <h4>Sakit - {{ $absensi->judul }}</h4>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('mahasiswa.absensi.sakit.submit', $absensi->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="alasan" class="form-label">Alasan sakit:</label>
            <textarea name="alasan" id="alasan" class="form-control" required>{{ old('alasan') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="foto_surat" class="form-label">Upload Foto Surat (opsional):</label>
            <input 
                type="file" 
                name="foto_surat" 
                id="foto_surat" 
                class="form-control" 
                accept="image/*" 
                capture="environment">
            <small class="text-muted">Gunakan kamera atau pilih file gambar dari perangkat.</small>
        </div>

        <button type="submit" class="btn btn-primary">Kirim Izin</button>
        <a href="" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
