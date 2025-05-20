@extends('layout.template')
@section('content')
    <div id="main">
        <div class="page-heading">
            <h3>Data Kelas</h3>
        </div>
        <div class="page-content">
            <section class="row">
                <div class="col-12 col-lg-9">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Kelas</h4>
                                    <a class="btn btn-success" href="/tambah_kelas" role="button">add</a>
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
                                                    <th scope="col">No.</th>
                                                    <th scope="col">Kelas</th>
                                                    <th scope="col">Jurusan</th>
                                                    <th scope="col">angkatan</th>
                                                    <th scope="col">aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($kelas as $item)
                                                    <tr>
                                                        <td>{{ $no++ }}</td>
                                                        <td>{{ $item->nama_kelas }}</td>
                                                        <td>{{ $item->jurusan->nama_jurusan }}</td>
                                                        <td>{{ $item->angkatan }}</td>
                                                        <td>
                                                            <a href="/edit_kelas/{{ $item->kelas_id }}/edit"
                                                                class="badge bg-secondary text-light">Edit</a>
                                                            <a onclick="return confirm('Hapus Data')"
                                                                href="/hapus_kelas/{{ $item->kelas_id }}/hapus"
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
