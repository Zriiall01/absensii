@extends('layout.template')

@section('content')
<div class="container">
    <h4>{{ $mahasiswa ? 'Edit' : 'Tambah' }} Data Mahasiswa</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ url('/mahasiswa/create') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Foto -->
        <div class="form-group mb-3">
            <label>Foto</label>
            @if ($mahasiswa && $mahasiswa->foto)
                <div class="mb-2">
                    <img src="{{ asset('gambar/' . $mahasiswa->foto) }}" width="100" alt="Foto Mahasiswa">
                </div>
            @endif
            <input type="file" name="foto" class="form-control">
            @error('foto') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Nama -->
        <div class="form-group mb-3">
            <label>Nama Mahasiswa</label>
            <input type="text" name="nama_mahasiswa" class="form-control" 
                   value="{{ old('nama_mahasiswa', $mahasiswa->nama_mahasiswa ?? '') }}">
            @error('nama_mahasiswa') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Gender -->
        <div class="form-group mb-3">
            <label>Gender</label>
            <select name="gender" class="form-control">
                <option value="L" {{ (old('gender', $mahasiswa->gender ?? '') == 'L') ? 'selected' : '' }}>Laki-laki</option>
                <option value="P" {{ (old('gender', $mahasiswa->gender ?? '') == 'P') ? 'selected' : '' }}>Perempuan</option>
            </select>
            @error('gender') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Alamat -->
        <div class="form-group mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control">{{ old('alamat', $mahasiswa->alamat ?? '') }}</textarea>
            @error('alamat') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Tempat Lahir -->
        <div class="form-group mb-3">
            <label>Tempat Lahir</label>
            <input type="text" name="tempat_lahir" class="form-control" 
                   value="{{ old('tempat_lahir', $mahasiswa->tempat_lahir ?? '') }}">
            @error('tempat_lahir') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Tanggal Lahir -->
        <div class="form-group mb-3">
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control" 
                   value="{{ old('tanggal_lahir', $mahasiswa->tanggal_lahir ?? '') }}">
            @error('tanggal_lahir') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- NPM -->
        <div class="form-group mb-3">
            <label>NPM</label>
            <input type="text" name="npm_mahasiswa" class="form-control" 
                   value="{{ old('npm_mahasiswa', $mahasiswa->npm_mahasiswa ?? '') }}">
            @error('npm_mahasiswa') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Jurusan -->
        <div class="form-group mb-3">
            <label>Jurusan</label>
            <select name="jurusan_id" id="jurusan_id" class="form-control">
                <option value="">-- Pilih Jurusan --</option>
                @foreach ($jurusans as $jurusan)
                    <option value="{{ $jurusan->jurusan_id }}" 
                        {{ (old('jurusan_id', $mahasiswa->jurusan_id ?? '') == $jurusan->jurusan_id) ? 'selected' : '' }}>
                        {{ $jurusan->nama_jurusan }}
                    </option>
                @endforeach
            </select>
            @error('jurusan_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Kelas -->
        <div class="form-group mb-3">
            <label>Kelas</label>
            <select name="kelas_id" id="kelas_id" class="form-control">
                <option value="">-- Pilih Kelas --</option>
                @if ($kelasList ?? false)
                    @foreach ($kelasList as $kelas)
                        <option value="{{ $kelas->kelas_id }}" 
                            {{ (old('kelas_id', $mahasiswa->kelas_id ?? '') == $kelas->kelas_id) ? 'selected' : '' }}>
                            {{ $kelas->nama_kelas }}
                        </option>
                    @endforeach
                @endif
            </select>
            @error('kelas_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Mata Kuliah -->
        <div class="form-group mb-3">
            <label>Mata Kuliah</label>
            <select name="matkuls[]" id="matkuls" class="form-control" multiple>
                @if ($matkulList ?? false)
                    @foreach ($matkulList as $matkul)
                        <option value="{{ $matkul->matkul_id }}" 
                            {{ (collect(old('matkuls', $mahasiswa->matkuls->pluck('matkul_id') ?? []))->contains($matkul->matkul_id)) ? 'selected' : '' }}>
                            {{ $matkul->nama_matkul }}
                        </option>
                    @endforeach
                @endif
            </select>
            @error('matkuls') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<!-- Tambahkan CSS Flatpickr -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<!-- Script jQuery & AJAX & Flatpickr -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
$(document).ready(function() {
    // Dynamic Dropdown
    $('#jurusan_id').on('change', function() {
        var jurusanId = $(this).val();
        $('#kelas_id').empty().append('<option value="">-- Pilih Kelas --</option>');
        $('#matkuls').empty();

        if (jurusanId) {
            $.get('/getKelas/' + jurusanId, function(data) {
                $.each(data, function(key, value) {
                    $('#kelas_id').append('<option value="' + value.kelas_id + '">' + value.nama_kelas + '</option>');
                });
            });
        }
    });

    $('#kelas_id').on('change', function() {
        var kelasId = $(this).val();
        $('#matkuls').empty();

        if (kelasId) {
            $.get('/getMatkul/' + kelasId, function(data) {
                $.each(data, function(key, value) {
                    $('#matkuls').append('<option value="' + value.matkul_id + '">' + value.nama_matkul + '</option>');
                });
            });
        }
    });

    // Inisialisasi Flatpickr untuk input tanggal lahir
    flatpickr("input[name='tanggal_lahir']", {
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "d-m-Y",
        allowInput: true
    });
});
</script>
@endsection
