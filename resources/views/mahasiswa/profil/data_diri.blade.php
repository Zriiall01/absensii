@extends('layout.template')

@section('content')
<div class="container-fluid py-4">
    <!-- Form Data Diri Mahasiswa -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Form Data Diri Mahasiswa</h4>
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mt-3">
                            <label for="foto_project" class="label">Foto (16:9)</label>
                            <div class="form-control h-100 text-center position-relative p-4 p-lg-5">
                                <div class="product-upload">
                                    <label for="file-upload" class="file-upload mb-0">
                                        <span class="d-inline-block wh-110 bg-body-bg rounded-10 position-relative">
                                            <img id="upload" src="{{ isset($mahasiswa) && $mahasiswa->foto ? asset('gambar/' . $mahasiswa->foto) : asset('admin/assets/images/upload.png') }}" alt="your image" style="width: 300px; height: auto;" />
                                        </span>
                                    </label>
                                    <input id="file-upload" name="foto" onchange="readURL(this);" type="file" accept="image/*" hidden>
                                </div>
                            </div>
                        </div>

                        <!-- Nama Mahasiswa -->
                        <div class="form-group">
                            <label for="nama_mahasiswa">Nama Mahasiswa</label>
                            <input type="text" name="nama_mahasiswa" id="nama_mahasiswa" class="form-control" placeholder="Masukkan nama mahasiswa" value="{{ old('nama_mahasiswa', $mahasiswa->nama_mahasiswa ?? '') }}" required>
                        </div>

                        <!-- NPM -->
                        <div class="form-group">
                            <label for="npm_mahasiswa">NPM</label>
                            <input type="text" name="npm_mahasiswa" id="npm_mahasiswa" class="form-control" placeholder="Masukkan NPM" value="{{ old('npm_mahasiswa', $mahasiswa->npm_mahasiswa ?? '') }}" required>
                        </div>

                        <!-- Jurusan -->
                        <div class="form-group">
                            <label for="jurusan_id">Jurusan</label>
                            <select name="jurusan_id" id="jurusan_id" class="form-control" required>
                                <option value="" disabled selected>Pilih Jurusan</option>
                                @foreach($jurusan as $jrs)
                                    <option value="{{ $jrs->jurusan_id }}" {{ (isset($mahasiswa) && $mahasiswa->jurusan_id == $jrs->jurusan_id) ? 'selected' : '' }}>
                                        {{ $jrs->jurusan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Gender:</label>
                        </div>
                        <div class="mb-3">
                            <input type="radio" id="gender_L" name="gender" value="L" {{ (isset($mahasiswa) && $mahasiswa->gender == 'L') ? 'checked' : '' }}>
                            <label for="gender_L">Laki-laki</label>
                            <input type="radio" id="gender_P" name="gender" value="P" {{ (isset($mahasiswa) && $mahasiswa->gender == 'P') ? 'checked' : '' }}>
                            <label for="gender_P">Perempuan</label>
                        </div>

                        <!-- Alamat -->
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" id="alamat" class="form-control" placeholder="Masukkan alamat" rows="3" required>{{ old('alamat', $mahasiswa->alamat ?? '') }}</textarea>
                        </div>

                        <!-- Tempat Lahir -->
                        <div class="form-group">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" placeholder="Masukkan tempat lahir" value="{{ old('tempat_lahir', $mahasiswa->tempat_lahir ?? '') }}" required>
                        </div>

                        <!-- Tanggal Lahir -->
                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $mahasiswa->tanggal_lahir ?? '') }}" required>
                        </div>

                        <!-- ID User -->
                        <input type="hidden" name="users" value="{{ auth()->id() }}">

                        <!-- Tombol Submit -->
                        <button type="submit" class="btn btn-primary">
                            {{ isset($mahasiswa) ? 'Simpan Edit' : 'Simpan Data' }}
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
                // Perbarui atribut src dengan data URL dari file
                document.getElementById('upload').src = e.target.result;
            };

            // Baca file yang diunggah
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
