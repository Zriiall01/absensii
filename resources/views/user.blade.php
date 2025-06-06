@extends('layout.template')
@section('content')
<div id="main">
    <header class="mb-3">
        <div class="page-heading">
            <h3>Data User</h3>
        </div>
    </header>

    <div class="page-content">
        <section class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header text-center">
                                <h4>Data User</h4>
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

                            {{-- Filter --}}
                            <div class="mb-3 mt-3 ms-3">
                                <form action="" method="GET" class="form-inline">
                                    <label for="role" class="me-2">Filter Role:</label>
                                    <select name="role" id="role" class="form-select me-2" style="width: 200px; display: inline-block;">
                                        <option value="">-- Semua --</option>
                                        <option value="dosen" {{ request('role') == 'dosen' ? 'selected' : '' }}>Dosen</option>
                                        <option value="mahasiswa" {{ request('role') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                                </form>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Nama User</th>
                                                <th>Email</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($user->isEmpty())
                                                <tr>
                                                    <td colspan="4" class="text-center">Tidak ada data</td>
                                                </tr>
                                            @else
                                                @foreach ($user as $index)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $index->name }}</td>
                                                        <td>{{ $index->email }}</td>
                                                        <td>
                                                            <a href="/delete_user/{{ $index->id }}"
                                                               class="badge bg-danger text-light"
                                                               onclick="return confirm('Hapus Data?')">Hapus User</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
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
</div>
@endsection
