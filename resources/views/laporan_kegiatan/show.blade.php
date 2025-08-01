@extends('layouts.app')

@section('content')
<div class="container-fluid py-2 mb-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start text-start margin-tb px-2">
        <!-- Tombol Kembali -->
        <div class="d-flex" style="padding-top: 15px;">
            <a class="btn btn-primary btn-sm fs-5 d-flex align-items-center" 
               href="{{ route('laporan_kegiatan.index') }}" 
               style="height: 45px; padding: 0 20px;">
                <i class="fas fa-reply fs-6 me-2"></i>
                <span>Kembali</span>
            </a>                       
        </div>
    
        <!-- Judul Detail -->
        <div class="card card-head border-0 mt-3 mt-md-0 mb-4 w-full" 
            style="box-shadow: 2px 2px 3px 1px rgb(143, 148, 251);">
            <div class="card-body p-3">
                <div class="d-flex justify-content-start align-items-start">
                    <h4 class="fw-bolder text-dark mb-0">
                        Detail Laporan Kegiatan
                    </h4>
                </div>
            </div>
        </div>          
    </div>
    <div class="container-fluid pe-1 ps-0">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex align-items-center">
                <i class="bi bi-info-circle me-2"></i>
                <h4 class="mb-0 text-white">Detail Kegiatan {{ $laporanKegiatan->kegiatan->nama_kegiatan }}</h4>
            </div>
    
            <div class="card-body">
                <div class="row mb-1">
                    <!-- Gambar + Info Pendek di Kiri -->
                    <div class="col-md-6">
                        <div class="p-3 mb-3">
                            <h5 class="mb-3"><i class="bi bi-info-circle me-2"></i>Info Kegiatan</h5>
                            
                            <div class="mb-2">
                                <strong><i class="bi bi-hash me-1"></i>Kode Kegiatan:</strong>
                                <div class="text-muted">{{ $laporanKegiatan->kode_kegiatan }}</div>
                            </div>
                
                            <div class="mb-2">
                                <strong><i class="bi bi-calendar-event me-1"></i>Tanggal Kegiatan:</strong>
                                <div class="text-muted">{{ $laporanKegiatan->kegiatan->tanggal_mulai }} s/d {{ $laporanKegiatan->kegiatan->tanggal_selesai }}</div>
                            </div>
                
                            <div class="mb-2">
                                <strong><i class="bi bi-clock me-1"></i>Waktu:</strong>
                                <div class="text-muted">{{ $laporanKegiatan->kegiatan->waktu_mulai }} WIB - {{ $laporanKegiatan->kegiatan->waktu_selesai }} WIB</div>
                            </div>
                
                            <div class="mb-2">
                                <strong><i class="bi bi-person-circle me-1"></i>Dibuat Oleh:</strong>
                                <div class="text-muted">{{ $laporanKegiatan->user->name }}</div>
                            </div>
                
                            <div class="mb-2">
                                <strong><i class="bi bi-flag me-1"></i>Status Laporan:</strong>
                                @if ($laporanKegiatan->is_approved == 1)
                                    <span class="badge text-bg-success">Disetujui</span>
                                @elseif ($laporanKegiatan->is_approved === 0)
                                    <span class="badge text-bg-danger">Ditolak</span>
                                @else 
                                    <span class="badge text-bg-warning text-dark">Pending</span>
                                @endif
                            </div>
                
                            @if ($laporanKegiatan->is_approved === 0)
                                <div class="mb-2">
                                    <strong><i class="bi bi-x-circle me-1"></i>Alasan Penolakan:</strong>
                                    <div class="text-muted">{{ $laporanKegiatan->keterangan_tolak }}</div>
                                </div>
                            @endif
                        </div>
                    </div>
                
                    <!-- Deskripsi & Evaluasi Kanan -->
                    <div class="col-md-6">
                        <div class="p-3">
                            <h5 class="mb-3"><i class="bi bi-journal-text me-2"></i>Detail Kegiatan</h5>
                
                            <div class="mb-2">
                                <strong><i class="bi bi-pencil-square me-1"></i>Nama Kegiatan:</strong>
                                <div class="text-muted">{{ $laporanKegiatan->kegiatan->nama_kegiatan }}</div>
                            </div>
                            <div class="mb-2">
                                <strong><i class="bi bi-pencil-square me-1"></i>Nama Kategori:</strong>
                                <div class="text-muted">{{ $laporanKegiatan->kegiatan->kategoriKegiatan->nama_kategori ?? '-' }}
                                </div>
                            </div>
                
                            <div class="mb-2">
                                <strong><i class="bi bi-chat-left-text me-1"></i>Deskripsi:</strong>
                                <div class="text-muted text-justify">{{ $laporanKegiatan->kegiatan->deskripsi_kegiatan }}</div>
                            </div>
                
                            <div class="mb-2">
                                <strong><i class="bi bi-clipboard-check me-1"></i>Keterangan Laporan:</strong>
                                <div class="text-muted">{{ $laporanKegiatan->keterangan }}</div>
                            </div>
                
                            <div class="mb-2">
                                <strong><i class="bi bi-emoji-smile me-1"></i>Hasil Kegiatan:</strong>
                                <div class="text-muted">{{ $laporanKegiatan->hasil }}</div>
                            </div>
                
                            <div class="mb-2">
                                <strong><i class="bi bi-bullseye me-1"></i>Tujuan Kegiatan:</strong>
                                <div class="text-muted">{{ $laporanKegiatan->tujuan_kegiatan }}</div>
                            </div>
                
                            <div class="mb-2">
                                <strong><i class="bi bi-graph-up-arrow me-1"></i>Evaluasi:</strong>
                                <div class="text-muted">{{ $laporanKegiatan->evaluasi }}</div>
                            </div>
                        </div>
                    </div>        
            </div>
        </div>
    </div>
    
    <!-- Dokumentasi -->
    <div class="card shadow-sm border-0 p-4 mt-4">
        <div class="bg-primary bg-gradient text-white p-3 rounded mb-3 d-flex align-items-center">
            <i class="bi bi-camera me-2 fs-4"></i>
            <h4 class="mb-0">📸 Dokumentasi Kegiatan</h4>
        </div>
    
        <div class="row mt-3">
            @forelse ($laporanKegiatan->dokumentasi as $dok)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm rounded border-0 animate__animated animate__fadeIn">
                        <div class="position-relative">
                            @if ($dok->file_type == 'image')
                                <img src="{{ asset('storage/' . $dok->file_path) }}" 
                                     class="card-img-top rounded-top img-hover" 
                                     alt="Dokumentasi"
                                     style="max-height: 250px; object-fit: cover;">
                                <span class="badge bg-success position-absolute top-0 start-0 m-2">Foto</span>
                            @else
                                <video controls class="w-100 rounded-top img-hover" 
                                       style="max-height: 250px; object-fit: cover;">
                                    <source src="{{ asset('storage/' . $dok->file_path) }}" 
                                            type="{{ \File::mimeType(public_path('storage/' . $dok->file_path)) }}">
                                    Browser Anda tidak mendukung video.
                                </video>
                                <span class="badge bg-warning position-absolute top-0 start-0 m-2 text-dark">Video</span>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-muted">Tidak ada dokumentasi tersedia.</p>
                </div>
            @endforelse
        </div>
    </div>
    
    </div>
<style>
.img-hover {
    transition: transform 0.3s ease;
}

.img-hover:hover {
    transform: scale(1.03);
    box-shadow: 0 8px 16px rgba(144, 178, 241, 0.761);
    border: 2px solid rgb(136, 164, 232);
}

.card .badge {
    font-size: 0.8rem;
    padding: 6px 10px;
    border-radius: 0.5rem;
}

.animate__animated.animate__fadeIn {
    animation-duration: 0.6s;
}

</style>
@endsection
