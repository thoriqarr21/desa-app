@extends('layouts.app')

@section('content')
<div class="container-fluid py-2 mb-5">
    <div class="d-flex justify-content-between align-items-center margin-tb">
        <div class="d-flex align-items-center ms-3 ">
            <a class="btn btn-primary btn-sm fs-6 " href="{{ route('laporan_kegiatan.index') }}"><i class="fas fa-reply fs-6"></i> Kembali</a>
            <a href="{{ route('laporan_kegiatan.cetak', $laporanKegiatan->id) }}" class="btn btn-sm btn-dark ms-2 fs-6" target="_blank">
                Cetak PDF
            </a>
        </div>
        
        <div class="card border-0 mb-4 w-40" style="box-shadow: 3px 3px 5px 1px rgb(181, 148, 241);">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-center">
                    <div class="d-flex align-items-center">
                        <h4 class="fw-bold text-dark mb-0">
                            Detail Laporan
                        </h4>
                    </div>
                </div>
            </div>
        </div> 
    </div>
    <div class="row mb-3">
        <!-- Info Kegiatan Kiri -->
        <div class="col-md-5">
            <div class="card shadow-sm border-0 p-3 mb-3">
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
        <div class="col-md-7">
            <div class="card shadow-sm border-0 p-3">
                <h5 class="mb-3"><i class="bi bi-journal-text me-2"></i>Detail Kegiatan</h5>
    
                <div class="mb-2">
                    <strong><i class="bi bi-pencil-square me-1"></i>Nama Kegiatan:</strong>
                    <div class="text-muted">{{ $laporanKegiatan->kegiatan->nama_kegiatan }}</div>
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
    
    <!-- Dokumentasi -->
    <div class="card shadow-sm border-0 p-4 mt-4">
        <h4><i class="bi bi-camera me-2"></i>📸 Dokumentasi Kegiatan</h4>
        <div class="row mt-3">
            @forelse ($laporanKegiatan->dokumentasi as $dok)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm rounded">
                        @if ($dok->file_type == 'image')
                            <img src="{{ asset('storage/' . $dok->file_path) }}" class="card-img-top rounded-top" alt="Dokumentasi" style="max-height: 250px; object-fit: cover;">
                        @else
                            <video controls class="w-100 rounded-top" style="max-height: 250px; object-fit: cover;">
                                <source src="{{ asset('storage/' . $dok->file_path) }}" type="{{ \File::mimeType(public_path('storage/' . $dok->file_path)) }}">
                                Browser Anda tidak mendukung video.
                            </video>
                        @endif
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
    @endsection
