@extends('template.main')
@section('content')
    <h1 class="mt-4">Data Siswa</h1>
    <div class="row">
        <div class="col-lg-10">
            <table class="table" id="siswaTable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">NIS</th>
                    <th scope="col">No Telp.</th>
                    <th scope="col">UTS</th>
                    <th scope="col">UAS</th>
                    <th scope="col">Detail</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($siswa as $s)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $s->nama }}</td>
                            <td>{{ $s->nis }}</td>
                            <td>{{ $s->no_hp }}</td>
                            <td>
                                @if ($s->uasPayments[0]->status_pembayaran == "success")
                                    <span class="badge bg-success">lunas</span>
                                @else
                                    <span class='badge bg-danger'>belum</span>
                                @endif
                            </td>
                            <td>
                                @if ($s->utsPayments[0]->status_pembayaran == "success")
                                    <span class="badge bg-success">lunas</span>
                                @else
                                    <span class='badge bg-danger'>belum</span>
                                @endif
                            </td>
                            <td class="">
                                <span class="badge bg-primary "><a class="text-decoration-none text-light" href="/tampilSiswa/{{ $s->id }}">detail</a></span>
                            </td>
                        </tr>

                    @endforeach
                </tbody>
              </table>
        </div>
    </div>
@endsection


