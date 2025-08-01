@extends('frontend.layouts.master')

@section('content')
<div class="container-fluid main-content">
    <div class="header-section">
        <div class="d-flex flex-wrap align-items-center gap-2"> <h5 class="page-text">
                <i class="bi bi-house-door-fill text-success"></i>
                <a href="{{ route('frontend.index') }}" class="text-decoration-none text-muted">Beranda</a>
            </h5>
            <span class="text-muted">/</span>
            <h5 class="page-text">
                <a href="{{ route('frontend.kegiatan.index') }}" class="text-decoration-none text-muted">Kegiatan</a>
            </h5>
            <span class="text-muted" id="detail-slash">/</span> <h5 class="page-text fw-semibold text-dark" id="detail-text">Detail</h5>
        </div>
        <a href="{{ route('frontend.kegiatan.index') }}">
            <button class="btn btn-back">Kembali</button>
        </a>
    </div>

    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="card p-4">
                <div class="head-title pb-3 mb-3">
                    <div>
                        <h5 class="title-kegiatan">Laporan Kegiatan {{ $laporanKegiatan->kegiatan->nama_kegiatan }}</h5>
                    </div>
                    <span class="ms-3">
                        @if ($laporanKegiatan->is_approved == 1)
                        <span class="badge text-bg-success" style="font-size: 13px">Disetujui</span>
                        @elseif ($laporanKegiatan->is_approved === 0)
                        <span class="badge text-bg-danger" style="font-size: 13px">Ditolak</span>
                        @else 
                        <span class="badge text-bg-warning text-dark" style="font-size: 13px">Pending</span>
                        @endif
                    </span>
                </div>
                <div class="d-flex align-items-center mb-4">
                    <img src="{{ asset('storage/' . $laporanKegiatan->user->gambar) }}" alt="Profile Picture" class="profile-img">
                    <div>
                        <h6 class="mb-0" style="font-weight: 700; color: #333;">{{ ucfirst($laporanKegiatan->user->name) }}</h6>
                        <small class="text-label">Nama</small>
                    </div>
                </div>

                <div class="info-item">
                    <i class="fas fa-clipboard-list icon"></i>
                    <div>
                        <p class="text-value mb-0 title-kegiatan">{{ $laporanKegiatan->kegiatan->nama_kegiatan }}</p>
                        <p class="text-label">Nama Laporan Kegiatan</p>
                    </div>
                </div>
                <div class="info-item">
                    <i class="fas fa-calendar-alt icon"></i>
                    <div>
                        <div class="periode-dates">
                            <span class="text-value-flex mb-0">{{ $laporanKegiatan->kegiatan->tanggal_mulai }}</span>
                            <span> s/d </span>
                            <span class="text-value-flex mb-0">{{ $laporanKegiatan->kegiatan->tanggal_selesai }}</span>
                          </div>
                        <p class="text-label">Periode Tanggal Kegiatan</p>
                    </div>
                </div>
                <div class="info-item">
                    <i class="fas fa-calendar-day icon"></i>
                    <div>
                        <p class="text-value mb-0">{{ $laporanKegiatan->kegiatan->lama_hari }}</p>
                        <p class="text-label">Lama Hari Kegiatan</p>
                    </div>
                </div>
                <div class="info-item">
                    <i class="fas fa-calendar-day icon"></i>
                    <div>
                        <p class="text-value mb-0">{{ $laporanKegiatan->kegiatan->kategoriKegiatan->nama_kategori ?? '-' }}</p>
                        <p class="text-label">Kategori Kegiatan</p>
                    </div>
                </div>
                <div class="info-item">
                    <i class="fas fa-clock icon"></i>
                    <div>
                        <div class="periode-dates">
                            <span class="text-value-flex mb-0">{{ $laporanKegiatan->kegiatan->waktu_mulai }} WIB</span>
                            <span> s/d </span>
                            <span class="text-value-flex mb-0">{{ $laporanKegiatan->kegiatan->waktu_selesai }} WIB</span>
                          </div>
                        <p class="text-label">Waktu</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-7 col-md-7">
            <div class="card p-4">
                <div class="d-flex justify-content-between">
                    <h5 class="mb-3" style="font-weight: 600; color: #333;">Detail Laporan Kegiatan</h5>
                    <div class="dropdown">
                        <button class="view-cetak-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end custom-dropdown">
                            <li>
                                <a class="dropdown-item text-primary fw-bold" href="{{ route('frontend.laporan_kegiatan.cetak', $laporanKegiatan->id) }}">
                                    <i class="fas fa-edit me-2"></i>Cetak PDF
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <ul class="nav nav-pills " id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-detail-tab" data-bs-toggle="pill" data-bs-target="#pills-detail" type="button" role="tab" aria-controls="pills-detail" aria-selected="true">Detail</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-deskripsi-tab" data-bs-toggle="pill" data-bs-target="#pills-deskripsi" type="button" role="tab" aria-controls="pills-deskripsi" aria-selected="false">Deskripsi</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-dokumentasi-tab" data-bs-toggle="pill" data-bs-target="#pills-dokumentasi" type="button" role="tab" aria-controls="pills-dokumentasi" aria-selected="false">Dokumentasi</button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-detail" role="tabpanel" aria-labelledby="pills-detail-tab">
                        <div class="activity-card">
                            <div class="text-laporan">
                                <h5><i class="bi bi-pencil-square me-2"></i>Keterangan Kegiatan</h5>
                                <div class="text-muted">{{ $laporanKegiatan->keterangan }}</div>
                            </div>
                            <div class="text-laporan">
                                <h5><i class="bi bi-pencil-square me-2"></i>Hasil Kegiatan</h5>
                                <div class="text-muted"> {{ $laporanKegiatan->hasil }}</div>
                            </div>
                            <div class="text-laporan">
                                <h5><i class="bi bi-pencil-square me-2"></i>Tujuan Kegiatan</h5>
                                <div class="text-muted">{{ $laporanKegiatan->tujuan_kegiatan }}</div>
                            </div>
                            <div class="text-laporan">
                                <h5><i class="bi bi-pencil-square me-2"></i>Evaluasi Kegiatan</h5>
                                <div class="text-muted">{{ $laporanKegiatan->evaluasi }}</div>
                            </div>
                            <p class="text-muted text-center m-0 p-3">Detail Laporan Kegiatan.</p>
                           
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-deskripsi" role="tabpanel" aria-labelledby="pills-deskripsi-tab">
                        <div class="activity-card">
                            <div class="text-deskripsi">
                                <strong><i class="bi bi-pencil-square me-2"></i>Deskripsi Kegiatan</strong>
                                <div class="text-muted">{{ $laporanKegiatan->kegiatan->deskripsi_kegiatan }}</div>
                            </div>                            
                            <p class="text-muted text-center m-0 p-3">Deskripsi Kegiatan.</p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-dokumentasi" role="tabpanel" aria-labelledby="pills-dokumentasi-tab">
                        <div class="activity-card">
                            <div class="text-laporan">
                                <h5>Dokumentasi Laporan Kegiatan</h5>
                                <div class="row mt-3">
                                    @forelse ($laporanKegiatan->dokumentasi as $dok)
                                    <div class="col-md-6 col-lg-5 mb-4">
                                        <div class="h-100">
                                        @if ($dok->file_type == 'image')
                                            <img src="{{ asset('storage/' . $dok->file_path) }}" class="card-img-top rounded-4" alt="Dokumentasi">
                                        @else
                                            <video controls class="w-100" style="max-height: 250px; object-fit: cover;">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <style>
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
            background-color: #fff;
            margin-bottom: 20px;
        }
        .title-kegiatan {
            font-weight: 600;
            color: #333;
            margin-bottom: 0;
            word-wrap: break-word; 
            word-break: break-word; 
            overflow-wrap: break-word; 
        }
        .page-text {
            margin-bottom: 0;
        }
        .lokasi-title {
            font-size: 1.1rem;
        }
        .text-deskripsi {
            margin-bottom: 20px;
        }
        .text-deskripsi strong {
            display: flex;
            align-items: center;
            font-size: 1.1rem;
            color: #333;
            margin-bottom: 8px;
        }
        
        .text-deskripsi .text-muted {
            text-align: justify;
            font-size: 1rem;
            color: #6c757d; /* warna gray ala Bootstrap */
            line-height: 1.6;
        }
        .text-laporan {
            margin-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        .text-laporan h5 {
            display: flex;
            font-weight: 800;
            align-items: center;
            font-size: 1.05rem;
            color: #415d4d;
            margin-bottom: 8px;
        }
    
        .text-laporan .text-muted {
            text-align: justify;
            font-size: 0.95rem;
            color: #6c757d;
            line-height: 1.6;
        }
    
        .head-title {
            display: flex; 
            align-items: center; 
            justify-content: space-between; 
            border-bottom: 1px solid #eee;
        }
        .header-section h4 {
            color: #333;
            font-weight: 600;
        }
        .btn-back {
            background-color: #6ba1ff;
            border-color: #6ba1ff;
            color: white;
            font-weight: 600;
            padding: 8px 20px;
            border-radius: 8px;
        }
        .btn-back:hover {
            background-color: #2f67c7;
            border-color: #2f67c7;
            color: white;
        }
        .profile-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 15px;
            border: 2px solid #eee;
        }
        .info-item {
            display: flex;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }
        .info-item:last-child {
            border-bottom: none;
        }
        .info-item .icon {     
            padding: 11px;
            border-radius: 15px;
            margin-right: 10px;
            font-size: 1.3rem;
            margin-bottom: 3px;
            background-color: #e0f7e9;
        }
        .info-item .text-value {
            font-size: 16px;
            color: #0a3c09;
            margin-bottom: 0;
            display: block;
            font-weight: 700;
        }
        .text-value-flex {
            font-size: 16px;
            color: #0a3c09;
            margin-bottom: 0;
            font-weight: 700;
        }
        .info-item .text-label {
            font-size: 14px;
            color: #407752;
            font-weight: 500;
            margin-bottom: 0;
        }
        .badge-single {
            padding: 6px;
            border-radius: 10px; 
            font-size: 0.80rem; 
            font-weight: 600; 
            white-space: nowrap; 
            background-color: #63dc7f;
            line-height: 1.1; 
            display: inline-flex; 
            align-items: center; 
            justify-content: center;
        }
        .nav-pills .nav-link {
            border-radius: 10px;
            color: #6c757d;
            font-weight: 500;
            padding: 8px 20px;
        }
        .nav-pills .nav-link.active {
            background-color: #e0f7e9; 
            color: #28a745; 
            font-weight: 600;
        }
        .activity-card {
            background-color: #ffffff;
            border-radius: 15px;
            padding: 20px;
            margin-top: 15px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.03);
        }
        .activity-date {
            font-size: 13px;
            color: #888;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .activity-item {
            display: flex;
            align-items: flex-start;
            margin-top: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }
        .activity-item:last-child {
            border-bottom: none;
        }
        .activity-icon-wrapper {
            background-color: #f5f5f5;
            border-radius: 10px;
            padding: 10px;
            margin-right: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .activity-icon {
            font-size: 24px;
            color: #6c757d;
        }
        .activity-content {
            flex-grow: 1;
        }
        .activity-title {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
        }
        .activity-detail {
            font-size: 14px;
            color: #555;
            margin-bottom: 5px;
        }
        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 13px;
            margin-left: auto; 
        }
        .status-pending {
            background-color: #fff3cd; 
            color: #ffc107; 
        }
        .status-accepted {
            background-color: #d4edda; 
            color: #28a745; 
        }
        .nominal-pengajuan {
            font-size: 14px;
            color: #6c757d;
            margin-top: 10px;
        }
        .nominal-value {
            font-size: 18px;
            font-weight: 700;
            color: #ff6b81; 
            margin-top: 5px;
        }
    .text-muted {
        margin-left: 5px;
    }
    </style>
    @endsection
