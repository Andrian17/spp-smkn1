<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand" href="/siswa">E-spp</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a href="{{ route('pembayaran.index') }}" class="nav-link">
                  Pembayaran
                </a>
            </li>
            <li class="nav-item">
                <a href="/siswa/{{ $siswa->id }}/edit" class="nav-link">
                  Edit Data
                </a>
            </li>
            <li class="nav-item">
                <a href='/siswa/{{ $siswa->id }}' target='__blank' class="nav-link">
                  Bukti Pembayaran
                </a>
            </li>
          </ul>
         <!-- Authentication Links -->
         <ul class="navbar-nav ms-auto ">
            <li class="nav-item dropdown justify-content-end">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->siswa->nama }}
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
      </div>
    </div>
</nav>
