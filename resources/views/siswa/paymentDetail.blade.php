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

                            @foreach ($siswa->payments as $payment)
                            <tr>
                              <td scope="row">Pembayaran</td>
                              <td>:</td>
                              <td>Rp. {{ $payment->nominal_pembayaran }}</td>
                            </tr>
                            <tr>
                              <td scope="row">UTS</td>
                              <td>:</td>
                              <td>
                                @if ($payment->pembayaran_uts == 1)
                                    <span class="badge bg-success">Lunas</span>
                                @else
                                    <span class="badge bg-warning text-dark">Belum Lunas</span>
                                @endif
                                <button id="btnBayar" class="btn btn-primary">bayar</button>
                              </td>
                            </tr>
                            <tr>
                              <td scope="row">UAS</td>
                              <td>:</td>
                              <td>
                                @if ($payment->pembayaran_uas == 1)
                                    <span class="badge bg-success">Lunas</span>
                                @else
                                    <span class="badge bg-warning text-dark">Belum Lunas</span>
                                @endif
                              </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                     {{-- {{ dd() }} --}}
                      <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client') }}">
                      </script>
                      <script>
                        document.getElementById('btnBayar').addEventListener('click', function (event) {
                            event.preventDefault();
                          // SnapToken acquired from previous step
                          snap.pay('{{ $token }}', {
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
                            }
                          });
                        });
                      </script>
                </div>

            </div>
        </div>
    </div>
@endsection
