@extends('template.main')
@section('content')
    <h1 class="mt-4">Data Siswa</h1>
    <div class="row">
        <div class="col-lg-10">
            <div class="card mx-auto d-flex" style="width: 80%;">
                <img src="{{ $siswa->foto }}" class="card-img-top mx-auto rounded-4" alt="{{ $siswa->nama }}" style="width: 50%;">
                <div class="card-body">
                  <h5 class="card-title d-flex justify-content-center">{{ $siswa->nama }}</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">NIS : {{ $siswa->nis }}</li>
                    <li class="list-group-item">No Telp. : {{ $siswa->no_hp }}</li>
                    <li class="list-group-item">tgl. lahir : {{ $siswa->tanggal_lahir }}</li>
                    <li class="list-group-item">agama : {{ $siswa->agama }}</li>
                    <li class="list-group-item">kelas : <a href="#">{{ $siswa->kelas->kelas }}</a> </li>
                    <li class="list-group-item">jurusan : <a href="#">{{ $siswa->jurusan->jurusan }}</a></li>
                    <li class="list-group-item">alamat : {{ $siswa->alamat->alamat }}</li>
                </ul>
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
                                </div>
                            </div>
                        </div>
                    </div>
              </div>
        </div>
    </div>
@endsection


