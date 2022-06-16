@extends('template.main')
@section('content')
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Data Jurusan</li>
    </ol>
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card my-6   ">
                <div class="card-body">
                    <h2>{{ $jurusan->jurusan }}</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jurusan</th>
                                <th>Kelas</th>
                                <th>Angkatan</th>
                                <th>detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswa as $s)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $s->nama }}</td>
                                    <td>{{ $jurusan->jurusan }}</td>
                                    <td>{{ $s->kelas->kelas }}</td>
                                    <td>{{ $s->kelas->tahun_ajaran }}</td>
                                    <td>
                                        <a href="/tampilSiswa/{{ $s->id }}" class="btn btn-primary">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
        </div>
    </div>

@endsection
