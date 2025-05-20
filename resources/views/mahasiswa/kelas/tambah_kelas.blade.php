@extends('layout/template')
@section('content')

<div id="main">
    <div class="page-heading">
        <h3>Tambah Kelas</h3>
    </div>

<div class="page-content">
    <section class="row">
<div class="card">
    <div class="card-body">
    <div class="card-header text-center">
      Tambah Kelas
    </div>
  <form class="m-2" method="post" action="">
    @csrf
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Nama kelas</label>
      <input type="text" name="nama_kelas" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Angkatan</label>
      <input type="text" name="angkatan" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
            <label for="jurusan_id" class="form-label">Jurusan</label>
            <select name="jurusan_id" id="jurusan_id" class="form-select" required>
                <option value="">-- Pilih Jurusan --</option>
                @foreach ($jurusan as $item)
                    <option value="{{ $item->jurusan_id }}" {{ old('jurusan_id') == $item->jurusan_id ? 'selected' : '' }}>
                        {{ $item->nama_jurusan }}
                    </option>
                @endforeach
            </select>
        </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
    </div>
  </div>
    </section>
</div>
</div>
    
@endsection