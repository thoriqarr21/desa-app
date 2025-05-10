@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Show Kategori Proyek</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('kegiatan.index') }}"> Back</a>
        </div>
    </div>
</div>
<div class="container py-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white d-flex align-items-center">
            <i class="bi bi-info-circle me-2"></i>
            <h4 class="mb-0">Detail Kegiatan: {{ $kegiatan->nama_kegiatan }}</h4>
        </div>

        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <img src="{{ asset('storage/' . $kegiatan->gambar) }}" class="img-fluid rounded shadow" alt="Gambar Proyek">
                </div>
                <div class="col-md-6">
                    <div class="mb-3 mt-4 mt-md-0">
                        <strong><i class="bi bi-pencil-square me-1"></i>Deskripsi:</strong>
                        <div class="text-muted">{{ $kegiatan->deskripsi_kegiatan }}</div>
                    </div>
                    <div class="mb-3">
                        <strong><i class="bi bi-diagram-3 me-1"></i>Nama Pembuat:</strong>
                        <div class="text-muted">{{ ucfirst($kegiatan->user->name) }}</div>
                    </div>
                    <div class="mb-3">
                        <strong><i class="bi bi-diagram-3 me-1"></i>Kategori Kegiatan:</strong>
                        <div class="text-muted">{{ ucfirst($kegiatan->kategoriKegiatan->nama_kategori) }}</div>
                    </div>
                    {{-- <div class="mb-3">
                        <strong><i class="bi bi-cash-stack me-1"></i>Anggaran:</strong>
                        <div class="text-muted">Rp {{ number_format($kegiatan->anggaran, 0, ',', '.') }}</div>
                    </div> --}}
                    <div class="mb-3">
                        <strong><i class="bi bi-calendar-week me-1"></i>Periode Kegiatan:</strong>
                        <div class="text-muted">{{ $kegiatan->tanggal_mulai }} sampai {{ $kegiatan->tanggal_selesai }}</div>
                    </div>
                    <div class="mb-3">
                        <strong><i class="bi bi-calendar-week me-1"></i>Periode Waktu:</strong>
                        <div class="text-muted">{{ $kegiatan->waktu_mulai }} sampai {{ $kegiatan->waktu_selesai }}</div>
                    </div>
                    <div class="mb-3">
                        <strong><i class="bi bi-clock-history me-1"></i>Lama Hari Kegiatan:</strong>
                        <div class="text-muted">{{ $kegiatan->lama_hari }}</div>
                    </div>
                    <div class="mb-3">
                        <strong><i class="bi bi-flag me-1"></i>Status:</strong>
                        <span class="badge bg-success">{{ ucfirst($kegiatan->status) }}</span>
                    </div>
                    <div class="mb-3">
                        <strong><i class="bi bi-wallet2 me-1"></i>Lokasi Kegiatan:</strong>
                        <div class="text-muted">{{ $kegiatan->lokasi }}</div>
                    </div>
                </div>
                {{-- <div class="mb-3">
                    <label><strong>Lokasi Proyek :</strong></label>
                    <div class="mr-2" hidden>{{ $kegiatan->lokasi }}</div>
                    <p class="mt-2 text-muted">
                        <span id="alamat-lokasi">Sedang mengambil alamat...</span>
                    </p>
                    <a href="https://www.google.com/maps?q={{ $kegiatan->lokasi }}" target="_blank" class="btn btn-sm btn-outline-primary mt-3 mb-2 ">
                        Lihat di Google Maps
                    </a>
                    <div id="map" style="height: 300px;"></div>
                    
                </div> --}}
            </div>
        </div>
    </div>
</div>

@endsection
