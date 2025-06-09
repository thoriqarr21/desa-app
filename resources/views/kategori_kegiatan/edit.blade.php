@extends('layouts.app')

@section('content')
<div class="container-fluid py-4 mb-5">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Kategori Kegiatan</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary btn-sm fs-6 mb-2" href="{{ route('kategori_kegiatan.index') }}"> <i class="fas fa-reply fs-6 me-2"></i>Back</a>
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
    <div class="card shadow-sm border-0 mb-5" style="background-color: #fcfcfc;">
        <div class="card-body p-4">
    <form method="POST" action="{{ route('kategori_kegiatan.update', $kategoriKegiatan->id) }}">
    @csrf
    @method('PUT')

    <div class="row">
        
        <div class="card-header px-4 py-3 mb-3" style="background-color: #f1f1f1">
            <h5 class="mb-0">Update Kategori Kegiatan</h5>
            <small class="text-muted">Form Edit Kategori Kegiatan</small></small>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama Kategori Kegiatan:</strong>
                <input type="text" name="nama_kategori" placeholder="Nama Kategori" class="form-control" value="{{ $kategoriKegiatan->nama_kategori }}">
            </div>
        </div>
        <div class="form-group">
            <strong>Deskripsi Kategori Kegiatan</strong>
            <textarea name="deskripsi_kategori" id="deskripsi_kategori" class="form-control" required>{{ $kategoriKegiatan->deskripsi_kategori }}</textarea>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary btn-sm mt-2 fs-6 mb-3"><i class="fa-solid fa-floppy-disk me-1" style="font-size: 15px"></i>Update</button>
        </div>
    </div>
</form>
</div>
</div>
</div>


@endsection
