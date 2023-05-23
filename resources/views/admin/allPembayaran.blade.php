@extends('admin.template')
@section('main-panel')
    <h1 class="mt-4">Data Pembayaran</h1>
    <div class="row">
        <div class="col-lg-10">
            <div class="card mb-4">
                <div class="d-block ms-auto">
                    <a href="{{ route('admin.exportExcell') }}" class="btn btn-success rounded-pill btn-sm text-decoration-none m-2" target="__blank"><i class="fa-solid fa-file-excel"></i> export excell <i class="fa-solid fa-file-export"></i></a>
                </div>
                <div class="card-header"><i class="fas fa-table mr-1"></i>Data Pembayaran</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Siswa</th>
                                    <th>Kelas/Jurusan</th>
                                    <th>UTS</th>
                                    <th>UAS</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($siswa as $s)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $s->nis }}</td>
                                    <td>{{ $s->nama }}</td>
                                    <td> {{ $s->kelas->kelas }}/{{ $s->jurusan->jurusan }}</td>
                                    <td>
                                        @if ($s->utsPayments)
                                            @if ($s->utsPayments[0]->status_pembayaran == "success")
                                                <span class="badge bg-success">lunas</span>
                                            @else
                                                <span class='badge bg-danger'>belum</span>
                                            @endif
                                        @else
                                            <span>-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($s->uasPayments[0]->status_pembayaran == "success")
                                            <span class="badge bg-success">lunas</span>
                                        @else
                                            <span class='badge bg-danger'>belum</span>
                                        @endif
                                    </td>
                                    <td class="">
                                        <a class="text-decoration-none text-light btn btn-outline-warning bg-primary" href="/tampilSiswa/{{ $s->id }}">detail</a>
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
@endsection


