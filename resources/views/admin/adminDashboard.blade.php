@extends("admin.template")
@section('main-panel')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                    <i class="mdi mdi-home"></i>
                </span> Dashboard
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
                <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                    <a href="{{ route("admin.semuaSiswa") }}" class="card-body text-decoration-none text-light">
                        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal
                        mb-3">Data Siswa <i class="mdi mdi-account-multiple mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5">{{ $jumlahSiswa }}</h2>
                    </a>
                </div>
                </div>
                <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                    <a href="{{ route("admin.semuaPembayaran") }}" class="card-body text-decoration-none text-light">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Data Pembayaran <i class="mdi mdi-cash-multiple mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5">{{ $jumlahPembayaran }}</h2>
                    </a>
                </div>
                </div>
                {{-- <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                    <a href="/dashboard/jurusan" class="card-body text-decoration-none text-light">
                        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <h4 class="font-weight-normal mb-3">Data Jurusan <i class="mdi mdi-folder-multiple-outline mdi-24px float-right"></i>
                        </h4>
                        <h2 class="mb-5">{{ $jumlahJurusan }}</h2>
                    </a>
                </div>
                </div> --}}
            </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        @include("admin.components.footer")
        <!-- partial -->
    </div>
@endsection
