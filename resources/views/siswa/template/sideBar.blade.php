<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion bg-info" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">SISWA</div>
                <a class="nav-link text-dark " href="{{ route('siswa.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-user-graduate"></i></div>
                    Data Siswa
                </a>
                <div class="sb-sidenav-menu-heading">pembayaran</div>
                <a class="nav-link text-dark " href="{{ route('pembayaran.index') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-money-bill-wave"></i></div>
                    Pembayaran
                </a>
                <a class="nav-link text-dark" href='/siswa/{{ $siswa->id }}' target='__blank'>
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-file-invoice-dollar"></i></i></div>
                    Bukti Pembayaran
                </a>
            </div>
        </div>
    </nav>
</div>
