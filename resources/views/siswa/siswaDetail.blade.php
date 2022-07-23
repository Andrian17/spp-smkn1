@extends('siswa.template.main')
@section('title', $title)
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Profil Siswa</h1>
                @if (session()->has('success'))
                    {!! session('success') !!}
                @endif
                <div class="jumbotron d-flex " id="detailSiswa">
                    <div class="card mx-auto rounded-top flex-grow-1">
                        <h6 class="bg-primary p-2 text-light rounded-top">Detail Data Siswa</h6>
                        <div class="card-body rounded-top mx-auto ">
                            <table class="table" >
                                <tbody>
                                    <tr>
                                        <td scope="row">NIS</td>
                                        <td>:</td>
                                        <td>{{ $siswa->nis }}</td>
                                  </tr>
                                  <tr>
                                      <td>Nama</td>
                                      <td>:</td>
                                      <td>{{ $siswa->nama }}</td>
                                  </tr>
                                  <tr>
                                      <td>Tanggal Lahir</td>
                                      <td>:</td>
                                      <td>{{ $siswa->tanggal_lahir }}</td>
                                  </tr>
                                    <tr>
                                        <td>Jenis Kelamin</td>
                                        <td>:</td>
                                        <td>{{ $siswa->jenis_kelamin }}</td>
                                    </tr>
                                    <tr>
                                        <td>Agama</td>
                                        <td>:</td>
                                        <td>{{ $siswa->agama }}</td>
                                    </tr>
                                    <tr>
                                        <td>No. Telepon</td>
                                        <td>:</td>
                                        <td>{{$siswa->no_hp}}</td>
                                    </tr>
                                  <tr>
                                      <td colspan="3">Alamat</td>
                                  </tr>
                                    <td>Alamat Lengkap</td>
                                    <td>:</td>
                                    <td>{{ $siswa->alamat->alamat }}</td>
                                  </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card mx-auto" id="fotoSiswa">
                        <img class="card-img-top mx-auto" src="{{ asset('storage/' . $siswa->foto) }}" alt="foto siswa" style="max-height: 50%; ">
                        <div class="d-flex justify-content-center my-2">
                            <!-- Button trigger modal -->
                           <button type="button" class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fa-solid fa-user-pen"></i> ubah
                           </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Data Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form action="/siswa/{{ $siswa->id }}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf()
                        <div class="d-flex my-3">
                            <div class="form-floating w-50 p-2">
                                <input type="text" class="form-control form-control-lg" id="nama" name="nama" placeholder="Nama" value="{{ $siswa->nama }}">
                                <label for="nama">Nama</label>
                            </div>
                            <div class="form-floating w-50 p-2">
                                <input readonly type="text" class="form-control form-control-lg" id="nis" name="nis" placeholder="nis" value="{{ $siswa->nis }}">
                                <label for="nis">NIS</label>
                            </div>
                        </div>
                        <div class="d-flex my-3">
                            <div class="form-floating w-50 p-2">
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
                            <div class="form-floating w-50 p-2">
                                <input type="date" class="form-control form-control-lg" id="tanggal_lahir" name="tanggal_lahir" placeholder="tanggal lahir" value="{{ $siswa->tanggal_lahir }}">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                            </div>
                        </div>
                        <div class="d-flex my-3">
                            <div class="form-floating flex-fill p-2">
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
                            <div class="form-floating flex-fill p-2">
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
                            <div class="form-floating flex-fill p-2">
                                <input type="text" class="form-control" id="agama" name="agama" placeholder="agama" value="{{ $siswa->agama }}">
                                <label for="agama">Agama</label>
                            </div>
                        </div>
                        <div class="d-flex my-3">
                            <div class="form-floating flex-fill p-2">
                                <textarea class="form-control form-control-lg" id="alamat" name="alamat" rows="5" >{{ $siswa->alamat->alamat }}</textarea>
                                <label for="alamat">Alamat</label>
                            </div>
                        </div>
                        <div class="d-flex my-3">
                            <div class="form-floating flex-fill p-2">
                                <input type="number" name="angkatan" id="angkatan" class="form-control d-block" value="{{ $siswa->angkatan }}">
                                <label for="angkatan">Tahun ajaran</label>
                            </div>
                            <div class="form-floating flex-fill p-2">
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
                            <div class="form-floating flex-fill p-2">
                                <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ $siswa->no_hp }}">
                                <label for="no_hp">No HP</label>
                            </div>
                        </div>

                        {{-- foto --}}
                        <div class="mb-3">
                            <label for="formFile" class="form-label">ganti foto</label>
                            <input class="form-control @error('foto') is-invalid @enderror" type="file" name="foto" id="formFile">
                            @error("foto")
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="d-flex">
                            <button type="submit" class="btn btn-lg btn-outline-primary mx-auto">
                                <i class="fa-solid fa-user-pen"></i> ubah
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>


@endsection
