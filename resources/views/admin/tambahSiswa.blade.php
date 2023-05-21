@extends("admin.template")
@section('main-panel')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-account-multiple"></i>
                </span> Tambah Siswa
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
                <div class="col-12">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Form Tambah Siswa</h4>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session()->has('pesan'))
                            {!! session('pesan') !!}
                        @endif
                        <form class="form-sample" id="siswaForm" method="POST" action="{{ route('admin.simpanSiswa') }}">
                            @csrf
                          <p class="card-description"> Masukkan data Siswa </p>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nama</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" />
                                  @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                   @enderror
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nis</label>
                                <div class="col-sm-9">
                                  <input type="number" class="form-control @error('nis') is-invalid @enderror" name="nis" value="{{ old('nis') }}"/>
                                  @error('nis')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                   @enderror
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Gender</label>
                                <div class="col-sm-9">
                                  <select class="form-control" name="jenis_kelamin">
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-9">
                                  <input class="form-control @error('tanggal_lahir') is-invalid @enderror" placeholder="dd/mm/yyyy" name="tanggal_lahir" type="date" />
                                  @error('tnaggal_lahir')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                   @enderror
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group row">
                                <label class="col-form-label">Jurusan</label>
                                <select class="form-control" name="jurusan_id">
                                  @foreach ($jurusan as $item)
                                      <option value="{{ $item->id }}">{{ $item->jurusan }}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group row">
                                <label class="col-form-label">Kelas</label>
                                <select class="form-control" name="kelas_id">
                                  @foreach ($kelas as $item)
                                      <option value="{{ $item->id }}">{{ $item->kelas }}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group row">
                                <label class="col-form-label">Semester</label>
                                <select class="form-control" name="semester">
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                  <label class="col-form-label">Tahun Ajaran</label>
                                  <div class="col-sm-12">
                                    <input type="number" class="form-control @error('angkatan') is-invalid @enderror" name="angkatan" value="{{ old("angkatan") }}" />
                                    @error('angkatan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                   @enderror
                                  </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                  <label class="col-form-label">Agama</label>
                                  <div class="col-sm-12">
                                    <select class="form-control-sm" name="agama">
                                      <option value="islam">islam</option>
                                      <option value="katolik">katolik</option>
                                      <option value="protestan">protestan</option>
                                      <option value="hindu">hindu</option>
                                      <option value="budha">budha</option>
                                      <option value="kong hu chu">kong hu chu</option>
                                    </select>
                                  </div>
                                </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleTextarea1">Alamat</label>
                                    <textarea class="form-control @error('alamat') is-invalid @enderror" id="exampleTextarea1" rows="4" name="alamat">{{ old("alamat") }}</textarea>
                                    @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                   @enderror
                                </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nomor HP</label>
                                <div class="col-sm-9">
                                  <input type="number" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" minlength="11" value="{{ old('no_hp') }}" />
                                  @error('no_hp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                   @enderror
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">email</label>
                                <div class="col-sm-9">
                                  <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old("email") }}" />
                                  @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                   @enderror
                                </div>
                              </div>
                            </div>
                          </div>
                          <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                          <button class="btn btn-light" type="reset">Cancel</button>
                        </form>
                      </div>
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
    {{-- <script>

        const siswaForm = document.getElementById("siswaForm");
        siswaForm.addEventListener("submit", async (e) => {
            e.preventDefault();
            const dataSiswa = {
                "_token" : document.querySelector('input[name=_token]').value,
                "nama" : document.querySelector('input[name=nama]').value,
                "email" : document.querySelector('input[name=email]').value,
                "nis" :  document.querySelector('input[name=nis]').value,
                "jenis_kelamin" : document.querySelector('select[name=jenis_kelamin]').value,
                "tanggal_lahir" : document.querySelector('input[name=tanggal_lahir]').value,
                "jurusan_id" :  document.querySelector('select[name=jurusan_id]').value,
                "kelas_id" :  document.querySelector('select[name=kelas_id').value,
                "semester" :  document.querySelector('select[name=semester]').value,
                "angkatan" :  document.querySelector('input[name=angkatan]').value,
                "agama" :  document.querySelector('select[name=agama]').value,
                "alamat" :  document.querySelector('textarea[name=alamat]').value,
                "no_hp" :  document.querySelector('input[name=no_hp]').value,
            }
            const result = await fetch('{{ route('admin.simpanSiswa') }}', {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(dataSiswa)
                },
            ).then((result) => {
                console.log("OK");
                // console.log(result.url);
                window.location.href = result.url;
                // window.location.reload();
                // window.location.replace(window.location.pathname);
            }).catch((result) => {
                console.log("catch");
                console.log(result);
            });
        })
    </script> --}}
@endpush
