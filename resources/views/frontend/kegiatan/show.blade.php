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
                <a href="{{ route('frontend.kegiatan.index') }}" class="text-decoration-none text-muted">Kegiatan</a>
            </h5>
            <span class="text-muted">/</span>
            <h5 class="page-text fw-semibold text-dark">Detail</h5> {{-- atau Edit, Tambah, dll --}}
        </div>
        <a href="{{ route('frontend.kegiatan.index') }}">
            <button class="btn btn-back">Kembali</button>
        </a>
    </div>

    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="card p-4">
                <div class="head-title mb-4">
                    <div>
                        <h5 class="title-kegiatan">Kegiatan {{ $kegiatan->nama_kegiatan }}</h5>
                    </div>
                    @php
                    $status = strtolower($kegiatan->status);
                    $class = match($status) {
                        'batal'    => 'stats-danger',
                        'selesai'  => 'stats-success',
                        'berjalan' => 'stats-primary',
                        default    => 'stats-warning',
                    };
                    @endphp
                
                    <span class="stats {{ $class }} ms-3">{{ ucfirst($kegiatan->status) }}</span>
                
                </div>
                <div class="d-flex align-items-center mb-4">
                    <img src="{{ asset('storage/' . $kegiatan->user->gambar) }}" alt="Profile Picture" class="profile-img">
                    <div>
                        <h6 class="mb-0" style="font-weight: 700; color: #333;">{{ ucfirst($kegiatan->user->name) }}</h6>
                        <small class="text-label">Nama</small>
                    </div>
                </div>

                <div class="info-item">
                    <i class="fas fa-th-list icon"></i>
                    <div>
                        <p class="text-value mb-0 title-kegiatan">{{ $kegiatan->nama_kegiatan }}</p>
                        <p class="text-label">Nama Kegiatan</p>
                    </div>
                </div>
                <div class="info-item">
                    <i class="fas fa-tags icon"></i>
                    <div>
                        <p class="text-value mb-0">{{ ucfirst($kegiatan->kategoriKegiatan->nama_kategori) }}</p>
                        <p class="text-label">Kategori Kegiatan</p>
                    </div>
                </div>
                <div class="info-item">
                    <i class="fas fa-calendar-alt icon"></i>
                    <div>
                        <div class="periode-dates">
                            <span class="text-value-flex mb-0">{{ $kegiatan->tanggal_mulai }}</span>
                            <span> s/d </span>
                            <span class="text-value-flex mb-0">{{ $kegiatan->tanggal_selesai }}</span>
                          </div>
                        <p class="text-label">Periode Tanggal Kegiatan</p>
                    </div>
                </div>
                <div class="info-item">
                    <i class="fas fa-calendar-day icon"></i>
                    <div>
                        <p class="text-value mb-0">{{ $kegiatan->lama_hari }}</p>
                        <p class="text-label">Lama Hari Kegiatan</p>
                    </div>
                </div>
                <div class="info-item">
                    <i class="fas fa-clock icon"></i>
                    <div>
                        <div class="periode-dates">
                            <span class="text-value-flex mb-0">{{ $kegiatan->waktu_mulai }} WIB</span>
                            <span> s/d </span>
                            <span class="text-value-flex mb-0">{{ $kegiatan->waktu_selesai }} WIB</span>
                          </div>
                        <p class="text-label">Waktu</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-7 col-md-7">
            <div class="card p-4">
                <h5 class="mb-3" style="font-weight: 600; color: #333;">Detail Kegiatan</h5>
                <ul class="nav nav-pills " id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-lokasi-tab" data-bs-toggle="pill" data-bs-target="#pills-lokasi" type="button" role="tab" aria-controls="pills-lokasi" aria-selected="true">Lokasi</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-deskripsi-tab" data-bs-toggle="pill" data-bs-target="#pills-deskripsi" type="button" role="tab" aria-controls="pills-deskripsi" aria-selected="false">Deskripsi</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-dokumentasi-tab" data-bs-toggle="pill" data-bs-target="#pills-dokumentasi" type="button" role="tab" aria-controls="pills-dokumentasi" aria-selected="false">Dokumentasi</button>
                    </li>
           
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-lokasi" role="tabpanel" aria-labelledby="pills-lokasi-tab">
                        <div class="activity-card">
                            <strong class="lokasi-title"><i class="bi bi-geo-alt me-1"></i>Lokasi Kegiatan</strong>
                            <div class="mr-2" hidden>{{ $kegiatan->lokasi }}</div>
                            <p class="mt-2 text-muted">
                                <span id="alamat-lokasi">Sedang mengambil alamat...</span>
                            </p>
                            <a href="https://www.google.com/maps?q={{ $kegiatan->lokasi }}" target="_blank" class="btn btn-sm btn-outline-primary mt-3 mb-2">
                                Lihat di Google Maps
                            </a>
                            <div id="map" style="height: 300px; width: 100%;"></div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-deskripsi" role="tabpanel" aria-labelledby="pills-deskripsi-tab">
                        <div class="activity-card">
                            <div class="text-deskripsi">
                                <strong><i class="bi bi-pencil-square me-2"></i>Deskripsi Kegiatan</strong>
                                <div class="text-muted">{{ $kegiatan->deskripsi_kegiatan }}</div>
                            </div>                            
                            <p class="text-muted text-center m-0 p-3">No applicants to display.</p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-dokumentasi" role="tabpanel" aria-labelledby="pills-dokumentasi-tab">
                        <div class="activity-card">
                            <div class="text-deskripsi">
                                <strong><i class="bi bi-image me-2"></i>Dokumentasi Kegiatan</strong>
                                <img src="{{ asset('storage/' . $kegiatan->gambar) }}" 
                                class="img-fluid rounded w-100 img-hover-animate border-animate card-animate" 
                                alt="Gambar">    
                            </div>                            
                            <p class="text-muted text-center m-0 p-3">No applicants to display.</p>
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
    .text-deskripsi {
        margin-bottom: 20px;
    }
    .lokasi-title {
        font-size: 1.1rem;
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
<script>
    document.addEventListener("DOMContentLoaded", function () {
        @php
            $koordinat = explode(',', $kegiatan->lokasi);
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
                    let parts = [
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
                    ];
                    let address = parts.filter(Boolean).join(', ');
                    marker.setPopupContent(`<strong>Lokasi Kegiatan:</strong><br>${address}`).openPopup();
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
