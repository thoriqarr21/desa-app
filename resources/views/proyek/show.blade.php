@extends('layouts.app')

@section('content')
<div class="container-fluid ms-2 py-3" style="padding-right: 40px">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start text-start margin-tb px-2">
        <!-- Tombol Kembali -->
        <div class="d-flex" style="padding-top: 15px;">
            <a class="btn btn-primary btn-sm fs-5 d-flex align-items-center" 
               href="{{ route('proyek.index') }}" 
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
                        Detail Proyek Pembangunan
                    </h4>
                </div>
            </div>
        </div>          
    </div>
    
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white d-flex align-items-center">
            <i class="bi bi-info-circle me-2"></i>
            <h4 class="mb-0 text-white">Detail Proyek {{ $proyek->nama_proyek }}</h4>
        </div>
    
        <div class="card-body">
            <div class="row mb-1">
                <!-- Gambar + Info Pendek di Kiri -->
                <div class="col-md-5">
                    <img src="{{ asset('storage/' . $proyek->gambar) }}" 
                         class="img-fluid rounded shadow mb-2" 
                         alt="Gambar Proyek"
                         style="max-height: 230px; object-fit: cover; width: 100%;">
    
                    <div class="mb-2">
                        <strong><i class="bi bi-calendar-week me-1"></i>Periode :</strong>
                        <div class="text-muted">{{ \Carbon\Carbon::parse($proyek->tanggal_mulai)->translatedFormat('l, d F Y') }} <span style="text-transform: lowercase;">s/d</span> {{ \Carbon\Carbon::parse($proyek->tanggal_mulai)->translatedFormat('l, d F Y') }}</div>
                    </div>
    
                    <div class="mb-2">
                        <strong><i class="bi bi-clock-history me-1"></i>Masa Kontrak :</strong>
                        <div class="text-muted">{{ $proyek->masa_kontrak }}</div>
                    </div>
    
                    <div class="mb-2">
                        <strong><i class="bi bi-flag me-1"></i>Status :</strong>
                        <span class="badge text-bg-success">{{ ucfirst($proyek->status) }}</span>
                    </div>
    
                    <div class="mb-2">
                        <strong><i class="bi bi-cash-stack me-1"></i>Anggaran :</strong>
                        <div class="text-muted">Rp {{ number_format($proyek->anggaran, 0, ',', '.') }}</div>
                    </div>
    
                    <div class="mb-2">
                        <strong><i class="bi bi-wallet2 me-1"></i>Sumber Dana :</strong>
                        <div class="text-muted">{{ $proyek->sumber_dana }}</div>
                    </div>
                    <div class="mb-2">
                        <strong><i class="bi bi-wallet2 me-1"></i>Penanggung Jawab :</strong>
                        <div class="text-muted">{{ $proyek->penanggung_jawab }}</div>
                    </div>
    
                    <div class="mb-2">
                        <strong><i class="bi bi-percent me-1"></i>Persentase Progres :</strong>
                        <div class="text-muted">
                            {{ $proyek->laporanProyek && $proyek->laporanProyek->progresTerbaru ? $proyek->laporanProyek->progresTerbaru->persentase : 0 }}%
                        </div>
                    </div>
                </div>
    
                <!-- Deskripsi & Info Detail Kanan -->
                <div class="col-md-7">
                    <div class="mb-3">
                        <strong><i class="bi bi-pencil-square me-1"></i>Deskripsi :</strong>
                        <div class="text-muted" style="text-align: justify;">{{ $proyek->deskripsi_proyek }}</div>
                    </div>
    
                    @if($proyek->jenis_proyek === 'jalan')
                        <hr>
                        <h5 class="text-primary"><i class="bi bi-truck me-2"></i>Detail Proyek Jalan</h5>
                        <div class="row ms-0">
                            <div class="col-md-6 mb-2">
                                <strong>Panjang Jalan:</strong>
                                <div class="text-muted">{{ $proyek->proyekJalan->panjang_jalan ?? '-' }} Meter</div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <strong>Lebar Jalan:</strong>
                                <div class="text-muted">{{ $proyek->proyekJalan->lebar_jalan ?? '-' }} Meter</div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <strong>Jenis Permukaan:</strong>
                                <div class="text-muted">{{ ucfirst($proyek->proyekJalan->jenis_permukaan ?? '-') }}</div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <strong>Kondisi:</strong>
                                <div class="text-muted">{{ $proyek->proyekJalan ? ucwords($proyek->proyekJalan->kondisi_jalan) : '-' }}</div>
                            </div>
                        </div>
                    @elseif($proyek->jenis_proyek === 'bangunan')
                        <hr>
                        <h5 class="text-primary"><i class="bi bi-building me-2"></i>Detail Proyek Bangunan</h5>
                        <div class="row ms-0">
                            <div class="col-md-6 mb-2">
                                <strong>Nama Bangunan:</strong>
                                <div class="text-muted">{{ $proyek->proyekBangunan->nama_bangunan ?? '-' }}</div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <strong>Jumlah Lantai:</strong>
                                <div class="text-muted">{{ $proyek->proyekBangunan->jumlah_lantai ?? '-' }} Lantai</div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <strong>Luas Bangunan:</strong>
                                <div class="text-muted">{{ $proyek->proyekBangunan->luas_bangunan ?? '-' }} m<sup>2</sup></div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <strong>Fungsi Sebagai:</strong>
                                <div class="text-muted">{{ $proyek->proyekBangunan->fungsi ?? '-' }}</div>
                            </div>
                        </div>
                    @elseif($proyek->jenis_proyek === 'jembatan')
                        <hr>
                        <h5 class="text-primary"><i class="bi bi-building me-2"></i>Detail Proyek Jembatan</h5>
                        <div class="row ms-0">
                            <div class="col-md-6 mb-2">
                                <strong>Panjang Jembatan:</strong>
                                <div class="text-muted">{{ $proyek->proyekJembatan->panjang_jembatan ?? '-' }} Meter</div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <strong>Lebar Jembatan:</strong>
                                <div class="text-muted">{{ $proyek->proyekJembatan->lebar_jembatan ?? '-' }} Meter</div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <strong>Kapasitas Beban:</strong>
                                <div class="text-muted">{{ $proyek->proyekJembatan->kapasitas_beban ?? '-' }} Ton</div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <strong>Tipe Struktur Jembatan:</strong>
                                <div class="text-muted">{{ $proyek->proyekJembatan ? ucwords($proyek->proyekJembatan->tipe_struktur) : '-' }}</div>
                            </div>
                        </div>
                    @endif              
                </div>
                <div>
                    <hr class="animasi-hr w-100">
                </div>
                <div class="mb-3">
                    <strong><i class="bi bi-geo-alt me-1"></i>Lokasi Proyek :</strong>
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
        </div>
    </div>
</div>
    
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
    
                    marker.setPopupContent(`<strong>Lokasi Proyek:</strong><br>${alamatLengkap}`).openPopup();
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
