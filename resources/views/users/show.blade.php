@extends('layouts.app')

@section('content')
<div class="container-fluid py-4 mb-5">
    <div class="row mb-3">
        <div class="col-lg-6">
            <h2>Detail User</h2>
        </div>
        <div class="col-lg-6 text-end">
            <a class="btn btn-primary" href="{{ route('users.index') }}">← Kembali</a>
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
