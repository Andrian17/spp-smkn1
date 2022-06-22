<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">admin</div>
                <a class="nav-link active" href="{{ route('admin.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Master Data</div>

                <a class="nav-link {{ Request::is('dashboard/getAllSiswa') ? 'active' : '' }}" href="{{ route('admin.allSiswa') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                    Data Siswa
                </a>
                <a class="nav-link {{ Request::is('dashboard/allPembayaran') ? 'active' : '' }}" href="{{ route('admin.allPembayaran') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-money-bill-1-wave"></i></div>
                    Data Pembayaran
                </a>
                <a class="nav-link {{ Request::is('jurusan') ? 'active' : '' }}" href="{{ route('jurusan.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-person-chalkboard"></i></div>
                    Data Jurusan
                </a>
                {{-- <a class="nav-link" href="tables.html">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Nominal Pembayaran
                </a> --}}

            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ Auth::user()->name }} | {{ Auth::user()->role }}
        </div>
    </nav>
</div>
