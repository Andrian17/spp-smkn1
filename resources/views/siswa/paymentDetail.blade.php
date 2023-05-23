@extends('siswa.template.main')
@section('title', $title)
@section('content')
        {{-- Midtrans Snap FE --}}
        <script src='https://app.sandbox.midtrans.com/snap/snap.js' data-client-key='{{ config('services.midtrans.client') }}'>
        </script>
    <div class="row">
        <div class="col-lg-10 mx-auto rounded-top shadow my-4">
            <h4 class="m-3 p-2">Profil Siswa</h4>
            <h6 class="bg-primary p-2 text-light rounded-top">Detail Siswa</h6>
            <div class="d-flex">
                <div class="siswa-image">
                    <img src="{{ asset('storage/' . $siswa->foto) }}" class="card-img-top mx-auto border border-success p-1 mt-2 ms-2" alt="{{ $siswa->nama }}" style="height: 100%; max-height: 200px;  width: 100%;">
                </div>
                <div class="ms-3 flex-fill">
                    <table class="table">
                      <tbody>
                          <tr>
                              <td scope="row" >NIS</td>
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
        </div>
    </div>
    <div class="row">
        <div class="col-lg-10 col-md-12 col-sm-12 mx-auto mt-4 mb-4 shadow">
            <h4>Pembayaran</h4>
            <h6 class="bg-primary p-2 text-light rounded-top">Detail Pembayaran</h6>
          <div class="d-flex">
            <a href='/siswa/{{ $siswa->id }}' target='__blank' class="btn btn-info btn-sm rounded-pill m-2 text-decoration-none"><i class="fa-solid fa-file-pdf"></i> Bukti pembayaran</a>
          </div>
            <div class="container row">
                <div class="col-lg-6 col-md-12 col-sm-12 my-3">
                    <table class="table mb-2 border border-bottom">
                        <tbody>
                            @foreach ($siswa->utsPayments as $payment)
                            <tr>
                              <td scope='row'>Jumlah</td>
                              <td>:</td>
                              <td>@currency($payment->nominal_pembayaran)</td>
                            </tr>
                            <tr>
                              <td scope='row'>Pembayaran</td>
                              <td>:</td>
                              <td>
                                @if ($payment->status_pembayaran === "pending")
                                    <span>{{ $payment->jenis_pembayaran }}</span>
                                    <button class='btn btn-success text-light btn-sm ms-3' onclick='createPayment("{{ $payment->snap_token }}", "UTS")'>bayar</button>
                                @elseif ($payment->status_pembayaran === 'failed')
                                    <span>pembayaran gagal</span>
                                    <button class='btn btn-success text-light btn-sm ms-3' onclick='updatePayment("{{ $payment->snap_token }}", "UTS")'>bayar ulang</button>
                                @else
                                    <span>{{ $payment->jenis_pembayaran }}</span>
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
                <div class="col-lg-6 col-md-12 col-sm-12 my-3">
                    <table class='table'>
                        <tbody>
                            @foreach ($siswa->uasPayments as $payment)
                            <tr>
                              <td scope='row'>Jumlah</td>
                              <td>:</td>
                              <td>@currency($payment->nominal_pembayaran)</td>
                            </tr>
                            <tr>
                              <td scope='row'>Pembayaran</td>
                              <td>:</td>
                              <td>
                                @if ($payment->status_pembayaran === "pending")
                                    <span>{{ $payment->jenis_pembayaran }}</span>
                                    <button class='btn btn-success text-light btn-sm ms-3' onclick='createPayment("{{ $payment->snap_token }}", "UAS")'>bayar</button>
                                @elseif ($payment->status_pembayaran === 'failed')
                                    <span>pembayaran gagal</span>
                                    <button class='btn btn-success text-light btn-sm ms-3' onclick='updatePayment("{{ $payment->snap_token }}", "UAS")'>bayar ulang</button>
                                @else
                                    <span>{{ $payment->jenis_pembayaran }}</span>
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
@endsection

@push('script')
<script>
    function createPayment(snapToken, paymentType) {
        snap.pay(snapToken, {
        // Optional
        onSuccess: function (result) {
            /* You may add your own js here, this is just example */
            console.log("success");
            console.log(result);
            location.reload();
        },
        // Optional
        onPending: function (result) {
            /* You may add your own js here, this is just example */
            console.log("pending");
            console.log(result);
            location.reload()
        },
        // Optional
        onError: function (result) {
        /* You may add your own js here, this is just example */
            console.log("gagal");
            console.log(result, "err");
            fetch('/api/pembayaran/updateSnap', {
                method: 'PUT',
                headers: {
                'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    "old_snap_token" : snapToken,
                    "payment_type" : paymentType
                })
            }).then((result) => {
                return result.json()
            }).catch((err) => {
                console.log(err);
            });
            location.reload()
        },
    });
    }

    async function updatePayment(snapToken, paymentType) {
        const payment =  await fetch('/api/pembayaran/updateSnap', {
            method: 'PUT',
            headers: {
            'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                "old_snap_token" : snapToken,
                "payment_type" : paymentType
            })
        }).then((result) => result.json());
        console.log("update token");
        console.log(payment);
        alert("snap token berhasil diupdate");
        location.reload();
    }
</script>
@endpush
