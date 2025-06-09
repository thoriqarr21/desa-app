@extends('layouts.app')

@section('content')
<div class="container-fluid py-4 mb-5">
<div class="row">
    <div class="d-flex justify-content-between align-items-center margin-tb">
        <div class="d-flex align-items-center ms-3 ">
            <a class="btn btn-primary btn-sm fs-5 d-flex align-items-center" 
            href="{{ route('kegiatan.index') }}" 
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
                            Show Kegiatan
                        </h4>
                    </div>
                </div>
            </div>
        </div> 
        
    </div>
</div>
<hr>
<div class="container">
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
                         alt="Gambar Proyek"
                         style="max-height: 230px; object-fit: cover; width: 100%;">
            
                    <div class="mb-2">
                        <strong><i class="bi bi-calendar-week me-1"></i>Periode Waktu :</strong>
                        <div class="text-muted">{{ $kegiatan->waktu_mulai }} WIB S/D {{ $kegiatan->waktu_selesai }} WIB</div>
                    </div>
            
                    <div class="mb-2">
                        <strong><i class="bi bi-clock-history me-1"></i>Lama Hari Kegiatan :</strong>
                        <div class="text-muted">{{ $kegiatan->lama_hari }}</div>
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
                    <div class="mb-2">
                        <strong><i class="bi bi-diagram-3 me-1"></i>Kategori Kegiatan :</strong>
                        <div class="text-muted">{{ $kegiatan->tanggal_mulai }} sampai {{ $kegiatan->tanggal_selesai }}</div>
                    </div>
                </div>
            
                <!-- Deskripsi & Info Kanan -->
                <div class="col-md-7">
                    <div class="mb-3">
                        <strong><i class="bi bi-pencil-square me-1"></i>Deskripsi Kegiatan :</strong>
                        <div class="text-muted" style="text-align: justify;">{{ $kegiatan->deskripsi_kegiatan }}</div>
                    </div>           
                    <div class="periode-container">
                        <div class="periode-header">
                          <i class="bi bi-calendar-week"></i>
                          <span>Periode Kegiatan :</span>
                        </div>
                        {{-- <div class="periode-dates">
                          <span class="date-badge">{{ $kegiatan->tanggal_mulai }}</span>
                          <span> sampai </span>
                          <span class="date-badge">{{ $kegiatan->tanggal_selesai }}</span>
                        </div> --}}
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
    
        var geocodeUrl = `https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json&addressdetails=1`;
    
        fetch(geocodeUrl)
    .then(response => response.json())
    .then(data => {
        let lokasiElement = document.getElementById('alamat-lokasi');
        if (data && data.address) {
            let parts = [
                data.address.amenity,
                data.address.building,
                data.address.road,
                data.address.suburb,
                data.address.village || data.address.city,
                data.address.state,
                data.address.country
            ];
            let address = parts.filter(Boolean).join(', ');
            marker.setPopupContent(`<strong>Alamat Proyek:</strong><br>${address}`).openPopup();
            if (lokasiElement) lokasiElement.innerText = address;
        } else {
            marker.setPopupContent('Alamat tidak ditemukan').openPopup();
            if (lokasiElement) lokasiElement.innerText = 'Alamat tidak ditemukan';
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
   