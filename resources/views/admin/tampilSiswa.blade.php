@extends('template.main')
@section('title', $title)
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="jumbotron mx-auto">
                    <h1 class="mt-4">Data Siswa</h1>
                    <div class="card mx-auto rounded-top">
                        <h6 class="bg-primary p-2 text-light rounded-top">Detail Data Siswa</h6>
                        <img class="card-img-top mx-auto" src="{{ asset('storage/' . $siswa->foto) }}" alt="foto siswa" style="height: 60%; width: 30%">
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
                        <div class="card-body">
                            <p>Pembayaran SPP</p>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card mx-auto d-flex" style="width: 100%;">
                                        <div class="card-body">
                                            <h6>Jumlah yang dibayarkan</h6>
                                            <p class="card-text">Rp. {{ $siswa->utsPayments[0]->nominal_pembayaran }}</p>
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
                                        <div class="card-body">
                                            <h6>Jumlah yang dibayarkan</h6>
                                            <p class="card-text">Rp. {{ $siswa->uasPayments[0]->nominal_pembayaran }}</p>
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
    </div>
</div>
@endsection


