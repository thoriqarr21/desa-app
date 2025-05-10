@extends('layouts.app')

@section('content')
<div class="container-fluid py-4 mb-5">
<div class="row">
    <div class="d-flex justify-content-between align-items-center margin-tb">
        <div class="d-flex align-items-center ms-3 ">
            <a class="btn btn-primary btn-sm fs-6 " href="{{ route('kategori_kegiatan.index') }}"><i class="fa fa-arrow-left fs-6"></i> Kembali</a>
        </div>
        <div class="card border-0 mb-4 w-40" style="box-shadow: 3px 3px 5px 1px rgb(181, 148, 241);">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-center">
                    <div class="d-flex align-items-center">
                        <h4 class="fw-bold text-dark mb-0">
                            Show Kategori Kegiatan
                        </h4>
                    </div>
                </div>
            </div>
        </div> 
        
    </div>
</div>
<div class="card shadow-sm border-0">
<div class="row p-4">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nama Kategori Kegiatan :</strong>
            {{ $kategoriKegiatan->nama_kategori }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Deskripsi Kegiatan :</strong>
            {{ $kategoriKegiatan->deskripsi_kategori }}
        </div>
    </div>
</div>
</div>
</div>


@endsection
