@extends('frontend.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="header-section">
        <div class="page-breadcrumb d-flex align-items-center gap-2">
            <h5 class="page-text">
                <i class="bi bi-house-door-fill text-success"></i>
                <a href="{{ route('frontend.index') }}" class="text-decoration-none text-muted">Beranda</a>
            </h5>
            <span class="text-muted">/</span>
            <h5 class="page-text">
                <a href="{{ route('frontend.proyek.index') }}" class="text-decoration-none text-muted">Proyek</a>
            </h5>
            <span class="text-muted">/</span>
            <h5 class="page-text fw-semibold text-dark">Detail</h5> {{-- atau Edit, Tambah, dll --}}
        </div>
        <a href="{{ route('frontend.proyek.index') }}">
            <button class="btn btn-back" st>Kembali</button>
        </a>
    </div>

    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="card p-4">
                <div class="head-title pb-3 mb-4">
                    <div>
                        <h5 class="title-proyek">Proyek {{ $proyek->nama_proyek }}</h5>
                    </div>
                    <span class="badge badge-single ms-3">{{ ucfirst($proyek->status) }}</span>
                </div>
                <div class="mb-4 text-center">
                    <img src="{{ asset('storage/' . $proyek->gambar) }}" class="img-fluid rounded shadow img-fluid-project" alt="Gambar Proyek">
                </div>

                <div class="info-item">
                    <i class="fas fa-hard-hat icon"></i>
                    <div>
                        <p class="text-value mb-0 title-proyek">{{ $proyek->nama_proyek }}</p>
                        <p class="text-label">Nama Proyek</p>
                    </div>
                </div>
                <div class="info-item">
                    <i class="fas fa-money-bill-wave icon"></i>
                    <div>
                        <p class="text-value mb-0">Rp {{ number_format($proyek->anggaran, 0, ',', '.') }}</p>
                        <p class="text-label">Anggaran</p>
                    </div>
                </div>
                <div class="info-item">
                    <i class="fas fa-chart-line icon"></i>
                    <div>
                        <p class="text-value mb-0">{{ $proyek->laporanProyek && $proyek->laporanProyek->progresTerbaru ? $proyek->laporanProyek->progresTerbaru->persentase : 0 }}%</p>
                        <p class="text-label">Progres</p>
                    </div>
                </div>
                <div class="info-item">
                    <i class="fas fa-landmark icon"></i>
                    <div>
                        <p class="text-value mb-0">{{ $proyek->sumber_dana }}</p>
                        <p class="text-label">Sumber Dana</p>
                    </div>
                </div>
                <div class="info-item">
                    <i class="fas fa-calendar-alt icon"></i>
                    <div>
                        <div class="periode-dates">
                            <span class="text-value-flex mb-0">{{ \Carbon\Carbon::parse($proyek->tanggal_mulai)->translatedFormat('l, d F Y') }}</span>
                            <span> s/d </span>
                            <span class="text-value-flex mb-0">{{ \Carbon\Carbon::parse($proyek->tanggal_selesai)->translatedFormat('l, d F Y') }}</span>
                          </div>
                        <p class="text-label">Periode Tanggal Proyek</p>
                    </div>
                </div>
                <div class="info-item">
                    <i class="fas fa-file-contract icon"></i>
                    <div>
                        <p class="text-value mb-0">{{ $proyek->masa_kontrak }}</p>
                        <p class="text-label">Masa Kontrak Proyek</p>
                    </div>
                </div>
    
            </div>
        </div>

        <div class="col-lg-7 col-md-7">
            <div class="card p-4">
                <h5 class="mb-3" style="font-weight: 600; color: #333;">Detail Proyek Pembangunan</h5>
                <ul class="nav nav-pills " id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-lokasi-tab" data-bs-toggle="pill" data-bs-target="#pills-lokasi" type="button" role="tab" aria-controls="pills-lokasi" aria-selected="true">Lokasi</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-deskripsi-tab" data-bs-toggle="pill" data-bs-target="#pills-deskripsi" type="button" role="tab" aria-controls="pills-deskripsi" aria-selected="false">Deskripsi</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-jenis-tab" data-bs-toggle="pill" data-bs-target="#pills-jenis" type="button" role="tab" aria-controls="pills-jenis" aria-selected="false">Jenis Proyek</button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-lokasi" role="tabpanel" aria-labelledby="pills-lokasi-tab">
                        <div class="activity-card">
                            <strong class="lokasi-title"><i class="bi bi-geo-alt me-1"></i>Lokasi Proyek</strong>
                            <div class="mr-2" hidden>{{ $proyek->lokasi }}</div>
                            <p class="mt-2 text-muted">
                                <span id="alamat-lokasi">Sedang mengambil alamat...</span>
                            </p>
                            <a href="https://www.google.com/maps?q={{ $proyek->lokasi }}" target="_blank" class="btn btn-sm btn-outline-primary mt-3 mb-2">
                                Lihat di Google Maps
                            </a>
                            <div id="map" style="height: 300px; width: 100%;"></div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-deskripsi" role="tabpanel" aria-labelledby="pills-deskripsi-tab">
                        <div class="activity-card">
                            <div class="text-deskripsi">
                                <strong><i class="bi bi-pencil-square me-2"></i>Deskripsi Proyek</strong>
                                <div class="text-muted">{{ $proyek->deskripsi_proyek }}</div>
                            </div>                            
                            <p class="text-muted text-center m-0 p-3">Penjelasan Proyek Yang Dikerjakan.</p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-jenis" role="tabpanel" aria-labelledby="pills-jenis-tab">
                        <div class="activity-card">
                            @if($proyek->jenis_proyek === 'jalan')
                            <div class="sub-detail-section">
                                <h5 class="mb-3 info-header"><i class="bi bi-truck me-2"></i>Detail Proyek Jalan</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-2 sub-detail-item">
                                        <p class="text-label mb-0">Panjang Jalan</p>
                                        <p class="text-value">{{ $proyek->proyekJalan->panjang_jalan ?? '-' }} Meter</p>
                                    </div>
                                    <div class="col-md-6 mb-2 sub-detail-item">
                                        <p class="text-label mb-0">Lebar Jalan</p>
                                        <p class="text-value">{{ $proyek->proyekJalan->lebar_jalan ?? '-' }} Meter</p>
                                    </div>
                                    <div class="col-md-6 mb-2 sub-detail-item">
                                        <p class="text-label mb-0">Jenis Permukaan</p>
                                        <p class="text-value">{{ ucfirst($proyek->proyekJalan->jenis_permukaan ?? '-') }}</p>
                                    </div>
                                    <div class="col-md-6 mb-2 sub-detail-item">
                                        <p class="text-label mb-0">Kondisi</p>
                                        <p class="text-value">{{ $proyek->proyekJalan ? ucwords($proyek->proyekJalan->kondisi_jalan) : '-' }}</p>
                                    </div>
                                </div>
                            </div>
                            @elseif($proyek->jenis_proyek === 'bangunan')
                            <div class="sub-detail-section">
                                <h5 class="mb-3 info-header"><i class="bi bi-building me-2"></i>Detail Proyek Bangunan</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-2 sub-detail-item">
                                        <p class="text-label mb-0">Nama Bangunan</p>
                                        <p class="text-value">{{ $proyek->proyekBangunan->nama_bangunan ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-6 mb-2 sub-detail-item">
                                        <p class="text-label mb-0">Jumlah Lantai</p>
                                        <p class="text-value">{{ $proyek->proyekBangunan->jumlah_lantai ?? '-' }} Lantai</p>
                                    </div>
                                    <div class="col-md-6 mb-2 sub-detail-item">
                                        <p class="text-label mb-0">Luas Bangunan</p>
                                        <p class="text-value">{{ $proyek->proyekBangunan->luas_bangunan ?? '-' }} m<sup>2</sup></p>
                                    </div>
                                    <div class="col-md-6 mb-2 sub-detail-item">
                                        <p class="text-label mb-0">Fungsi Sebagai</p>
                                        <p class="text-value">{{ $proyek->proyekBangunan->fungsi ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                            @elseif($proyek->jenis_proyek === 'jembatan')
                            <div class="sub-detail-section">
                                <h5 class="mb-3 info-header"><i class="bi bi-building me-2"></i>Detail Proyek Jembatan</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-2 sub-detail-item">
                                        <p class="text-label mb-0">Panjang Jembatan</p>
                                        <p class="text-value">{{ $proyek->proyekJembatan->panjang_jembatan ?? '-' }} Meter</p>
                                    </div>
                                    <div class="col-md-6 mb-2 sub-detail-item">
                                        <p class="text-label mb-0">Lebar Jembatan</p>
                                        <p class="text-value">{{ $proyek->proyekJembatan->lebar_jembatan ?? '-' }} Meter</p>
                                    </div>
                                    <div class="col-md-6 mb-2 sub-detail-item">
                                        <p class="text-label mb-0">Kapasitas Beban</p>
                                        <p class="text-value">{{ $proyek->proyekJembatan->kapasitas_beban ?? '-' }} Ton</p>
                                    </div>
                                    <div class="col-md-6 mb-2 sub-detail-item">
                                        <p class="text-label mb-0">Tipe Struktur Jembatan</p>
                                        <p class="text-value">{{ $proyek->proyekJembatan ? ucwords($proyek->proyekJembatan->tipe_struktur) : '-' }}</p>
                                    </div>
                                </div>
                            </div>
                            @endif
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
    .title-proyek {
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
    .text-deskripsi {
        margin-bottom: 20px;
    }
    .lokasi-title {
        font-size: 1.1rem;
    }
    .info-header {
        font-size: 1.1rem;
        color: #333;
        font-weight: bolder;
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
        color: #6c757d; 
        line-height: 1.6;
    }
    .head-title {
        display: flex; 
        align-items: center; 
        justify-content: space-between; 
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
    .text-value {
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
    .text-label {
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
    @media (max-width: 768px) {
        .container-fluid {
            padding-left: 0; 
            padding-right: 0; 
        }
    }
    </style>
<script>
   document.addEventListener("DOMContentLoaded", function () {
        @php
            $koordinat = explode(',', $proyek->lokasi);
            $lat = isset($koordinat[0]) ? floatval(trim($koordinat[0])) : -6.200000;
            $lng = isset($koordinat[1]) ? floatval(trim($koordinat[1])) : 106.816666;
        @endphp
    
        var lat = {{ $lat }};
        var lng = {{ $lng }};
    
        var map = L.map('map').setView([lat, lng], 15);
    
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);
    
        var marker = L.marker([lat, lng]).addTo(map)
            .bindPopup('Sedang mendeteksi alamat...')
            .openPopup();
    
        var geocodeUrl = `https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json&addressdetails=1`;
    
        fetch(geocodeUrl)
            .then(response => response.json())
            .then(data => {
                let lokasiElement = document.getElementById('alamat-lokasi');
                if (data && data.address) {
                    let address = [
                        data.address.building,
                        data.address.amenity,
                        data.address.house_number ? 'No. ' + data.address.house_number : null,
                        data.address.road || data.address.footway || data.address.path,
                        data.address.neighbourhood,
                        data.address.suburb,
                        data.address.village || data.address.town || data.address.city,
                        data.address.city_district || data.address.district || data.address.county,
                        data.address.state,
                        data.address.postcode,
                        data.address.country      
                    ].filter(Boolean).join(', ');
    
                    marker.setPopupContent(`<strong>Lokasi Proyek:</strong><br>${address}`).openPopup();
                    if (lokasiElement) lokasiElement.innerText = address;
                } else {
                    marker.setPopupContent('Lokasi tidak ditemukan').openPopup();
                    if (lokasiElement) lokasiElement.innerText = 'Lokasi tidak ditemukan';
                }
            })
            .catch(error => {
                console.error('Gagal ambil alamat:', error);
                marker.setPopupContent('Gagal mengambil alamat').openPopup();
                let lokasiElement = document.getElementById('alamat-lokasi');
                if (lokasiElement) lokasiElement.innerText = 'Gagal mengambil alamat';
            });
    });
    </script>
    

@endsection
