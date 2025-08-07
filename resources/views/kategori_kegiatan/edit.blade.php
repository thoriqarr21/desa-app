@extends('layouts.app')

@section('content')
<div class="container-fluid py-4 mb-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start text-start margin-tb px-2">
        <!-- Tombol Kembali -->
        <div class="d-flex" style="padding-top: 15px;">
            <a class="btn btn-primary btn-sm fs-5 d-flex align-items-center" 
               href="{{ route('kategori_kegiatan.index') }}" 
               style="height: 45px; padding: 0 20px;">
                <i class="fas fa-reply fs-6 me-2"></i>
                <span>Kembali</span>
            </a>                       
        </div>
    
        <!-- Judul Tambah Kategori -->
        <div class="card card-head border-0 mt-3 mt-md-0 mb-4 w-full" 
             style="box-shadow: 2px 2px 3px 1px rgb(219, 219, 219);">
            <div class="card-body p-3">
                <div class="d-flex justify-content-start align-items-start">
                    <h4 class="fw-bolder text-dark mb-0">
                        Update Kategori Kegiatan
                    </h4>
                </div>
            </div>
        </div>          
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
                <label class="form-label">Nama Kategori Kegiatan:</label>
                <input type="text" name="nama_kategori" placeholder="Nama Kategori" class="form-control" value="{{ $kategoriKegiatan->nama_kategori }}">
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">Deskripsi Kategori Kegiatan</label>
            <textarea name="deskripsi_kategori" id="deskripsi_kategori" class="form-control text-long" required>{{ $kategoriKegiatan->deskripsi_kategori }}</textarea>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <button type="submit" class="btn btn-primary mt-4 fs-6" style="height: 40px; width: 140px"></i>Update</button>
        </div>
    </div>
</form>
</div>
</div>
</div>


@endsection
