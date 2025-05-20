@extends('layout/template')
@section('content')

<div id="main">
    <div class="page-heading">
        <h3>Edit Jurusan</h3>
    </div>

<div class="page-content">
    <section class="row">
<div class="card">
    <div class="card-body">
    <div class="card-header text-center">
      Edit Jurusan
    </div>
  <form class="m-2" method="post" action="">
    @csrf
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Nama Jurusan</label>
      <input type="text" value="{{ $data->nama_jurusan }}" name="nama_jurusan" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
    </div>
  </div>
    </section>
</div>
</div>
    
@endsection