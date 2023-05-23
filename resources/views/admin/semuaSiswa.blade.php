@extends("admin.template")
@section('main-panel')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-account-multiple"></i>
                </span> Data Siswa
                </h3>
                <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                    </li>
                </ul>
                </nav>
            </div>
            <div class="row">
                <div class="col-lg-10 col-md-10 col-sm-12">
                    @if (session()->has('pesan'))
                        {!! session('pesan') !!}
                    @endif
                    <a href="{{ route('admin.tambahSiswa') }}"
                        class="btn btn-info rounded-pill btn-sm text-decoration-none my-3">Tambah Siswa
                        <i class="mdi mdi-account-plus"></i>
                    </a>
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
                                        <div class="d-flex gap-1">
                                            <a class="text-decoration-none text-light btn btn-outline-warning btn-sm bg-primary" href="/dashboard/siswa/{{ $s->id }}">detail</a>
                                            <a class="text-decoration-none text-light btn btn-outline-warning btn-sm bg-secondary" href="/dashboard/siswa/{{ $s->id }}/edit">edit</a>
                                            <form action="/dashboard/siswa/{{ $s->id }}" method="post">
                                                @method("delete")
                                                @csrf()
                                                <button class="btn btn-sm btn-danger" id="tombolHapus" onclick="return confirm('Hapus Data Siswa ?')">hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        @include("admin.components.footer")
        <!-- partial -->
    </div>
@endsection
