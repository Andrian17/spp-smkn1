@extends('siswa.template.main')
@section('title', "Edit Siswa")
@section('content')
<div class="row mx-auto">
    <div class="col-lg-10 col-md-12 col-sm-12 justify-content-center mx-auto mt-4">
       <div class="m-2">
        @if (session()->has('success'))
            {!! session('success') !!}
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
       </div>

        <form method="POST" action="{{ route('siswa.update', $siswa->id) }}" enctype="multipart/form-data">
            @method("PUT")
            @csrf()
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-10 col-sm-12 mb-3">
                        <label for="nama" class="form-label">Nama Siswa</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $siswa->nama }}">
                    </div>
                    <div class="col-lg-6 col-md-10 col-sm-12 mb-3">
                        <label for="nis" class="form-label">NIS</label>
                        <input type="text" class="form-control" id="nis" readonly value="{{ $siswa->nis }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-10 col-sm-12 mb-3">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select class="form-select" name="jenis_kelamin" aria-label="Jenis Kelamin">
                            @if ($siswa->jenis_kelamin == "Perempuan")
                            <option value="Perempuan" selected>Perempuan</option>
                            @else
                            <option value="Laki-Laki" selected>Laki-Laki</option>
                            @endif
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="col-lg-6 col-md-10 col-sm-12 mb-3">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" placeholder="tanggal lahir" value="{{ $siswa->tanggal_lahir }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 mb-3">
                        <label for="kelas_id">Kelas</label>
                        <select class="form-select" id="kelas_id" name="kelas_id">
                            @if ($siswa->kelas)
                            <option value="{{ $siswa->kelas->kelas }}" selected>{{ $siswa->kelas->kelas }}</option>
                            @endif
                            @foreach ($kelas as $item)
                            <option value="{{ $item->id }}">{{ $item->kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label for="jurusan_id">Jurusan</label>
                        <select class="form-select" id="jurusan_id" name="jurusan_id">
                            {{-- <option value="" selected>Pilih Jurusan</option> --}}
                            @if ($siswa->jurusan)
                            <option value="{{ $siswa->jurusan->id }}">{{ $siswa->jurusan->jurusan }}</option>
                            @endif
                            @foreach ($jurusan as $item)
                            <option value="{{ $item->id }}">{{ $item->jurusan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                        <label for="angkatan">Tahun ajaran</label>
                        <input type="number" name="angkatan" id="angkatan" class="form-control d-block" value="{{ $siswa->angkatan }}" required>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                        <label for="semester">semester</label>
                        <select class="form-select" aria-label="Default select example" id="semester" name="semester">
                            @if ($siswa->semester)
                            <option value="{{ $siswa->semester }}" selected>{{ $siswa->semester }}</option>
                            @endif
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 mb-3">
                        <label for="agama">Agama</label>
                        <input type="text" class="form-control" id="agama" name="agama" placeholder="agama" value="{{ $siswa->agama }}" required>
                    </div>
                    <div class="col-lg-6 col-md-10 col-sm-12 mb-3">
                        <label for="no_hp">No HP</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ $siswa->no_hp }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-3">
                        <div class="form-floating">
                            <textarea class="form-control form-control-lg" id="alamat" name="alamat" rows="5" >{{ $siswa->alamat->alamat }}</textarea>
                            <label for="alamat">Alamat</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8 mb-3">
                        <label for="formFile" class="form-label">Ganti foto</label>
                        <input class="form-control @error('foto') is-invalid @enderror" type="file" name="foto" id="formFile">
                        @error("foto")
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-4 mb-3">
                        <img src="{{ asset('storage/' . $siswa->foto) }}" alt="foto siswa" class="w-50 h-50">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
    </div>
</div>
@endsection

