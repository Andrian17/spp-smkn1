@extends('siswa.template.main')
@section('title', $title)
@section('content')
        <div class="row mx-auto">
            <h4 class="p-2 m-3">Profil Siswa</h4>
            <div class="col-lg-8 col-12 shadow">
                <h6 class="bg-primary text-light rounded-top p-3">Detail Data Siswa</h6>
                    <div class="card-body rounded-top mx-auto">
                        <table class="table">
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
            <div class="col-lg-3 col-12 shadow ms-4">
                <div class="d-flex justify-content-center my-5">
                    <img class="w-50 h-50" src="{{ asset('storage/' . $siswa->foto) }}" style="max-height: 300px; max-width: 240px" alt="foto siswa">
                </div>
                <div class="d-flex justify-content-center">
                    <a href="/siswa/{{$siswa->id}}/edit" class="btn btn-outline-primary btn-sm mx-auto d-block">
                        <i class="fa-solid fa-user-pen"></i> edit profile
                    </a>
                </div>
            </div>

        </div>
@endsection
