@extends('layout.template')
@section('content')
    <div id="main">
        <div class="page-heading">
            <h3>Data Matkul</h3>
        </div>
        <div class="page-content">
            <section class="row">
                <div class="col-12 col-lg-9">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Mata Kuliah</h4>
                                    <a class="btn btn-success" href="/matkul/create" role="button">add</a>
                                </div>
                                @if (session('success'))
                                    <div style="color: green; border: 1px solid green; padding: 10px; margin-bottom: 10px;">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div style="color: red; border: 1px solid red; padding: 10px; margin-bottom: 10px;">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0">
    <thead>
        <tr>
            <th>No.</th>
            <th>Mata Kuliah</th>
            <th>Jurusan</th>
            <th>Kelas & Angkatan</th>
            <th>sks</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1; @endphp
        @foreach ($matkuls as $matkul)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $matkul['nama_matkul'] }}</td>
                <td>{{ $matkul['sks'] }}</td>
                <td>{{ $matkul['jurusan'] }}</td>
                <td>
                    @foreach ($matkul['kelas'] as $kelas)
                        <span class="badge bg-info text-dark">{{ $kelas['nama_kelas'] }} ({{ $kelas['angkatan'] }})</span>
                    @endforeach
                </td>
                
                <td>
                    <a href="/matkul/{{ $matkul['nama_matkul'] }}/edit"
                        class="badge bg-warning text-dark">Edit</a>
                    <a href="/matkul/{{ $matkul['nama_matkul'] }}/hapus"
                        onclick="return confirm('Yakin ingin menghapus semua matkul ini?')"
                        class="badge bg-danger text-light">Hapus</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    @endsection
