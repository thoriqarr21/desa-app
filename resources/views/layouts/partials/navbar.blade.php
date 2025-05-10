<nav class="navbar navbar-main navbar-expand-lg mx-5 px-0 shadow-sm rounded " id="navbarBlur" navbar-scroll="true">
  <div class="container-fluid py-1 px-2">
      <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-1 pb-0 pt-1 px-0 me-sm-6 me-5">
              <li class="breadcrumb-item text-sm "><a class="opacity-5 text-dark" href="{{ route('home') }}">Home</a></li>
                @if (Request::is('kegiatan*'))
                    <li class="breadcrumb-item text-sm active text-dark" aria-current="page">Kegiatan</li>
                @elseif (Request::is('proyek*'))
                    <li class="breadcrumb-item text-sm active text-dark" aria-current="page">Proyek</li>
                @elseif (Request::is('kategori*'))
                    <li class="breadcrumb-item text-sm active text-dark" aria-current="page">Kategori Kegiatan</li>
                @elseif (Request::is('laporan*'))
                    <li class="breadcrumb-item text-sm active text-dark" aria-current="page">Laporan Proyek</li>
                @else
                    <li class="breadcrumb-item text-sm active text-dark" aria-current="page">{{ ucfirst(last(request()->segments())) }}</li>
                @endif
          </ol>
          <h5 class="font-weight-bold mb-0">
            @if (Request::is('kegiatan*'))
            Kegiatan
            @elseif (Request::is('proyek*'))
            Proyek
            @elseif (Request::is('kategori*'))
            Kategori
            @elseif (Request::is('laporan*'))
            Laporan
            @else
            {{ ucfirst(last(request()->segments())) }}
            @endif
          </h5>
      </nav>
      <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
              <div class="input-group">
                  <span class="input-group-text text-body bg-white  border-end-0 ">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" fill="none"
                          viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round"
                              d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                      </svg>
                  </span>
                  <input type="text" class="form-control ps-0" placeholder="Search">
              </div>
          </div>
          <div class="mb-0 font-weight-bold breadcrumb-text text-white">
              <form id="logout-form" method="POST" action="{{ route('logout') }}" >
                  @csrf

                  <a href="login" onclick="event.preventDefault();
              this.closest('form').submit();">
                      <button class="btn btn-sm  btn-white  mb-0 me-1" type="submit">Log out</button>
                  </a>
              </form>
          </div>
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
              <li class="nav-item ps-2 d-flex align-items-center">
                  <a href="{{ route('users.profile') }}" class="nav-link text-body p-0">
                    <img src="{{ asset('assets/img/team-2.jpg') }}" class="avatar avatar-sm" alt="avatar" />
                  </a>
              </li>
          </ul>
      </div>
  </div>
</nav>
<!-- End Navbar -->