@extends('layout.template')

@section('content')
<div class="container">
    <h2>Edit Mata Kuliah</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                   <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="m-2" method="post" action="{{ route('matkul.update', $matkul->matkul_id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_matkul" class="form-label">Nama Mata Kuliah</label>
            <input type="text" name="nama_matkul" id="nama_matkul" class="form-control" value="{{ old('nama_matkul', $matkul->nama_matkul) }}" required>
        </div>

        <div class="mb-3">
            <label for="jurusan_id" class="form-label">Jurusan</label>
            <select name="jurusan_id" id="jurusan_id" class="form-select" required>
                <option value="">-- Pilih Jurusan --</option>
                @foreach ($jurusan as $item)
                    <option value="{{ $item->jurusan_id }}" {{ old('jurusan_id', $matkul->jurusan_id) == $item->jurusan_id ? 'selected' : '' }}>
                        {{ $item->nama_jurusan }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="angkatan" class="form-label">Angkatan</label>
            <input type="text" name="angkatan" id="angkatan" class="form-control" value="{{ old('angkatan', $angkatan) }}" placeholder="Contoh: 2023" required>
        </div>

        <div class="mb-3">
            <label for="kelas_id" class="form-label">Kelas</label>
            <select name="kelas_id[]" id="kelas_id" class="form-select" multiple size="5" required>
                <!-- Kelas akan di-load otomatis via AJAX -->
            </select>
            <small class="form-text text-muted">Pilih satu atau lebih kelas</small>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    let selectedKelas = {!! json_encode($matkul->kelas->pluck('kelas_id')->toArray()) !!};

    function loadKelas() {
        let jurusanId = $('#jurusan_id').val();
        let angkatan = $('#angkatan').val();

        if (jurusanId && angkatan) {
            $.ajax({
                url: '{{ route("matkul.getKelas") }}',
                method: 'GET',
                data: {
                    jurusan_id: jurusanId,
                    angkatan: angkatan
                },
                success: function(response) {
                    $('#kelas_id').empty();
                    if (response.length > 0) {
                        $.each(response, function(index, kelas) {
                            let selected = selectedKelas.includes(kelas.kelas_id) ? 'selected' : '';
                            $('#kelas_id').append(
                                `<option value="${kelas.kelas_id}" ${selected}>${kelas.nama_kelas} (Angkatan: ${kelas.angkatan})</option>`
                            );
                        });
                    } else {
                        $('#kelas_id').append('<option value="">Tidak ada kelas ditemukan</option>');
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        } else {
            $('#kelas_id').empty();
        }
    }

    $(document).ready(function() {
        $('#jurusan_id, #angkatan').on('change keyup', loadKelas);
        loadKelas(); // Load awal
    });
</script>
@endsection
