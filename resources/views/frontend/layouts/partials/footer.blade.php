<footer class="bg-light py-4 text-center border-top">
    <div class="container">
        <div class="fw-bold fs-4 text-secondary mb-3 pt-2">Website Desa Bojong Gede</div>

        <div class="d-flex flex-wrap justify-content-center mb-4 gap-3">
            <a href="{{ route('frontend.laporan_proyek.index') }}" class="text-secondary text-decoration-none">Laporan Proyek</a>
            <a href="{{ route('frontend.laporan_kegiatan.index') }}" class="text-secondary text-decoration-none">Laporan Kegiatan</a>
            <a href="{{ route('frontend.kegiatan.index') }}" class="text-secondary text-decoration-none">Kegiatan</a>
            <a href="{{ route('frontend.proyek.index') }}" class="text-secondary text-decoration-none">Proyek</a>
            <a href="{{ route('frontend.profile') }}" class="text-secondary text-decoration-none">Profil</a>
        </div>
        
        <h5 class="mb-3 text-secondary">Ikuti Kami</h5>

        <div class="mb-4 social-icons">
            <a href="https://www.instagram.com/desa_bojonggede/" class="text-decoration-none text-secondary fs-4 mx-2"><i class="fab fa-instagram"></i></a>
            <a href="https://www.facebook.com/profile.php?id=100063759740517&amp%3Bamp%3Bmibextid=ZbWKwL" class="text-decoration-none text-secondary fs-4 mx-2"><i class="fab fa-facebook-f"></i></a>
            <a href="https://x.com/DesaBojonggede" class="text-decoration-none text-secondary fs-4 mx-2"><i class="fab fa-twitter"></i></a>
            <a href="https://www.youtube.com/@tvdesabojonggedemaju" class="text-decoration-none text-secondary fs-4 mx-2"><i class="fab fa-youtube"></i></a>
            <a href="https://bojonggede-bojonggede.desa.id/" class="text-decoration-none text-secondary fs-4 mx-2"><i class="fab fa-chrome"></i></a>
        </div>

        <div class="foot text-secondary large">
            &copy; Desa Bojong Gede Copyright {{ date('Y') }}. All Rights Reserved.
        </div>
    </div>
</footer>

<style>
    body {
        font-family: 'Poppins', sans-serif;
    }

    footer a {
        transition: all 0.3s ease;
        font-size: 15px;
        font-weight: 500;
    }
    .foot {
        border-top: 1px solid rgb(220, 220, 220);
        padding-top: 15px;
    }
    .social-icons a {
        position: relative;
        display: inline-block;
        color: #6c757d; 
        transition: all 0.4s ease;
    }

    .social-icons a:hover {
        color: transparent;
        transform: scale(1.2) rotate(15deg);
        animation: gradientShift 3s linear infinite;
        filter: drop-shadow(0 0 6px #198754);
    }

    .social-icons a:hover i {
        background: linear-gradient(45deg, #198754, #64c69d, #198754);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: gradientShift 3s linear infinite;
        filter: drop-shadow(0 0 6px #198754);
    }

    /* Animasi gradient bergerak */
    @keyframes gradientShift {
        0% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
        100% {
            background-position: 0% 50%;
        }
    }

    footer h5 {
        font-weight: 600;
        animation: fadeInDown 1.5s ease;
    }

    footer a:hover {
        color: #0f8b0d !important;
        transform: translateY(-3px);
    }

    footer .fw-bold {
        animation: fadeInDown 1.5s ease;
    }

    @keyframes fadeInDown {
        0% {
            opacity: 0;
            transform: translateY(-10px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
