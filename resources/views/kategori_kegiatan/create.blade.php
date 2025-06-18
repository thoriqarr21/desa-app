@extends('layouts.app')

@section('content')

<div class="container-fluid py-4 mb-5">
    <div class="row">
        <div class="d-flex justify-content-between align-items-center margin-tb">
            <div class="d-flex align-items-center ms-3 ">
                <a class="btn btn-primary btn-sm fs-5 d-flex align-items-center" 
                href="{{ route('kategori_kegiatan.index') }}" 
                style="height: 45px; padding: 0 20px;">
                 <i class="fas fa-reply fs-6 me-2"></i>
                 <span>Kembali</span>
             </a>                       
            </div>
            <div class="card border-0 rounded-5 mb-4 w-full sm:w-2/3 md:w-1/2 lg:w-1/3" style="box-shadow: 3px 3px 5px 1px rgb(181, 148, 241);">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-center">
                        <div class="d-flex align-items-center">
                            <h4 class="fw-bolder text-dark mb-0">
                                Tambah Kategori Kegiatan
                            </h4>
                        </div>
                    </div>
                </div>
            </div> 
            
        </div>
        
    </div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="card shadow-sm border-0 mb-5" style="background-color: #f8f9fa;">
    <div class="card-body p-4">
<form action="{{ route('kategori_kegiatan.store') }}" method="POST">
    @csrf

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label class="form-label">Nama Kategori:</label>
                <input type="text" name="nama_kategori" class="form-control" placeholder="Nama Kategori">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label class="form-label">Deskripsi Kategori:</label>
                <textarea class="form-control" style="height:150px" name="deskripsi_kategori" placeholder="Deskripsi Kategori Kegiatan"></textarea>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary btn-sm fs-6 mt-2 mb-3"><i class="fa-solid fa-floppy-disk me-1" style="font-size: 12px"></i>Create</button>
        </div>
    </div>
</form>
</div>
</div>
</div>

@endsection
