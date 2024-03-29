<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item nav-profile">
        <a href="#" class="nav-link">
          <div class="nav-profile-image">
            <img src="/assets/images/faces/face1.jpg" alt="profile">
            <span class="login-status online"></span>
            <!--change to offline or busy as needed-->
          </div>
          <div class="nav-profile-text d-flex flex-column">
            <span class="font-weight-bold mb-2">{{ Auth::user()->name }}</span>
            <span class="text-secondary text-small">{{ Auth::user()->role }}</span>
          </div>
          <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/admin">
          <span class="menu-title">Dashboard</span>
          <i class="mdi mdi-home menu-icon"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route("admin.semuaSiswa") }}">
          <span class="menu-title">Data Siswa</span>
          <i class="mdi mdi-contacts menu-icon"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route("admin.semuaPembayaran") }}">
          <span class="menu-title">Data Pembayaran</span>
          <i class="mdi mdi-format-list-bulleted menu-icon"></i>
        </a>
      </li>
      {{-- <li class="nav-item">
        <a class="nav-link" href="/dashboard/jurusan">
          <span class="menu-title">Data Jurusan</span>
          <i class="mdi mdi-chart-bar menu-icon"></i>
        </a>
      </li> --}}
    </ul>
</nav>
