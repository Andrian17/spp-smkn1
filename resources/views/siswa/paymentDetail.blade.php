@extends('siswa.template.main')
@section('title', $title)
@section('content')
        {{-- Midtrans Snap FE --}}
        <script src='https://app.sandbox.midtrans.com/snap/snap.js' data-client-key='{{ config('services.midtrans.client') }}'>
        </script>
    <div class='container'>
        <div class='row'>
            <div class='col-lg-12'>
                <h3>Profil Siswa</h3>
                <div class='jumbotron'>
                    <div class="card mx-auto rounded-top">
                        <h6 class="bg-primary p-2 text-light rounded-top">Detail Data Siswa</h6>
                        <img src="{{ asset('storage/' . $siswa->foto) }}" class="card-img-top mx-auto border border-success p-1 mt-2" alt="{{ $siswa->nama }}" style="height: 35%; max-height: 320px;  width: 30%;">
                        <div class="card-body rounded-top mx-auto ">
                          <table class="table">
                            <tbody>
                                <tr>
                                    <td scope="row">NIS</td>
                                    <td>:</td>
                                    <td>{{ $siswa->nis }}</td>
                                </tr>
                                <tr>
                                    <td>NAMA</td>
                                    <td>:</td>
                                    <td>{{ $siswa->nama }}</td>
                                </tr>
                                <tr>
                                    <td>P/L</td>
                                    <td>:</td>
                                    <td>{{ $siswa->jenis_kelamin }}</td>
                                </tr>
                                <tr>
                                    <td>Jurusan</td>
                                    <td>:</td>
                                    <td>{{ $siswa->jurusan->jurusan }}</td>
                                </tr>
                                <tr>
                                    <td>Kelas</td>
                                    <td>:</td>
                                    <td>{{ $siswa->kelas->kelas }}</td>
                                </tr>
                            </tbody>
                          </table>
                        </div>
                    </div>
                    <div class="card mx-auto mt-4 mb-4 rounded-top">
                        <h6 class="bg-primary p-2 text-light rounded-top">Data Pembayaran</h6>
                        <div class="card-body mx-auto">
                            <table class='table'>
                                <tbody>
                                    @foreach ($siswa->uasPayments as $payment)
                                    <tr>
                                      <td scope='row'>Jumlah</td>
                                      <td>:</td>
                                      <td>Rp. {{ $payment->nominal_pembayaran }}</td>
                                    </tr>
                                    <tr>
                                      <td scope='row'>Pembayaran</td>
                                      <td>:</td>
                                      <td>
                                          <span>{{ $payment->jenis_pembayaran }}</span>
                                        @if ($payment->status_pembayaran != 'success')
                                            <button id='{{ $payment->jenis_pembayaran }}' class='btn btn-success text-light btn-sm ms-3'>bayar</button>
                                            <script>
                                                const clickSnap = document.querySelector(' #{{ $payment->jenis_pembayaran }} ');
                                                clickSnap.addEventListener('click', (event) => {
                                                event.preventDefault();
                                                // SnapToken acquired from previous step
                                                snap.pay('{{ $payment->snap_token }}', {
                                                    // Optional
                                                    onSuccess: function (result) {
                                                    /* You may add your own js here, this is just example */
                                                    //   location.reload();
                                                    console.log(result);
                                                    },
                                                    // Optional
                                                    onPending: function (result) {
                                                    /* You may add your own js here, this is just example */
                                                    console.log(result);
                                                    },
                                                    // Optional
                                                    onError: function (result) {
                                                    /* You may add your own js here, this is just example */
                                                    console.log(result);
                                                    fetch('/api/pembayaran/snapUAS', {
                                                        method: 'PUT',
                                                        headers: {
                                                        'Content-Type': 'application/json',
                                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                                        },
                                                        body: JSON.stringify({
                                                        _csrf: '{{ csrf_token() }}',
                                                        id : '{{ $payment->id }}',
                                                        nama : '{{ $siswa->nama }}',
                                                        no_hp : '{{ $siswa->no_hp }}',
                                                        nis : '{{ $siswa->nis }}',
                                                        order_id : '{{ $payment->order_id }}',
                                                        nominal_pembayaran : '{{ $payment->nominal_pembayaran }}',
                                                        })
                                                    }).then((result) => {
                                                        return result.json()
                                                    }).catch((err) => {
                                                        console.log(err);
                                                    });
                                                    }
                                                });
                                            });
                                            </script>
                                        @endif
                                      </td>
                                    </tr>
                                    <tr>
                                      <td scope='row'>Status Pembayaran</td>
                                      <td>:</td>
                                      <td>
                                        @if ($payment->status_pembayaran == 'success')
                                            <span class='badge bg-success'>Lunas</span>
                                        @else
                                            <span class='badge bg-danger text-dark'>Belum Lunas</span>
                                        @endif
                                      </td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Pembayaran</td>
                                        <td>:</td>
                                        <td>
                                            @if ($payment->status_pembayaran == 'success')
                                                <p>{{ $payment->updated_at }}</p>
                                            @else
                                                <p>-</p>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan='3'></td>
                                    </tr>
                                    @foreach ($siswa->utsPayments as $payment)
                                    <tr>
                                      <td scope='row'>Jumlah</td>
                                      <td>:</td>
                                      <td>Rp. {{ $payment->nominal_pembayaran }}</td>
                                    </tr>
                                    <tr>
                                      <td scope='row'>Pembayaran</td>
                                      <td>:</td>
                                      <td>
                                          <span>{{ $payment->jenis_pembayaran }}</span>
                                        @if ($payment->status_pembayaran != 'success')
                                          <button id='{{ $payment->jenis_pembayaran }}' class='btn btn-success text-light btn-sm ms-3'>bayar</button>
                                            <script>
                                                const clickSnap2 = document.querySelector(' #{{ $payment->jenis_pembayaran }} ');
                                                clickSnap2.addEventListener('click', (event) => {
                                                event.preventDefault();
                                                // SnapToken acquired from previous step
                                                snap.pay('{{ $payment->snap_token }}', {
                                                    // Optional
                                                    onSuccess: function (result) {
                                                    /* You may add your own js here, this is just example */
                                                        location.reload();
                                                    console.log(result);
                                                    },
                                                    // Optional
                                                    onPending: function (result) {
                                                    /* You may add your own js here, this is just example */
                                                    console.log(result);
                                                    },
                                                    // Optional
                                                    onError: function (result) {
                                                    /* You may add your own js here, this is just example */
                                                    console.log(result);
                                                    fetch('/api/pembayaran/snapUTS', {
                                                        method: 'PUT',
                                                        headers: {
                                                        'Content-Type': 'application/json',
                                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                                        },
                                                        body: JSON.stringify({
                                                        _csrf: '{{ csrf_token() }}',
                                                        id : '{{ $payment->id }}',
                                                        nama : '{{ $siswa->nama }}',
                                                        no_hp : '{{ $siswa->no_hp }}',
                                                        nis : '{{ $siswa->nis }}',
                                                        order_id : '{{ $payment->order_id }}',
                                                        nominal_pembayaran : '{{ $payment->nominal_pembayaran }}',
                                                        })
                                                    }).then((result) => {
                                                        return result.json()
                                                    }).catch((err) => {
                                                        console.log(err);
                                                    });
                                                    }
                                                });
                                            });
                                            </script>
                                         @endif
                                      </td>
                                    </tr>
                                    <tr>
                                      <td scope='row'>Status Pembayaran</td>
                                      <td>:</td>
                                      <td>
                                        @if ($payment->status_pembayaran == 'success')
                                            <span class='badge bg-success'>Lunas</span>
                                        @else
                                            <span class='badge bg-danger text-dark'>Belum Lunas</span>
                                        @endif
                                      </td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Pembayaran</td>
                                        <td>:</td>
                                        <td>
                                            @if ($payment->status_pembayaran == 'success')
                                                <p>{{ $payment->updated_at }}</p>
                                            @else
                                                <p>-</p>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
