@extends('frontend.layouts.master')

@section('content')
<style>
    @media (max-width: 768px) {
        .container-fluid {
            padding-left: 0; 
            padding-right: 0; 
        }
    }
    /* Animasi untuk kartu profil */
    .card {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    /* .card:hover {
        transform: translateY(-5px); 
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15); 
    } */

    .profile-image-wrapper {
        transition: transform 0.4s ease-in-out, border-color 0.4s ease-in-out;
        position: relative; 
        overflow: hidden; 
    }

    .profile-image-wrapper img {
        transition: transform 0.4s ease-in-out;
    }

    .profile-image-wrapper:hover img {
        transform: scale(1.05); 
    }

 
    .profile-image-wrapper::after {
        content: '';
        position: absolute;
        top: -4px;
        left: -4px;
        right: -4px;
        bottom: -4px;
        border: 4px solid transparent;
        border-radius: 50%;
        transition: all 0.4s ease-in-out;
        opacity: 0;
        transform: scale(0.8);
    }

    .profile-image-wrapper:hover::after {
        border-color: #6eff7a; 
        opacity: 1;
        transform: scale(1);
        animation: pulseBorder 1.5s infinite ease-in-out;
    }

    @keyframes pulseBorder {
        0% {
            transform: scale(0.8);
            opacity: 0;
            border-color: #4cbb4e;
        }
        50% {
            transform: scale(1.05);
            opacity: 1;
            border-color: #6eff7a;
        }
        100% {
            transform: scale(0.8);
            opacity: 0;
            border-color: #4cbb4e;
        }
    }

    /* Efek untuk input form saat fokus */
    .form-control:focus {
        border-color: #4cbb4e;
        box-shadow: 0 0 0 0.25rem rgba(76, 187, 78, 0.25);
    }

    /* Animasi untuk tombol submit */
    .btn-success {
        transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.2s ease;
        background-color: #4cbb4e;
        border-color: #4cbb4e;
    }

    .btn-success:hover {
        background-color: #3aa83c; /* Warna lebih gelap saat hover */
        border-color: #3aa83c;
        transform: translateY(-2px); /* Sedikit naik */
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .btn-success:active {
        transform: translateY(0); /* Kembali ke posisi semula saat diklik */
        box-shadow: none;
    }
    h2 {
transition: color 0.3s ease-in-out;
}

h2:hover {
    color: #5e35b1; /* Contoh: berubah warna saat hover */
}

/* Animasi untuk nama profil */
h4 {
    transition: transform 0.2s ease-in-out;
}

h4:hover {
    transform: scale(1.03); /* Sedikit membesar saat hover */
}

/* Animasi untuk username */
small.text-muted {
    display: inline-block; /* Agar transform bisa diterapkan */
    transition: transform 0.2s ease-in-out, color 0.2s ease-in-out;
    font-size: 14px;
    color: #2d2d2d;
    font-weight: 600;
}

small.text-muted:hover {
    transform: translateY(-2px); /* Sedikit naik saat hover */
    color: #4cbb4e;
}

/* Animasi untuk heading bagian (Ganti Password) */
h5 {
    position: relative;
    overflow: hidden;
    transition: color 0.3s ease-in-out;
}

h5::before {
    content: &#39;&#39;;
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0%;
    height: 2px;
    background-color: #4cbb4e;
    transition: width 0.3s ease-in-out;
}

h5:hover {
    color: #303030; /* Warna teks tetap atau bisa diubah */
}

h5:hover::before {
    width: 100%; /* Garis bawah muncul saat hover */
}

/* Animasi untuk label form */
.form-label {
    display: inline-block; /* Memungkinkan transformasi */
    transition: transform 0.2s ease-in-out, color 0.2s ease-in-out;
}

.form-label:hover {
    transform: translateX(5px); /* Sedikit geser ke kanan saat hover */
    color: #4cbb4e;
}

/* Animasi untuk pesan sukses */
.alert-success {
    transition: background-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
}

.alert-success:hover {
    background-color: #41a743; /* Sedikit lebih gelap */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

/* Animasi untuk pesan error */
.alert-danger {
    transition: background-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
}

.alert-danger:hover {
    background-color: #c82333; /* Sedikit lebih gelap */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}
.animasi-hr {
    padding: 0;
    border: 0;
    height: 3px;
    background: linear-gradient(270deg, #0be82c, #f21010, #0d6efd);
    background-size: 600% 600%;
    width: 80%;
    animation: moveGradient 3s ease infinite, expandHr 1s ease-out forwards;
    border-radius: 10px;
}

@keyframes expandHr {
    from {
        width: 0%;
    }
    to {
        width: 100%;
    }
}

@keyframes moveGradient {
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
@keyframes fadeInUp {
  0% {
    opacity: 0;
    transform: translateY(40px);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes slideInLeft {
  0% {
    opacity: 0;
    transform: translateX(-50px);
  }
  100% {
    opacity: 1;
    transform: translateX(0);
  }
}

@keyframes pulseGlow {
  0% {
    box-shadow: 0 0 0 rgba(76, 187, 78, 0.5);
  }
  50% {
    box-shadow: 0 0 15px rgba(76, 187, 78, 0.6);
  }
  100% {
    box-shadow: 0 0 0 rgba(76, 187, 78, 0.5);
  }
}

@keyframes scaleIn {
  0% {
    transform: scale(0.19);
    opacity: 0;
  }
  100% {
    transform: scale(1);
    opacity: 1;
  }
}
/* ANIMASI MASUK UNTUK H5 */
h5.animated-title {
  opacity: 0;
  padding-left: 10px;
  transform: translateX(-30px);
  animation: slideFadeInLeft 0.8s ease-out forwards;
  animation-delay: 1s;
  transition: transform 0.3s ease, color 0.3s ease;
}

/* HOVER EFFECT UNTUK H5 */
h5.animated-title:hover {
  transform: scale(1.05);
  color: #4cbb4e;
}

/* ANIMASI ICON DALAM H5 */
h5.animated-title i {
  transition: transform 0.6s ease;
}

h5.animated-title:hover i {
  transform: rotate(20deg) scale(1.2);
}
.btn-profile {
    border: 2px solid #3aa83c;
    color: rgb(0, 0, 0);
    font-weight: 500;
}
.btn-profile:hover {
    background-color: #3aa83c;
    color: white;
    font-weight: 500;
}
/* KEYFRAME */
@keyframes slideFadeInLeft {
  from {
    opacity: 0;
    transform: translateX(-30px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

</style>

<div class="container-fluid py-4 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-lg border-0 mb-5" style="border-radius: 20px; background-color: #ffffff;">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <h2 class="text-dark" style="font-weight: bold;">Profil Saya</h2>
                        <p class="text-muted mb-0">Kelola informasi dan pengaturan akun Anda</p>
                        <p>Desa Bojonggede</p>
                    </div>

                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alertError">
                        <strong>Terjadi kesalahan!</strong> Silakan periksa kembali data yang Anda masukkan:
                        <ul class="mt-2 mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                    </div>
                    @endif

                    <div class="d-flex align-items-center mb-4">
                        <div class="profile-image-wrapper" style="width: 100px; height: 100px; border-radius: 50%; overflow: hidden; border: 4px solid #4cbb4e; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);">
                            @if($user->gambar)
                                <img src="{{ asset('storage/' . $user->gambar) }}" alt="Foto Profil" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=5e35b1&color=fff&size=128" alt="Foto Profil" class="img-fluid">
                            @endif
                        </div>
                        <div class="ms-3">
                            <h4 class="mb-0" style="color: #303030; font-weight: bold;">{{ $user->name }}</h4>
                            <small class="text-muted">{{ $user->username }}</small><br>
                            <button class="btn btn-sm btn-profile mt-2" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                                Ubah Profil
                            </button>
                        </div>
                    </div>
                    <div class="modal" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editProfileModalLabel">Ubah Profil</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('frontend.updateProfile') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT') {{-- Gunakan metode PUT untuk update --}}
                                    <div class="modal-body">
                                        <div class="mb-3 text-center">
                                            <div class="profile-image-upload-wrapper mx-auto" 
                                                 style="width: 120px; height: 120px; border-radius: 50%; overflow: hidden; border: 2px solid #ccc; cursor: pointer; display: flex; align-items: center; justify-content: center;"
                                                 id="profileImageClickArea">
                                                <img src="{{ $user->gambar ? asset('storage/' . $user->gambar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=5e35b1&color=fff&size=128' }}" 
                                                     alt="Foto Profil" 
                                                     class="img-fluid" 
                                                     style="width: 100%; height: 100%; object-fit: cover;"
                                                     id="previewGambar">
                                            </div>
                                            <small class="d-block mt-2 text-muted">Klik gambar untuk mengubah</small>
                                            
                                            <input type="file" class="form-control d-none" id="gambar" name="gambar" accept="image/*">
                                            
                                            @error('gambar')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                            @error('name')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $user->username) }}" required>
                                            @error('username')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4 border border-dark opacity-50 animasi-hr">

                    <h5 class="mb-4 animated-title">
                        <i class="fas fa-key text-dark me-2"></i>Ganti Password
                    </h5>
                    <form method="POST" action="{{ route('frontend.updatePassword') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Password Saat Ini</label>
                            <input type="password" name="current_password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password Baru</label>
                            <input type="password" name="new_password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" name="new_password_confirmation" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Perbarui Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('profileImageClickArea').addEventListener('click', function() {
        document.getElementById('gambar').click();
    });

    document.getElementById('gambar').addEventListener('change', function(event) {
        const [file] = event.target.files;
        if (file) {
            document.getElementById('previewGambar').src = URL.createObjectURL(file);
        }
    });

    
</script>
@endsection

{{-- <div class="mb-3">
    <p class="mb-1"><strong>Nama:</strong> <span style="color: #5e35b1;">{{ $user->name }}</span></p>
    <p class="mb-1"><strong>Username:</strong> <span style="color: #5e35b1;">{{ $user->username }}</span></p>
</div> --}}