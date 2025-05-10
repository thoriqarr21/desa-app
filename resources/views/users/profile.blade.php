@extends('layouts.app')

@section('content')
<div class="container-fluid py-4 mb-5">
    <div class="card shadow-sm border-0 mb-5" style="background-color: #f8f9fa;">
        <div class="card-body p-4">
            <h2 class="text-center mb-4" style=" color: #5e35b1;">Profil Saya</h2>

            @if(session('success'))
                <div class="alert alert-success text-center" style="border-radius: 10px;">
                    {{ session('success') }}
                </div>
            @endif
            
            @if($errors->any())
                <div class="alert alert-danger text-center" style="border-radius: 10px;">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <div class="card shadow-sm border-0 mb-4" style="border-radius: 15px; background-color: #f8f9fa;">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="profile-image-wrapper" style="width: 80px; height: 80px; border-radius: 50%; overflow: hidden; border: 3px solid #5e35b1; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
                            @if($user->profile_picture)
                                <img src="{{ $user->profile_picture }}" alt="Foto Profil" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=5e35b1&color=fff&size=128" alt="Foto Profil" class="img-fluid">
                            @endif
                        </div>
                        <div class="ms-3">
                            <h5 class="mb-0" style="color: #4b3b75;">{{ $user->name }}</h5>
                            <small class="text-muted">{{ $user->username }}</small>
                        </div>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <p class="mb-1"><strong>Nama:</strong> <span style="color: #5e35b1;">{{ $user->name }}</span></p>
                        <p class="mb-1"><strong>Username:</strong> <span style="color: #5e35b1;">{{ $user->username }}</span></p>
                    </div>
                </div>
            </div>

            <hr class="my-4 border border-primary opacity-50">

            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-4"><i class="fas fa-key text-primary me-2"></i>Ganti Password</h5>
                    <form method="POST" action="{{ route('users.updatePassword') }}">
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
                        <button type="submit" class="btn btn-primary">Perbarui Password</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
