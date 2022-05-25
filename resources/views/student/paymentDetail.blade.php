@extends('student.template.studentContainer')
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
                                <td>{{ $student->nama }}</td>
                            </tr>
                            <tr>
                                <td>P/L</td>
                                <td>:</td>
                                <td>{{ $student->jenis_kelamin }}</td>
                            </tr>
                            <tr>
                                <td>Jurusan</td>
                                <td>:</td>
                                <td>{{ $student->major->jurusan }}</td>
                            </tr>
                            <tr>
                                <td>Kelas</td>
                                <td>:</td>
                                <td>{{ $student->kelas->kelas }}</td>
                            </tr>

                            @foreach ($payments as $payment)
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
                </div>

            </div>
        </div>
    </div>
@endsection
