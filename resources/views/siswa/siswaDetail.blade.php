@extends('siswa.template.main')
@section('title', $title)
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Profil Siswa</h1>
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
                        <div class="card-body">
                            <form action="/siswa/{{ $siswa->id }}" method="post" enctype="multipart/form-data">
                                @method('put')
                                @csrf()
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
                                    <button type="submit" class="btn btn-sm btn-outline-info mx-auto">ubah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
