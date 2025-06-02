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
                            
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">No.</th>
                                                <th scope="col">Nama User</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($user->isEmpty())
                                                <tr>
                                                    <td colspan="11" class="text-center">Tidak ada data</td>
                                                </tr>
                                            @else
                                                @foreach ($user as $index)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td class="">{{ $index->name }}</td>
                                                        <td class="">{{ $index->email }}</td>
                                                        <td>
                                                            <a href="/delete_user/{{ $index->id }}"
                                                                class="badge bg-danger text-light"
                                                                onclick="return confirm('Hapus Data?')">Hapus
                                                                User</a>
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