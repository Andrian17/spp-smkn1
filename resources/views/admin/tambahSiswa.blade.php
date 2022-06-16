@extends('template.main')
@section('content')
    <h1 class="mt-4">Tambah Siswa</h1>
    <div class="row">
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
        <div class="col-md-8 d-flex">
            <form method="POST" action="{{ route('admin.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="d-flex justify-content-between ">
                    <div class="form-group mx-2 my-2">
                        <label for="nis">NIS</label>
                        <input type="number" class="form-control " id="nis" name="nis" placeholder="NIS">
                    </div>
                    <div class="form-group mx-2 my-2">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="form-group mx-4 my-2">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select class="form-select form-select-sm" name="jenis_kelamin" aria-label=".form-select-sm example">
                            <option selected>Pilih</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group mx-4 my-2">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" placeholder="tanggal lahir">
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="form-group mx-2 my-2">
                        <label for="kelas_id">Kelas</label>
                        <select class="form-select" id="kelas_id" name="kelas_id">
                            <option value="" selected>Pilih Kelas</option>
                            @foreach ($kelas as $item)
                                <option value="{{ $item->id }}">{{ $item->kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mx-2 my-2">
                        <label for="jurusan_id">Jurusan</label>
                        <select class="form-select" id="jurusan_id" name="jurusan_id">
                            <option value="" selected>Pilih Jurusan</option>
                            @foreach ($jurusan as $item)
                                <option value="{{ $item->id }}">{{ $item->jurusan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mx-2 my-2">
                        <label for="agama">Agama</label>
                        <input type="text" class="form-control" id="agama" name="agama" placeholder="agama">
                    </div>
                </div>
                <div class="form-group mx-2 my-2">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3"></textarea>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="form-group mx-2 my-2">
                        <label for="angkatan">Tahun ajaran</label>
                        <input type="number" name="angkatan" id="angkatan" class="form-control d-block" placeholder="Angkatan">
                    </div>
                    <div class="form-group mx-2 my-2">
                        <label for="semester">semester</label>
                        <select class="form-select" aria-label="Default select example" id="semester" name="semester">
                            <option selected value="">Semester</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                          </select>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="form-group mx-2 my-2">
                        <label for="no_hp">No HP</label>
                        <input type="number" class="form-control" id="no_hp" name="no_hp" placeholder="No HP">
                    </div>
                    <div class="form-group mx-2 my-2">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                    </div>
                </div>
                {{-- <div class="d-flex justify-content-center">
                    <div class="form-group mx-2 my-2">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="password">
                    </div>
                    <div class="form-group mx-2 my-2">
                        <label for="password2">Confirm Password</label>
                        <input type="password" class="form-control" id="password2" name="password2" placeholder="confirm password">
                    </div>
                </div> --}}
                <div class="mb-3">
                    <label for="formFile" class="form-label">Foto Profile</label>
                    <input class="form-control" type="file" id="formFile">
                </div>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
        </div>
    </div>
@endsection
