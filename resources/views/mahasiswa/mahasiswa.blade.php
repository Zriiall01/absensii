@extends('layout.template')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Daftar Mahasiswa</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Mahasiswa</th>
                <th>NIM</th>
                <th>Gender</th>
                <th>Alamat</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Jurusan</th>
                <th>ID User</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mahasiswa as $index => $mhs)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $mhs->nama_mahasiswa }}</td>
                <td>{{ $mhs->npm_mahasiswa }}</td>
                <td>{{ $mhs->gender }}</td>
                <td>{{ $mhs->alamat }}</td>
                <td>{{ $mhs->tempat_lahir }}</td>
                <td>{{ $mhs->tanggal_lahir }}</td>
                <td>{{ $mhs->jurusan->jurusan }}</td>
                <td>{{ $mhs->users }}</td>
                <td>
                    <a onclick="return confirm('Hapus Data')" href="/Hapus_mahasiswa/{{ $mhs->mahasiswa_id }}/hapus" class="badge bg-danger text-light">Hapus</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
