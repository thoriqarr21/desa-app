<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy"
    content="upgrade-insecure-requests">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- BEGIN: Theme CSS-->
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">


    <!-- Vendors CSS -->
<!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css'>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
     <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/style1.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/js/custom.js') }}"> --}}
    {{-- <link id="pagestyle" href="{{ asset('assets/css/corporate-ui-dashboard.css') }}" rel="stylesheet" /> --}}

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
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
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script> <!-- FullCalendar depends on Moment.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.2.0/fullcalendar.min.js"></script>
    <!-- FullCalendar CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.2.0/fullcalendar.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    <div id="app" class="flex-grow-1">
        <header>
            @include('frontend.layouts.partials.menu')
        </header>

        <main class="main-content px-3">
                @yield('content')
        </main>
    </div>

    <footer>
        @include('frontend.layouts.partials.footer')
    </footer>
    <!-- JS FILES -->
{{-- <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/js/corporate-ui-dashboard.js') }}" defer></script> --}}
<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ asset('assets/js/plugins/swiper-bundle.min.js') }}"></script>
<script>
    setTimeout(() => {
        const alert = document.getElementById('alert-message');
        if (alert) {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500); 
        }
    }, 3000); // 3000ms = 3 detik

    document.addEventListener("DOMContentLoaded", function () {
  const elements = document.querySelectorAll('.card-animate');

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('animate');
      } else {
        entry.target.classList.remove('animate'); 
      }
    });
  }, {
    threshold: 0.1
  });

  elements.forEach(el => observer.observe(el));
});

</script>
</body>

</html>