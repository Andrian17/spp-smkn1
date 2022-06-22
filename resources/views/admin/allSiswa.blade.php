@extends('template.main')
@section('content')
    <h1 class="mt-4">Data Siswa</h1>
    <div class="row">
        <div class="col-lg-12">
            @if (session()->has('pesan'))
                {!! session('pesan') !!}
            @endif
            <a href="{{ route('admin.create') }}" class="btn btn-primary my-3">Tambah Siswa</a>
            <table class="table" id="siswaTable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Nama</th>
                    <th scope="col">NIS</th>
                    <th scope="col">No Telp.</th>
                    <th scope="col">Detail</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($siswa as $s)
                        <tr >
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td ><img src=" {{ asset('storage/' . $s->foto)  }}" alt="{{ $s->nama }}" class="" style="width: 100px; height: 100px;"></td>
                            <td>{{ $s->nama }}</td>
                            <td>{{ $s->nis }}</td>
                            <td>{{ $s->no_hp }}</td>
                            <td class="">
                                <a class="text-decoration-none text-light btn btn-outline-warning bg-primary" href="/tampilSiswa/{{ $s->id }}">detail</a>
                            </td>
                        </tr>

                    @endforeach
                </tbody>
              </table>
        </div>
    </div>
@endsection


