@extends('template.main')
@section('content')
<div class="container">
    <h3 class="mt-4">Tambah Siswa</h3>
    <div class="row">
        <div class="col-lg-8">
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
            <form method="POST" action="/updateSiswa/{{ $siswa->id }}" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="d-flex my-3">
                    <div class="form-floating">
                        <input type="text" class="form-control form-control-lg" id="nama" name="nama" placeholder="Nama" value="{{ $siswa->nama }}">
                        <label for="nama">Nama</label>
                    </div>
                </div>
                <div class="d-flex my-3 justify-content-between">
                    <div class="form-floating">
                        <select class="form-select" name="jenis_kelamin" aria-label="Jenis Kelamin">
                            @if ($siswa->jenis_kelamin == "Perempuan")
                            <option value="Perempuan" selected>Perempuan</option>
                            @else
                            <option value="Laki-Laki" selected>Laki-Laki</option>
                            @endif
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                    </div>
                    <div class="form-floating">
                        <input type="date" class="form-control form-control-lg" id="tanggal_lahir" name="tanggal_lahir" placeholder="tanggal lahir" value="{{ $siswa->tanggal_lahir }}">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                    </div>
                </div>
                <div class="d-flex my-3 justify-content-between">
                    <div class="form-floating">
                        <select class="form-select form-select-lg" id="kelas_id" name="kelas_id">
                            {{-- <option value="" selected>Pilih Kelas</option> --}}
                            @if ($siswa->kelas)
                            <option value="{{ $siswa->kelas->kelas }}" selected>{{ $siswa->kelas->kelas }}</option>
                            @endif
                            @foreach ($kelas as $item)
                            <option value="{{ $item->id }}">{{ $item->kelas }}</option>
                            @endforeach
                        </select>
                        <label for="kelas_id">Kelas</label>
                    </div>
                    <div class="form-floating">
                        <select class="form-select" id="jurusan_id" name="jurusan_id">
                            {{-- <option value="" selected>Pilih Jurusan</option> --}}
                            @if ($siswa->jurusan)
                            <option value="{{ $siswa->jurusan->id }}">{{ $siswa->jurusan->jurusan }}</option>
                            @endif
                            @foreach ($jurusan as $item)
                            <option value="{{ $item->id }}">{{ $item->jurusan }}</option>
                            @endforeach
                        </select>
                        <label for="jurusan_id">Jurusan</label>
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control" id="agama" name="agama" placeholder="agama" value="{{ $siswa->agama }}">
                        <label for="agama">Agama</label>
                    </div>
                </div>
                <div class="form-floating ">
                    <textarea class="form-control form-control-lg" id="alamat" name="alamat" rows="5" >
                        {{ $siswa->alamat->alamat }}
                    </textarea>
                    <label for="alamat">Alamat</label>
                </div>
                <div class="d-flex my-3 justify-content-between">
                    <div class="form-floating">
                        <input type="number" name="angkatan" id="angkatan" class="form-control d-block" value="{{ $siswa->angkatan }}">
                        <label for="angkatan">Tahun ajaran</label>
                    </div>
                    <div class="form-floating">
                        <select class="form-select form-select-lg" aria-label="Default select example" id="semester" name="semester">
                            {{-- <option selected value="">Semester</option> --}}
                            @if ($siswa->semester)
                            <option value="{{ $siswa->semester }}" selected>{{ $siswa->semester }}</option>
                            @endif
                            <option value="1">1  </option>
                            <option value="2">2  </option>
                        </select>
                        <label for="semester">semester</label>
                    </div>
                </div>
                <div class="d-flex my-3 justify-content-between">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ $siswa->no_hp }}">
                        <label for="no_hp">No HP</label>
                    </div>
                </div>
                <div class="d-flex my-3">
                    <button type="submit" class="btn btn-primary mx-auto">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
