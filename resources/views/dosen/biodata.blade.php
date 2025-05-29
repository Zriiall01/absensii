@extends('layout.template')

@section('content')
<div class="container-fluid py-4">
    <!-- Form Data Diri Dosen -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Form Data Diri Dosen</h4>
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Nama Dosen -->
                        <div class="form-group">
                            <label for="nama_dosen">Nama Dosen</label>
                            <input type="text" name="nama_dosen" id="nama_dosen" class="form-control" placeholder="Masukkan nama dosen" value="{{ old('nama_dosen', $dosen->nama_dosen ?? '') }}" required>
                        </div>

                        <!-- NIP -->
                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="text" name="nip" id="nip" class="form-control" placeholder="Masukkan NIP" value="{{ old('nip', $dosen->nip ?? '') }}" required>
                        </div>

                        <!-- Jurusan -->
                        <div class="form-group">
                            <label for="jurusan_id">Jurusan</label>
                            <select name="jurusan_id" id="jurusan_id" class="form-control" required>
                                <option value="" disabled selected>Pilih Jurusan</option>
                                @foreach($jurusan as $jrs)
                                    <option value="{{ $jrs->jurusan_id }}" {{ (isset($dosen) && $dosen->jurusan_id == $jrs->jurusan_id) ? 'selected' : '' }}>
                                        {{ $jrs->jurusan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- ID User -->
                        <input type="hidden" name="users" value="{{ auth()->id() }}">

                        <!-- Tombol Submit -->
                        <button type="submit" class="btn btn-primary">
                            {{ isset($dosen) ? 'Simpan Edit' : 'Simpan Data' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('upload').src = e.target.result;
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
