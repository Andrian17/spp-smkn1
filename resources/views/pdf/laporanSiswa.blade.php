<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />

      <!-- Bootstrap CSS -->
      <link
         href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css"
         rel="stylesheet"
         integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1"
         crossorigin="anonymous"
      />
      <title>Laporan Pembayaran</title>
   </head>
   <body>
    <div class='container'>
        <div class='row'>
            <div class='col-lg-12'>
                <div class='jumbotron'>
                    <div class="card mx-auto rounded-top">
                        <img src="{{ public_path() . '/storage/kopsmk.png' }}" alt="kop-smk" style="width: 100%; max-height: 120px;">
                        <h6 class="bg-secondary p-2 text-light rounded-top">Detail Siswa</h6>
                        <div class="d-flex">
                            <div class="d-flex">
                                <img src="{{ public_path() . '/storage/' . $siswa->foto }}" class="card-img-top border border-secondary p-sm-0 justify-content-center" alt="{{ $siswa->nama }}" style="height: 100%; max-height: 160px;  width: 100%; max-width: 120px">
                            </div>
                            <div class="flex-fill">
                                <div class="card-body rounded-top">
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
                    <div class="card mx-auto mt-4 mb-4 rounded-top">
                        <h6 class="bg-primary p-2 text-light rounded-top">Data Pembayaran</h6>
                        <div class="d-flex card-body">
                            <div class="flex-fill p-3 border border-secondary">
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
                            <div class="flex-fill p-3 border border-secondary">
                                <table class="table">
                                    <tbody>
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
    </div>

      <!-- Optional JavaScript; choose one of the two! -->

      <!-- Option 1: Bootstrap Bundle with Popper -->
      <script
         src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
         integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
         crossorigin="anonymous"
      ></script>

      <!-- Option 2: Separate Popper and Bootstrap JS -->
      <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
   </body>
</html>
