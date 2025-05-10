<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- BEGIN: Theme CSS-->
<!-- Fonts -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap" rel="stylesheet">

    <!-- Leaflet JS -->
<!-- Menambahkan CSS untuk Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

<!-- Menambahkan JS untuk Leaflet -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <!-- Pricing Modal JS-->
@stack('pricing-script')
<!-- END: Pricing Modal JS-->
<!-- BEGIN: Page JS-->
@yield('page-script')

<!-- Vendor Styles -->
@yield('vendor-style')


<!-- Page Styles -->
@yield('page-style')
<!-- Bootstrap JS & Popper.js (untuk dropdown, modal, dll) -->


<link id="pagestyle" href="{{ asset('assets/css/corporate-ui-dashboard.css?v=1.0.0') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('assets/css//style.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>
<body class="d-flex flex-column min-vh-100 g-sidenav-show bg-gray-100">
    <div id="app" class="flex-grow-1 d-flex">
        
        {{-- Sidebar (bukan bagian dari header) --}}
        @include('layouts.partials.sidebar')
        
        <div class="main-content flex-grow-1 d-flex flex-column position-relative h-100g">
            
            {{-- Navbar di dalam header --}}
            <header>
                @include('layouts.partials.navbar')
            </header>

            {{-- Konten --}}
            <main class="flex-grow-1 px-3 py-4">
                @yield('content')
            </main>

            {{-- Footer --}}
            <footer class="footer">
                @include('layouts.partials.footer')
            </footer>
        </div>
    </div>

    <!-- JS FILES -->
<script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/corporate-ui-dashboard.js') }}"></script>
<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/swiper-bundle.min.js') }}"></script>


</body>

</html>
