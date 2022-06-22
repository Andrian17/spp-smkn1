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

      <title>Hello, world!</title>
   </head>
   <body>
    <div class='container'>
        <div class='row'>
            <div class='col-md-12 '>
                <h1>Profil Siswa</h1>
                <h5>Detail Data Siswa</h5>
                <div class='jumbotron d-flex flex-row'>
                    <table class='table flex-grow-1' >
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
                                    <span class='badge bg-warning text-dark'>Belum Lunas</span>
                                @endif
                              </td>
                            </tr>
                            <tr>
                                <td>Tanggal Pembayaran</td>
                                <td>:</td>
                                <td>
                                    @if ($payment->status_pembayaran == 'success')
                                        <p>{{ $payment->updated_at->diffForHumans() }}</p>
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

                              </td>
                            </tr>
                            <tr>
                              <td scope='row'>Status Pembayaran</td>
                              <td>:</td>
                              <td>
                                @if ($payment->status_pembayaran == 'success')
                                    <span class='badge bg-success'>Lunas</span>
                                @else
                                    <span class='badge bg-warning text-dark'>Belum Lunas</span>
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