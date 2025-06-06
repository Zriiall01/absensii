@extends('layout.template')

@section('content')
    <!-- Data Jurusan -->
    <div class="col-12 mb-4">
        <div class="card">
            <div class="card-header">
                <h4>Data Jurusan</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Jurusan</th>
                                <th>Kode Jurusan</th> <!-- contoh kolom tambahan -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jurusan as $index => $jrs)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $jrs->nama_jurusan }}</td>
                                    <td>{{ $jrs->jurusan_id ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Kelas -->
    <div class="col-12 mb-4">
        <div class="card">
            <div class="card-header">
                <h4>Data Kelas</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Kelas</th>
                                <th>Angkatan</th>
                                <th>Jurusan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kelas as $index => $kelasItem)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $kelasItem->nama_kelas }}</td>
                                    <td>{{ $kelasItem->angkatan }}</td>
                                    <td>{{ $kelasItem->jurusan->nama_jurusan ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Mata Kuliah -->
    <div class="col-12 mb-4">
        <div class="card">
            <div class="card-header">
                <h4>Data Mata Kuliah</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Mata Kuliah</th>
                                <th>Jurusan</th>
                                <th>SKS</th> <!-- contoh kolom SKS -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($matkul as $index => $m)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $m->nama_matkul }}</td>
                                    <td>{{ $m->jurusan->nama_jurusan ?? '-' }}</td>
                                    <td>{{ $m->sks ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
