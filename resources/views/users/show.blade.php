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
        <div class="card border-0 mb-4 w-30" style="box-shadow: 3px 3px 5px 1px rgb(181, 148, 241);">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-center">
                    <div class="d-flex align-items-center">
                        <h4 class="fw-bolder text-dark mb-0">
                        Users Detail
                        </h4>
                    </div>
                </div>
            </div>
        </div>   
    </div>

    <div class="card shadow-sm rounded p-4">
        <div class="row">
            @if($user->gambar)
                <div class="col-md-4 mb-3 text-center">
                    <img src="{{ asset('storage/' . $user->gambar) }}" alt="Foto User" class="img-fluid rounded shadow" style="max-height: 250px;">
                </div>
            @endif

            <div class="col-md-8">
                <div class="mb-3">
                    <strong>Nama:</strong>
                    <div>{{ $user->name }}</div>
                </div>

                <div class="mb-3">
                    <strong>Username:</strong>
                    <div>{{ $user->username }}</div>
                </div>

                <div class="mb-3">
                    <strong>Roles:</strong>
                    <div>
                        @foreach($user->getRoleNames() as $role)
                            <span class="badge bg-info text-dark">{{ $role }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
