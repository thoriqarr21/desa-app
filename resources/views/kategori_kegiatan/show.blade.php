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
            <div class="card border-0 mb-4 w-40" style="box-shadow: 3px 3px 5px 1px rgb(181, 148, 241);">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-center">
                        <div class="d-flex align-items-center">
                            <h4 class="fw-bolder text-dark mb-0">
                                Show Kategori Kegiatan
                            </h4>
                        </div>
                    </div>
                </div>
            </div> 
            
        </div>
    </div>
    <h6 class="text-muted mb-3">
        Berikut adalah detail Kategori Kegiatan<strong style="font-weight :bold; color:#312f2f; font-size: 18px"> {{ $kategoriKegiatan->nama_kategori }}</strong> yang telah dibuat untuk mendukung dalam pengelolaan program desa secara efektif.
    </h6>
    <div class="card shadow-sm border-0">
        <div class="card-header bg-light px-4 py-3">
            <h5 class="mb-0">Informasi Kategori Kegiatan</h5>
            <small class="text-muted">Detail lengkap mengenai kategori kegiatan ini</small>
        </div>
        <div class="row p-4">
            <div class="info-item mb-3">
                <i class="fas fa-folder-open icon text-primary"></i>
                <div>
                    <p class="text-value mb-0 title-kegiatan">Nama Kategori Kegiatan</p>
                    <p class="text-label">{{ $kategoriKegiatan->nama_kategori }}</p>
                </div>
            </div>
            <div class="info-item mb-3">
                <i class="fas fa-align-left icon text-success"></i>
                <div>
                    <p class="text-value mb-0 title-kegiatan">Deskripsi Kegiatan</p>
                    <p class="text-label">{{ $kategoriKegiatan->deskripsi_kategori }}</p>
                </div>
            </div>
            <div class="info-item mb-3">
                <i class="fas fa-calendar-alt icon text-warning"></i>
                <div>
                    <p class="text-value mb-0 title-kegiatan">Tanggal Dibuat</p>
                    <p class="text-label">{{ $kategoriKegiatan->created_at->format('d M Y') }}</p>
                </div>
            </div>
        </div>
        <div class="card-footer bg-white px-4 py-3">
            <small class="text-muted">Pastikan informasi kategori ini selalu diperbarui untuk membantu pengelolaan kegiatan yang lebih baik.</small>
        </div>
    </div>
    
</div>


@endsection
