@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-lg-12 margin-tb d-flex justify-content-between align-items-center">
            <div class="pull-left">
                <h2>Create New Role</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary btn-sm mb-2 fs-6" href="{{ route('roles.index') }}">
                    <i class="fas fa-reply fs-6"></i> Back
                </a>
            </div>
        </div>
    </div>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif
</div>

<div class="container mt-4">
    <div class="card p-3 rounded-8">
        <form method="POST" action="{{ route('roles.store') }}">
            @csrf

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group mb-3">
                        <strong>Nama Role :</strong>
                        <input type="text" name="name" placeholder="Masukkan Nama Role" class="form-control mt-2">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group mb-3">
                        <strong>Pilih Permission :</strong>
                        <div class="row mt-2">
                            @foreach($permission as $value)
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                    <label class="form-check-label d-block">
                                        <input type="checkbox" name="permission[{{$value->id}}]" value="{{$value->id}}" class="name me-1">
                                        {{ $value->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary btn-sm mb-3 fs-6">
                        <i class="fa-solid fa-floppy-disk" style="font-size: 15px"></i> Submit
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection
