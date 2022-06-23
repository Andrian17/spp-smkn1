<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
    <title>Laporan Pembayaran PDF</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body style="width: auto">
    <div class="container " style="width: auto">
        <div class="row">
            <div class="col-lg-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Nis</th>
                            <th scope="col">Jenis Kelamain</th>
                            <th scope="col">No HP</th>
                            <th scope="col">Semester</th>
                            <th scope="col">Tanggal Lahir</th>
                            <th scope="col">Agama</th>
                            <th scope="col">Angkatan</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Jurusan</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Mid-semester</th>
                            <th scope="col">Akhir-Semester</th>
                            <th scope="col">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($siswa as $s)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $s->nama }}</td>
                            <td>{{ $s->nis }}</td>
                            <td>{{ $s->jenis_kelamin }}</td>
                            <td>{{ $s->no_hp }}</td>
                            <td>{{ $s->semester }}</td>
                            <td>{{ $s->tanggal_lahir }}</td>
                            <td>{{ $s->agama }}</td>
                            <td>{{ $s->angkatan }}</td>
                            <td>{{ $s->kelas->kelas }}</td>
                            <td>{{ $s->jurusan->jurusan }}</td>
                            <td>{{ $s->alamat->alamat }}</td>
                            <td>
                                @if ($s->utsPayments[0]->status_pembayaran == "success")
                                    <span class="badge bg-success">lunas</span>
                                @else
                                    <span class='badge bg-danger'>belum</span>
                                @endif
                            </td>
                            <td>
                                @if ($s->uasPayments[0]->status_pembayaran == "success")
                                    <span class="badge bg-success">lunas</span>
                                @else
                                    <span class='badge bg-danger'>belum</span>
                                @endif
                            </td>
                            <td>{{ $s->utsPayments[0]->nominal_pembayaran }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>
