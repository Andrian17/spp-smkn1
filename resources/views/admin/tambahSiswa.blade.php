@extends('template.main')
@section('title', $title)
@section('content')
<div class="container">
    <h3 class="mt-4">Tambah Siswa</h3>
    <div class="row">
        <div class="col">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session()->has('pesan'))
                {!! session('pesan') !!}
            @endif
            <form method="POST" action="{{ route('admin.store') }}" enctype="multipart/form-data" class="mx-auto">
                @csrf
                <div class="d-flex my-3">
                    <div class="form-floating w-50 p-2">
                        <input type="text" class="form-control form-control-lg" id="nama" name="nama" placeholder="Nama" required>
                        <label for="nama">Nama</label>
                    </div>
                    <div class="form-floating w-50 p-2">
                        <input type="text" class="form-control form-control-lg" id="nis" name="nis" placeholder="nis" required>
                        <label for="nis">NIS</label>
                    </div>
                </div>
                <div class="d-flex my-3">
                    <div class="form-floating w-50 p-2">
                        <select class="form-select" name="jenis_kelamin" aria-label="Jenis Kelamin">
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                    </div>
                    <div class="form-floating w-50 p-2">
                        <input type="date" class="form-control form-control-lg" id="tanggal_lahir" name="tanggal_lahir" placeholder="tanggal lahir">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                    </div>
                </div>
                <div class="d-flex my-3">
                    <div class="form-floating flex-fill p-2">
                        <select class="form-select form-select-lg" id="kelas_id" name="kelas_id">
                            @foreach ($kelas as $item)
                            <option value="{{ $item->id }}">{{ $item->kelas }}</option>
                            @endforeach
                        </select>
                        <label for="kelas_id">Kelas</label>
                    </div>
                    <div class="form-floating flex-fill p-2">
                        <select class="form-select" id="jurusan_id" name="jurusan_id">
                            @foreach ($jurusan as $item)
                            <option value="{{ $item->id }}">{{ $item->jurusan }}</option>
                            @endforeach
                        </select>
                        <label for="jurusan_id">Jurusan</label>
                    </div>
                    <div class="form-floating flex-fill p-2">
                        <input type="text" required class="form-control" id="agama" name="agama" placeholder="agama">
                        <label for="agama">Agama</label>
                    </div>
                </div>
                <div class="d-flex my-3">
                    <div class="form-floating flex-fill p-2">
                        <textarea class="form-control form-control-lg" id="alamat" name="alamat" rows="5" ></textarea>
                        <label for="alamat">Alamat</label>
                    </div>
                </div>
                <div class="d-flex my-3">
                    <div class="form-floating flex-fill p-2">
                        <input type="number" name="angkatan" id="angkatan" class="form-control d-block">
                        <label for="angkatan">Tahun ajaran</label>
                    </div>
                    <div class="form-floating flex-fill p-2">
                        <select class="form-select form-select-lg" aria-label="Default select example" id="semester" name="semester">

                            <option value="1">1  </option>
                            <option value="2">2  </option>
                        </select>
                        <label for="semester">semester</label>
                    </div>
                </div>
                <div class="d-flex my-3">
                    <div class="form-floating flex-fill p-2">
                        <input type="text" required class="form-control" id="no_hp" name="no_hp">
                        <label for="no_hp">No HP</label>
                    </div>
                    <div class="form-floating flex-fill p-2">
                        <input type="email" class="form-control" id="email" name="email" required>
                        <label for="email">Email</label>
                    </div>
                </div>
                <div class="d-flex">
                    <button type="submit" class="btn btn-primary btn-lg mx-auto">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
