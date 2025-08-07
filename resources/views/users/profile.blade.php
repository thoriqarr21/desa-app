@extends('layouts.app')

@section('content')
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

                    @foreach (['success', 'primary', 'danger'] as $type)
                    @if(session($type))
                        <div class="alert alert-{{ $type }}" role="alert" id="alert-message">{{ session($type) }}</div>
                    @endif
                    @endforeach
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="d-flex align-items-center mb-4">
                        <div class="profile-image-wrapper" style="width: 100px; height: 100px; border-radius: 50%; overflow: hidden; border: 4px solid #1b1b1b; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);">
                            @if($user->gambar)
                                <img src="{{ asset('storage/' . $user->gambar) }}" alt="Foto Profil" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=5e35b1&color=fff&size=128" alt="Foto Profil" class="img-fluid">
                            @endif
                        </div>
                        <div class="ms-3">
                            <h5 class="mb-0" style="color: #303030; font-weight: bold;">{{ $user->name }}</h5>
                            <small class="text-muted">{{ $user->username }}</small><br>
                            <button class="btn btn-sm btn-outline-primary mt-2" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                                Ubah Profil
                            </button>
                        </div>
                    </div>

                    <hr class="my-4 border border-dark opacity-50">
                    
                    <h5 class="mb-4"><i class="fas fa-key text-dark me-2"></i>Ganti Password</h5>
                    <form method="POST" action="{{ route('users.updatePassword') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Password Saat Ini</label>
                            <input type="password" name="current_password" class="form-control" required>
                            @error('current_password')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password Baru</label>
                            <input type="password" name="new_password" class="form-control" required>
                            @error('new_password')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" name="new_password_confirmation" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-dark w-100">Perbarui Password</button>
                    </form>

                </div>
                <div class="modal" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editProfileModalLabel">Ubah Profil</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('updateProfile') }}" method="POST" enctype="multipart/form-data">
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