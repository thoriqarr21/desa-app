@extends('layouts.app')

@section('content')
<div class="container-fluid py-4 mb-5">
    <div class="d-flex justify-content-between align-items-center margin-tb">
        <div class="d-flex align-items-center ms-3 ">
            <a class="btn btn-primary btn-sm fs-5 d-flex align-items-center" 
            href="{{ route('users.index') }}" 
            style="height: 45px; padding: 0 20px;">
             <i class="fas fa-reply fs-6 me-2"></i>
             <span>Kembali</span>
         </a>                       
        </div>
    </div>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-6">
                <div class="card profile-card-minimal">
                    <div class="card-header-custom">
                        <h4>Profil Pengguna</h4>
                        <p>Detail Akun Lengkap</p>
                    </div>
    
                    <div class="card-body pt-0">
                        <div class="text-center mb-4">
                            @if($user->gambar)
                                <img src="{{ asset('storage/' . $user->gambar) }}" alt="Foto User" class="user-avatar-minimal">
                            @else
                                <div class="avatar-placeholder-minimal user-avatar-minimal bg-secondary d-flex align-items-center justify-content-center text-white">
                                    <span style="font-size: 2.5rem;">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                </div>
                            @endif
                        </div>
    
                        <div class="info-section-minimal">
                            <div class="info-item-minimal">
                                <strong>Nama:</strong>
                                <div>{{ $user->name }}</div>
                            </div>
    
                            <div class="info-item-minimal">
                                <strong>Username:</strong>
                                <div>{{ $user->username }}</div>
                            </div>
    
                            <div class="info-item-minimal">
                                <strong>Roles:</strong>
                                <div>
                                    @forelse($user->getRoleNames() as $role)
                                        <span class="badge badge-role-minimal">{{ $role }}</span>
                                    @empty
                                        <span class="text-muted">Tidak ada peran</span>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    
    .profile-card-minimal {
        border: none; 
        border-radius: 1rem; 
        overflow: hidden; 
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1); 
        background-color: #fff;
        transition: all 0.3s ease-in-out;
    }

    .profile-card-minimal:hover {
        transform: translateY(-5px); 
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15); 
    }

    .card-header-custom {
        background: linear-gradient(120deg, #6dd5ed, #2193b0); 
        color: white;
        padding: 2rem 1.5rem;
        border-bottom: none; 
        position: relative;
        text-align: center;
        border-top-left-radius: 1rem;
        border-top-right-radius: 1rem;
    }

    .card-header-custom h4 {
        font-weight: 700;
        margin-bottom: 0.25rem;
        font-size: 1.8rem;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
    }

    .card-header-custom p {
        font-size: 1rem;
        opacity: 0.9;
    }

   
    .user-avatar-minimal {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #ffffff; 
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2); 
        margin-top: -60px; 
        position: relative;
        z-index: 1; 
    }

 
    .info-section-minimal {
        padding: 1rem 2rem;
    }

    .info-item-minimal {
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px dashed #eee; 
    }

    .info-item-minimal:last-child {
        border-bottom: none; 
        margin-bottom: 0;
    }

    .info-item-minimal strong {
        display: block; 
        font-size: 0.9rem;
        color: #6c757d; 
        margin-bottom: 0.25rem;
    }

    .info-item-minimal div {
        font-size: 1.1rem;
        font-weight: 600;
        color: #343a40;
    }

    .badge-role-minimal {
        background-color: #28a745; 
        color: white;
        padding: 0.4em 0.8em;
        border-radius: 0.3rem;
        font-size: 0.85em;
        margin-right: 0.4rem;
        margin-bottom: 0.4rem;
        display: inline-block;
    }
</style>

@endsection
