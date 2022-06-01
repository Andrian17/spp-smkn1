@extends('siswa.template.siswaContainer')
@section('title', $title)
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 ">
                <h1>Profil Siswa</h1>
                <h5>Detail Data Siswa</h5>
                <div class="jumbotron d-flex flex-row">
                    <table class="table flex-grow-1" >
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
                          <tr>
                            <td>Provinsi - Kota</td>
                            <td>:</td>
                            <td>{{ $siswa->alamat->provinsi }} - {{ $siswa->alamat->kota }} </td>
                          </tr>
                          <tr>
                            <td>Alamat Lengkap</td>
                            <td>:</td>
                            <td>{{ $siswa->alamat->alamat }}</td>
                          </tr>
                        </tbody>
                      </table>
                      <div class="card flex-grow-1" style="width: 18rem;">
                        <img class="card-img-top" src="{{ $siswa->foto }}" alt="foto siswa">
                        <div class="card-body">
                            <h5 class="card-title"> {{ $siswa->nama }} </h5>
                            <p class="card-text">ganti foto</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>


@endsection
