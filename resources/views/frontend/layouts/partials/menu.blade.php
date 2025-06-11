<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm border-bottom fixed-top animated-navbar">
    <div class="container-fluid">
        <div class="logo-link-wrapper">
            <img class="logo" src="{{ asset('assets/img/logo_pemkab_bogor.jpg') }}" alt="logo">
            <a href="{{ route('frontend.index') }}" class="logo-text">Desa Bojong Gede</a>
        </div>
        <button class="navbar-toggler border-0" type="button" onclick="toggleMobileMenu()">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        {{-- Mobile Overlay Menu --}}
        <div id="mobileNav" class="mobile-nav-overlay d-none">
            <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                <div class="logo-link-wrapper">
                    <img class="logo" src="{{ asset('assets/img/logo_pemkab_bogor.jpg') }}" alt="logo">
                    <a href="#" class="logo-text fw-bold">Desa Bojong Gede</a>
                </div>
                <button class="btn fs-2" onclick="toggleMobileMenu()">×</button>
            </div>
            <ul class="list-unstyled m-0 p-0">
                @guest
                    <li><a href="{{ route('login') }}" class="mobile-nav-link">Login</a></li>
                    <li><a href="{{ route('register') }}" class="mobile-nav-link">Register</a></li>
                @else
                    @can('laporan-list')
                        <li><a href="{{ route('frontend.laporan_proyek.index') }}" class="mobile-nav-link">Laporan Proyek</a></li>
                    @endcan
                    <li><a href="{{ route('frontend.laporan_kegiatan.index') }}" class="mobile-nav-link">Laporan Kegiatan</a></li>
                    <li><a href="{{ route('frontend.kegiatan.index') }}" class="mobile-nav-link">Kegiatan</a></li>
                    <li><a href="{{ route('frontend.proyek.index') }}" class="mobile-nav-link">Proyek</a></li>
                    <li><a href="{{ route('frontend.profile') }}" class="mobile-nav-link">Profil</a></li>
                    <li>
                        <a href="{{ route('logout') }}" class="mobile-nav-link text-danger"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                    </li>
                @endguest
            </ul>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto align-items-center gap-3">
                @guest
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}" href="{{ route('register') }}">Register</a>
                    </li>
                @else
                    @can('laporan-list')
                        <li>
                            <a class="nav-link {{ request()->routeIs('frontend.laporan_proyek.index') ? 'active' : '' }}"
                               href="{{ route('frontend.laporan_proyek.index') }}">Laporan Proyek</a>
                        </li>
                    @endcan
                    <li>
                        <a class="nav-link {{ request()->routeIs('frontend.laporan_kegiatan.index') ? 'active' : '' }}"
                           href="{{ route('frontend.laporan_kegiatan.index') }}">Laporan Kegiatan</a>
                    </li>
                    <li>
                        <a class="nav-link {{ request()->routeIs('frontend.kegiatan.index') ? 'active' : '' }}"
                           href="{{ route('frontend.kegiatan.index') }}">Kegiatan</a>
                    </li>
                    <li>
                        <a class="nav-link {{ request()->routeIs('frontend.proyek.index') ? 'active' : '' }}"
                           href="{{ route('frontend.proyek.index') }}">Proyek</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle fw-semibold d-flex align-items-center" href="#" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ asset('storage/' . Auth::user()->gambar) }}" class="avatar avatar-sm rounded-circle me-2" alt="avatar" style="width: 25px" />
                        {{ Auth::user()->name }}
                     </a>
                     
                        <div class="custom-dropdown dropdown-menu dropdown-menu-end shadow-sm">
                            <a class="dropdown-item text-primary fw-bold" href="{{ route('frontend.profile') }}">
                                <i class="fas fa-user me-2 "></i> Profil
                            </a>
                            <a class="dropdown-item text-danger fw-bold" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<style>
    .animated-navbar {
    transition: all 0.4s ease-in-out;
}

.animated-navbar .nav-link {
    position: relative;
    font-weight: 500;
    color: #333;
    /* transition: 0.3s ease-in-out; */
}

.animated-navbar .nav-link::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -4px;
    width: 0%;
    height: 2px;
background: linear-gradient(90deg,rgba(0, 255, 25, 1) 0%, rgba(115, 222, 140, 1) 48%, rgba(189, 230, 67, 1) 100%);
    transition: width 0.3s;

}

.animated-navbar .nav-link:hover::after,
.animated-navbar .nav-link.active::after {
    width: 100%;
}

.animated-navbar .nav-link.active {
    color: #353535;
    font-weight: bold;
}

.animated-brand {
    font-size: 1.4rem;
    letter-spacing: 0.5px;
    animation: fadeSlideIn 0.8s ease forwards;
}

@keyframes fadeSlideIn {
    0% {
        opacity: 0;
        transform: translateX(-10px);
    }
    100% {
        opacity: 1;
        transform: translateX(0);
    }
}

</style>
<script>
    function toggleMobileMenu() {
        const nav = document.getElementById('mobileNav');
        nav.classList.toggle('d-none');
    }
</script>