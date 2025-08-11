<nav class="navbar navbar-main navbar-expand-lg mx-md-5 px-lg-0 shadow-sm rounded " id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-2 rounded-2" style="box-shadow: 0px 5px 15px 0px rgba(61, 61, 61, 0.709);">
        @php
        $segment = request()->segment(1);
    @endphp
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-1 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="text-secondary" href="{{ route('home') }}">Home</a></li>
    
            @if ($segment == 'kegiatan')
                <li class="breadcrumb-item text-sm active text-dark fw-bold opacity-8" aria-current="page">Kegiatan</li>
            @elseif ($segment == 'proyek')
                <li class="breadcrumb-item text-sm active text-dark fw-bold opacity-8" aria-current="page">Proyek</li>
            @elseif ($segment == 'kategori')
                <li class="breadcrumb-item text-sm active text-dark fw-bold opacity-8" aria-current="page">Kategori Kegiatan</li>
            @elseif ($segment == 'laporankegiatan')
                <li class="breadcrumb-item text-sm active text-dark fw-bold opacity-8" aria-current="page">Laporan Kegiatan</li>
            @elseif ($segment == 'laporan')
                <li class="breadcrumb-item text-sm active text-dark fw-bold opacity-8" aria-current="page">Laporan Proyek</li>
            @else
                <li class="breadcrumb-item text-sm active text-dark fw-bold opacity-8" aria-current="page">{{ ucwords(str_replace('_', ' ', $segment)) }}</li>
            @endif
        </ol>
    
        <h5 class="font-weight-bold mb-0">
            @if ($segment == 'kegiatan')
                Kegiatan
            @elseif ($segment == 'proyek')
                Proyek
            @elseif ($segment == 'kategori')
                Kategori
            @elseif ($segment == 'laporankegiatan')
                Laporan Kegiatan
            @elseif ($segment == 'laporan')
                Laporan Proyek
            @else
                {{ ucwords(str_replace('_', ' ', $segment)) }}
            @endif
        </h5>
    </nav>
    
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                  <div class="sidenav-toggler-inner me-2">
                      <i class="sidenav-toggler-line" style="background-color: rgb(53, 213, 69); height: 3px; width: 20px;"></i>
                      <i class="sidenav-toggler-line" style="background-color: rgb(0, 153, 255); height: 3px; width: 20px;"></i>
                      <i class="sidenav-toggler-line" style="background-color: rgb(226, 37, 37); height: 3px; width: 20px;"></i>
                  </div>
              </a>
          </li> 
          <li class="nav-item dropdown ms-3 me-2">
            <a id="navbarDropdown" class="nav-linkdropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                <img src="{{ asset('storage/' . Auth::user()->gambar) }}" class="avatar avatar-sm" alt="avatar" />
            </a>

            <div class="dropdown-menu dropdown-menu-end shadow-sm rounded-3" aria-labelledby="navbarDropdown" style="min-width: 180px;">
    
                <a class="dropdown-item d-flex align-items-center fs-6 text-primary" href="{{ route('users.profile') }}">
                    <i class="fas fa-user me-2"></i></i> Profil
                </a>
            
                <a class="dropdown-item d-flex align-items-center fs-6 text-danger" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                   <i class="fas fa-sign-out-alt me-2"></i> Logout
                </a>
            
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            
            </div>
            
            
        </li>         

          </ul>
      
  </div>
</nav>
<!-- End Navbar -->
