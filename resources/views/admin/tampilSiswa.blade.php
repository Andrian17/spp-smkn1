@extends('template.main')
@section('title', $title)
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Profil Siswa</h1>
            @if (session()->has('success'))
                {!! session('success') !!}
            @endif
            <div class="jumbotron d-flex" id="detailSiswa">
                <div class="card mx-auto rounded-top flex-fill">
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
                                    <td>Email</td>
                                    <td>:</td>
                                    <td>{{$siswa->user->email}}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td>{{ $siswa->alamat->alamat }}</td>
                                </tr>
                                <tr>
                                    <td>Kelas / Jurusan</td>
                                    <td>:</td>
                                    <td> {{ $siswa->kelas->kelas }} / {{ $siswa->jurusan->jurusan }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card my-auto border border-info" id="fotoSiswa">
                    <img class="card-img-top mx-auto" src="{{ asset('storage/' . $siswa->foto) }}" alt="foto siswa" style="max-height: 330px; max-width: 260px;">
                </div>
            </div>
            <div class="card-body">
                <p>Pembayaran SPP</p>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card mx-auto d-flex" style="width: 100%;">
                            <div class="card-body border border-secondary">
                                <h6>Jumlah yang dibayarkan</h6>
                                <p class="card-text">@currency($siswa->utsPayments[0]->nominal_pembayaran)</p>
                                <h5 class="card-title">UTS</h5>
                                <p class="card-text">
                                    @if ($siswa->utsPayments[0]->status_pembayaran == "success")
                                        <span class="badge bg-success">lunas</span>
                                    @else
                                        <span class='badge bg-danger'>belum</span>
                                    @endif
                                </p>
                                @if ($siswa->utsPayments[0]->status_pembayaran == "success")
                                    <h6>dibayar pada: {{ $siswa->utsPayments[0]->created_at->diffForHumans() }}</h6>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card mx-auto d-flex" style="width: 100%;">
                            <div class="card-body border border-secondary">
                                <h6>Jumlah yang dibayarkan</h6>
                                <p class="card-text">@currency($siswa->uasPayments[0]->nominal_pembayaran)</p>
                                <h5 class="card-title">UAS</h5>
                                <p class="card-text">
                                    @if ($siswa->uasPayments[0]->status_pembayaran == "success")
                                        <span class="badge bg-success">lunas</span>
                                    @else
                                        <span class='badge bg-danger'>belum</span>
                                    @endif
                                </p>
                                @if ($siswa->utsPayments[0]->status_pembayaran == "success")
                                    <h6>dibayar pada: {{ $siswa->utsPayments[0]->created_at->diffForHumans() }}</h6>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


