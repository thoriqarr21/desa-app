@extends('frontend.layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Show Kategori Kegiatan</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('kategori_kegiatan.index') }}"> Back</a>
        </div>
    </div>
</div>

<div class="row">
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


@endsection
