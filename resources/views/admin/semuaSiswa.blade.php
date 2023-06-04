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
                    <div class="m-2 p-2 d-flex justify-content-between">
                        <a href="{{ route('admin.tambahSiswa') }}"
                            class="btn btn-info rounded-pill btn-sm text-decoration-none my-3">Tambah Siswa
                            <i class="mdi mdi-account-plus"></i>
                        </a>
                        <input type="text" name="search_students" class="m-2 align-content-end border border-1 border-danger" placeholder="cari siswa...">
                    </div>
                    <div class="table-responsive">
                        <table class="table " id="siswaTable">
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
                            <tbody id="tbody_students">
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
                                                <button class="btn btn-sm btn-danger" onclick="deleteStudent('{{ $s->id }}')">hapus</button>
                                            </div>
                                        </td>
                                    </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        @include("admin.components.footer")
        <!-- partial -->
    </div>
@endsection

@push('script')
   <script>
        function deleteStudent(id) {
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/dashboard/siswa/' + id,
                        type: 'DELETE',
                        dataType: 'json',
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function (response) {
                            Swal.fire('Sukses', response.message, 'success').then(function () {
                                location.reload();
                            });
                        },
                        error: function (xhr) {
                            Swal.fire('Error', 'Terjadi kesalahan saat menghapus data', 'error');
                        }
                    });
                }
            });
        }
     $(document).ready(function () {
            $('input[name="search_students"]').on('change',  async function(event) {
                const resultRequest = await fetch(`/dashboard/ajaxStudentReq?search_students=${this.value}`)
                                        .then((result) => result.json());
                const tbodyStudents = document.querySelector("#tbody_students");
                const rowStudent = resultRequest.map((student, index) => {
                    return ` <tr>
                                <th scope="row">${index+1}</th>
                                <td ><img src=" {{ asset('storage/${student.foto}') }}" alt="${student.nama}" class="" style="width: 100px; height: 100px;"></td>
                                <td>${student.nama}</td>
                                <td>${student.nis}</td>
                                <td>${student.no_hp}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a class="text-decoration-none text-light btn btn-outline-warning btn-sm bg-primary" href="/dashboard/siswa/${student.id}">detail</a>
                                        <a class="text-decoration-none text-light btn btn-outline-warning btn-sm bg-secondary" href="/dashboard/siswa/${student.id}/edit">edit</a>
                                        <button class="btn btn-sm btn-danger" onclick="deleteStudent(${student.id})">hapus</button>
                                    </div>
                                </td>
                            </tr>`;
                }).join('');
                tbodyStudents.innerHTML = '';
                tbodyStudents.innerHTML += rowStudent;
            });
        });
   </script>
@endpush
