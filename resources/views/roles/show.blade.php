@extends('layouts.app')

@section('content')
<div class="ccontainer-fluid py-3 mb-5 mx-5">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Role</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary fs-6" href="{{ route('roles.index') }}"> <i class="fas fa-reply fs-6"></i> Back</a>
            </div>
        </div>
    </div>

    <div class="card rounded-8">
        <div class="card-header bg-primary text-white d-flex align-items-center">
            <i class="bi bi-info-circle me-2"></i>
            <h4 class="mb-0 text-white">Detail Role</h4>
        </div>
        <div class="p-3">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 mb-1">
                    <div class="form-group">
                        <strong>Nama Role :</strong>
                        <div class="mt-2">
                            {{ $role->name }}
                        </div>
                    </div>
                </div>
    
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Permissions :</strong>
                        <div class="row mt-2">
                            @if(!empty($rolePermissions))
                                @foreach($rolePermissions as $v)
                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 mb-2">
                                        <span class="d-inline-block px-3 py-1 bg-primary text-white fw-semibold rounded-pill shadow-sm">
                                            {{ $v->name }}
                                        </span>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-12">
                                    <em>Tidak ada permission</em>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
