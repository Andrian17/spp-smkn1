@extends('template.main')
@section('title', $title)
@section('content')
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        {{-- <li class="breadcrumb-item active">Data Jurusan</li> --}}
    </ol>
    <div class="row">
        <div class="col-lg-10 mx-auto">
            {{-- @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif --}}
            <!-- Button trigger modal -->
            {{-- <button type="button" class="btn btn-outline-primary btn-sm m-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fa-solid fa-pen-to-square"></i> edit jurusan
            </button> --}}
            <div class="card my-6">
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
                                    <td>{{ $s->angkatan }}</td>
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



    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/jurusan/{{ $jurusan->id }}" method="POST">
                    @method("put")
                    @csrf
                    <div class="form-floating">
                        <input type="text" class="form-control" id="jurusan" placeholder="jurusan" value="{{ $jurusan->jurusan }}" name="jurusan">
                        <label for="jurusan">Jurusan</label>
                    </div>
                    <div class="d-flex ">
                        <button type="submit" class="btn btn-primary my-2 ">Ubah</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>

@endsection
