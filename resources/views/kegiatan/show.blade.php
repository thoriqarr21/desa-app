@extends('layouts.app')

@section('content')
<div class="container-fluid py-2 mb-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start text-start margin-tb px-2">
        <!-- Tombol Kembali -->
        <div class="d-flex" style="padding-top: 15px;">
            <a class="btn btn-primary btn-sm fs-5 d-flex align-items-center" 
               href="{{ route('kegiatan.index') }}" 
               style="height: 45px; padding: 0 20px;">
                <i class="fas fa-reply fs-6 me-2"></i>
                <span>Kembali</span>
            </a>                       
        </div>
    
        <!-- Judul Detail -->
        <div class="card card-head border-0 mb-4 w-full sm:w-2/3 md:w-1/2 lg:w-1/3" style="box-shadow: 2px 2px 3px 1px rgb(143, 148, 251);">
            <div class="card-body p-3">
                <div class="d-flex justify-content-start align-items-start">
                    <h4 class="fw-bolder text-dark mb-0">
                        Detail Kegiatan
                    </h4>
                </div>
            </div>
        </div>          
    </div>
<div class="container-fluid pe-1 ps-0">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white d-flex align-items-center">
            <i class="bi bi-info-circle me-2"></i>
            <h4 class="mb-0 text-white">Detail Kegiatan {{ $kegiatan->nama_kegiatan }}</h4>
        </div>

        <div class="card-body">
            <div class="row mb-1">
                <!-- Gambar + Info Pendek di Kiri -->
                <div class="col-md-5">
                    <img src="{{ asset('storage/' . $kegiatan->gambar) }}" 
                         class="img-fluid rounded shadow mb-2" 
                         alt="Gambar Kegiatan"
                         style="max-height: 230px; object-fit: cover; width: 100%;">
            
                    <div class="mb-2">
                        <strong><i class="bi bi-calendar-week me-1"></i>Waktu Kegiatan :</strong>
                        <div class="text-muted">{{ $kegiatan->waktu_mulai }} WIB S/D {{ $kegiatan->waktu_selesai }} WIB</div>
                    </div>
            
                    <div class="mb-2">
                        <strong><i class="bi bi-clock-history me-1"></i>Lama Hari Kegiatan :</strong>
                        <div class="text-muted">{{ $kegiatan->lama_hari }}</div>
                    </div>
            
            
                    <div class="mb-2">
                        <strong><i class="bi bi-diagram-3 me-1"></i>Tanggal Kegiatan :</strong>
                        <div class="text-muted">{{ \Carbon\Carbon::parse($kegiatan->tanggal_mulai)->translatedFormat('l, d F Y') }} <span style="text-transform: lowercase;">s/d</span> {{ \Carbon\Carbon::parse($kegiatan->tanggal_mulai)->translatedFormat('l, d F Y') }}</div>
                    </div>
                </div>
            
                <!-- Deskripsi & Info Kanan -->
                <div class="col-md-7">
                    <div class="mb-3">
                        <strong><i class="bi bi-pencil-square me-1"></i>Deskripsi Kegiatan :</strong>
                        <div class="text-muted" style="text-align: justify;">{{ $kegiatan->deskripsi_kegiatan }}</div>
                    </div> 
                    <div class="mb-2">
                        <strong><i class="bi bi-flag me-1"></i>Status :</strong>
                        <span class="badge text-bg-success">{{ ucfirst($kegiatan->status) }}</span>
                    </div>
                    <div class="mb-2">
                        <strong><i class="bi bi-diagram-3 me-1"></i>Nama Pembuat :</strong>
                        <div class="text-muted">{{ ucfirst($kegiatan->user->name) }}</div>
                    </div>
            
                    <div class="mb-2">
                        <strong><i class="bi bi-diagram-3 me-1"></i>Kategori Kegiatan :</strong>
                        <div class="text-muted">{{ ucfirst($kegiatan->kategoriKegiatan->nama_kategori) }}</div>
                    </div>          
                </div>
                <hr>
                <div class="mb-3">
                    <strong><i class="bi bi-geo-alt me-1"></i>Lokasi Kegiatan :</strong>
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
        </div>
    </div>
</div>

<style>
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
    
        var geocodeUrl = `https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json&addressdetails=1&accept-language=id`;
    
        fetch(geocodeUrl)
            .then(response => response.json())
            .then(data => {
                let lokasiElement = document.getElementById('alamat-lokasi');
                if (data && data.address) {
                    let address = [];
    
                    if (data.address.building) address.push(data.address.building);
                    if (data.address.amenity) address.push(data.address.amenity);
                    if (data.address.house_number) address.push('No. ' + data.address.house_number);
                    if (data.address.road || data.address.footway || data.address.path)
                        address.push(data.address.road || data.address.footway || data.address.path);
                    if (data.address.neighbourhood) address.push(data.address.neighbourhood);
                    if (data.address.suburb) address.push('Kelurahan ' + data.address.suburb);
                    if (data.address.village || data.address.town || data.address.city)
                        address.push(data.address.village || data.address.town || data.address.city);
                    if (data.address.city_district || data.address.district || data.address.county)
                        address.push('Kecamatan ' + (data.address.city_district || data.address.district || data.address.county));
                    if (data.address.state) address.push('Provinsi ' + data.address.state);
                    if (data.address.postcode) address.push('Kode Pos ' + data.address.postcode);
                    if (data.address.country) address.push(data.address.country);
    
                    let alamatLengkap = address.filter(Boolean).join(', ');
    
                    marker.setPopupContent(`<strong>Lokasi Kegiatan:</strong><br>${alamatLengkap}`).openPopup();
                    if (lokasiElement) lokasiElement.innerText = alamatLengkap;
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
   