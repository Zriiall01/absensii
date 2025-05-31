@extends('layout.template')
@section('content')
<div class="container">
    <h4>{{ isset($dosen) ? 'Edit' : 'Form Input' }} Dosen</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('dosen.store_or_update') }}">
        @csrf
        @if(isset($dosen))
            @method('PUT')
        @endif

        <div class="form-group mb-3">
            <label>Nama Dosen</label>
            <input type="text" name="nama_dosen" class="form-control" 
                value="{{ isset($dosen) ? $dosen->nama_dosen : old('nama_dosen') }}" required>
        </div>

        <div class="form-group mb-3">
            <label>NIP</label>
            <input type="text" name="nip" class="form-control" 
                value="{{ isset($dosen) ? $dosen->nip : old('nip') }}" required>
        </div>

        <div class="form-group mb-3">
            <label>Jurusan</label>
            <select name="jurusan_id" id="jurusan" class="form-control" required>
                <option value="">Pilih Jurusan</option>
                @foreach ($jurusan as $jrs)
                    <option value="{{ $jrs->jurusan_id }}" 
                        {{ (isset($dosen) && $dosen->jurusan_id == $jrs->jurusan_id) ? 'selected' : '' }}>
                        {{ $jrs->nama_jurusan }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label>Angkatan</label>
            <input type="number" name="angkatan" id="angkatan" class="form-control"
                value="{{ old('angkatan') }}" required>
        </div>

        <div class="form-group mb-3">
            <label>Mata Kuliah</label>
            <select name="matkul_id" id="matkul" class="form-control" required>
                <option value="">Pilih Mata Kuliah</option>
                @foreach ($matkul as $mk)
                    @php
                        $first = \App\Models\MatkulModel::where('nama_matkul', $mk->nama_matkul)->first();
                    @endphp
                    <option value="{{ $first->matkul_id }}" 
                        {{ (isset($dosen) && $dosen->matkul_id == $first->matkul_id) ? 'selected' : '' }}>
                        {{ $mk->nama_matkul }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label>Kelas</label>
            <select name="kelas_id[]" id="kelas" class="form-control" multiple required>
                <!-- AJAX akan isi opsi di sini -->
                @if(isset($dosen))
                    @foreach ($dosen->kelas as $kls)
                        <option value="{{ $kls->kelas_id }}" selected>
                            {{ $kls->nama_kelas }} ({{ $kls->angkatan }})
                        </option>
                    @endforeach
                @endif
            </select>
        </div>

        <button type="submit" class="btn btn-primary">
            {{ isset($dosen) ? 'Update' : 'Simpan' }}
        </button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const jurusan = document.getElementById('jurusan');
        const matkul = document.getElementById('matkul');
        const angkatan = document.getElementById('angkatan');
        const kelas = document.getElementById('kelas');

        function loadKelas() {
            const jurusanId = jurusan.value;
            const matkulId = matkul.value;
            const angkatanVal = angkatan.value;

            if (jurusanId && matkulId && angkatanVal) {
                fetch(`/get-kelas?jurusan_id=${jurusanId}&matkul_id=${matkulId}&angkatan=${angkatanVal}`)
                    .then(res => res.json())
                    .then(data => {
                        kelas.innerHTML = '';
                        data.forEach(k => {
                            let opt = document.createElement('option');
                            opt.value = k.kelas_id;
                            opt.text = `${k.nama_kelas} (${k.angkatan})`;
                            kelas.appendChild(opt);
                        });
                    });
            }
        }

        jurusan.addEventListener('change', loadKelas);
        matkul.addEventListener('change', loadKelas);
        angkatan.addEventListener('input', loadKelas);

        @if(isset($dosen))
            // Trigger load kelas awal saat edit
            setTimeout(loadKelas, 300);
        @endif
    });
</script>
@endsection
