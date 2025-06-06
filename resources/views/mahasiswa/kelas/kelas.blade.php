@extends('layout.template')
@section('content')
<div id="main">
    <div class="page-heading">
        <h3>Data Kelas</h3>

        {{-- Tombol Filter Jurusan --}}
        <div class="mb-3">
            <a href="{{ route('kelas.index') }}" 
               class="btn btn-outline-primary {{ is_null($selectedJurusan) ? 'active' : '' }}">
                Semua Jurusan
            </a>
            @foreach ($jurusanList as $jurusan)
                <a href="{{ route('kelas.index', ['jurusan_id' => $jurusan->jurusan_id]) }}"
                   class="btn btn-outline-primary {{ $selectedJurusan == $jurusan->jurusan_id ? 'active' : '' }}">
                   {{ $jurusan->nama_jurusan }}
                </a>
            @endforeach
        </div>
    </div>

    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-9">
                <div class="card">
                    <div class="card-header">
                        <h4>Kelas</h4>
                        <a class="btn btn-success" href="/tambah_kelas" role="button">Add</a>
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
                                        <th>Kelas</th>
                                        <th>Jurusan</th>
                                        <th>Angkatan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($kelas as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->nama_kelas }}</td>
                                            <td>{{ $item->jurusan->nama_jurusan }}</td>
                                            <td>{{ $item->angkatan }}</td>
                                            <td>
                                                <a href="/edit_kelas/{{ $item->kelas_id }}/edit"
                                                    class="badge bg-secondary text-light">Edit</a>
                                                <a onclick="return confirm('Hapus Data?')"
                                                    href="/hapus_kelas/{{ $item->kelas_id }}/hapus"
                                                    class="badge bg-danger text-light">Hapus</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak ada data kelas.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
</div>
@endsection
