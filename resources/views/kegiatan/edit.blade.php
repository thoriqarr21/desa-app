@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
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
    
        <!-- Judul Update -->
        <div class="card card-head border-0 mt-3 mt-md-0 mb-4 w-full" 
             style="box-shadow: 2px 2px 3px 1px rgb(219, 219, 219);">
            <div class="card-body p-3">
                <div class="d-flex justify-content-start align-items-start">
                    <h4 class="fw-bolder text-dark mb-0">
                        Update Kegiatan
                    </h4>
                </div>
            </div>
        </div>          
    </div>

    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alertError">
        <strong>Terjadi kesalahan!</strong> Silakan periksa kembali data yang Anda masukkan:
        <ul class="mt-2 mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
    </div>
    @endif
<div class="card shadow-sm border-0 mb-5" style="background-color: #f8f9fa;">
    <div class="card-body p-4">
<form method="POST" action="{{ route('kegiatan.update', $kegiatan->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label class="form-label" for="nama_kegiatan">Nama Kegiatan</label>
                <input type="text" name="nama_kegiatan" placeholder="Nama Kegiatan" class="form-control" value="{{ $kegiatan->nama_kegiatan }}">
            </div>
        </div>
        <div class="form-group">
            <label class="form-label" for="deskripsi_kegiatan">Deskripsi Kegiatan</label>
            <textarea name="deskripsi_kegiatan" id="deskripsi_kegiatan" class="form-control text-long" required>{{ $kegiatan->deskripsi_kegiatan }}</textarea>
        </div>

        <div class="form-group">
            <label class="form-label" for="kategori_id">Pilih Kategori</label>
            <select name="kategori_id" id="kategori_id" class="form-control" required>
                <option value="">-- Pilih --</option>
                @foreach ($kategoriKegiatans as $kategoriKegiatan)
                    <option value="{{ $kategoriKegiatan->id }}" {{ $kategoriKegiatan->id == $kegiatan->kategori_id ? 'selected' : '' }}>
                        {{ $kategoriKegiatan->nama_kategori }}
                    </option>
                @endforeach
            </select>            
            @error('kategori_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="tanggal_mulai">Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" placeholder="Tanggal Mulai" class="form-control" value="{{ $kegiatan->tanggal_mulai }}">
        </div>
        <div class="form-group">
            <label class="form-label" for="tanggal_selesai">Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" placeholder="Tanggal Selesai" class="form-control" value="{{ $kegiatan->tanggal_selesai }}">
        </div>
        <div class="form-group">
            <label class="form-label" for="waktu_mulai">Waktu Mulai</label>
            <input type="time" name="waktu_mulai" placeholder="waktu Mulai" class="form-control" value="{{ $kegiatan->waktu_mulai }}">
        </div>
        <div class="form-group">
            <label class="form-label" for="waktu_selesai">Waktu Selesai</label>
            <input type="time" name="waktu_selesai" placeholder="waktu Selesai" class="form-control" value="{{ $kegiatan->waktu_selesai }}">
        </div>
        <div class="form-group">
            <label class="form-label" for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="berjalan" {{ $kegiatan->status === 'berjalan' ? 'selected' : '' }}>Berjalan</option>
                <option value="batal" {{ $kegiatan->status === 'batal' ? 'selected' : '' }}>Batal</option>
                <option value="selesai" {{ $kegiatan->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>
        @php
        $lokasi = old('lokasi', $kegiatan->lokasi);
        $koordinat = explode(',', $lokasi);
        $lat = isset($koordinat[0]) ? floatval(trim($koordinat[0])) : -6.200000;
        $lng = isset($koordinat[1]) ? floatval(trim($koordinat[1])) : 106.816666;
        @endphp

        <div class="form-group">
            <label class="form-label">Lokasi Kegiatan</label>
            <input type="text" name="lokasi" id="lokasi" class="form-control" value="{{ $lat }},{{ $lng }}" readonly required hidden>
            <div id="alamat-lokasi" class="form-control bg-light" style="height: 60px; align-content: center" readonly>Tunggu lokasi...</div>
            <small class="form-text text-muted">Klik pada peta atau cari lokasi untuk memilih titik koordinat.</small>
        </div>
        
        <div id="map" style="height: 400px;"></div>

        <div class="form-group mt-3">
            <label class="form-label" for="gambar">Gambar Kegiatan</label>
            <input type="file" name="gambar" id="gambar" class="form-control">
            <small class="text-muted">Format gambar: jpg, jpeg, png. Maks. 10MB per file.</small>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-12">
            <button type="submit" class="btn btn-primary btn-sm mt-3 mb-3 fs-6" style="height: 40px; width: 140px"></i>Update</button>
        </div>
    </div>
</form>
</div>
</div>
</div>
<script>
    // <! ---- >
    var lat = {{ $lat }};
    var lng = {{ $lng }};

    var map = L.map('map').setView([lat, lng], 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Marker draggable
    var marker = L.marker([lat, lng], { draggable: true }).addTo(map)
        .bindPopup('Sedang mendeteksi alamat...')
        .openPopup();

    // Geocoder (fitur search)
    var geocoder = L.Control.geocoder({
        defaultMarkGeocode: false,
        placeholder: 'Cari lokasi...',
        errorMessage: 'Lokasi tidak ditemukan',
    })
    .on('markgeocode', function (e) {
        var latlng = e.geocode.center;
        marker.setLatLng(latlng).addTo(map);
        map.setView(latlng, 16);
        updateLokasiDanAlamat(latlng.lat, latlng.lng);
    })
    .addTo(map);

    // Set awal
    document.getElementById('lokasi').value = lat + ',' + lng;
    updateAlamat(lat, lng);

    // Klik peta
    map.on('click', function (e) {
        marker.setLatLng(e.latlng);
        updateLokasiDanAlamat(e.latlng.lat, e.latlng.lng);
    });

    // Drag marker
    marker.on('dragend', function (e) {
        var pos = marker.getLatLng();
        updateLokasiDanAlamat(pos.lat, pos.lng);
    });

    function updateLokasiDanAlamat(lat, lng) {
        document.getElementById('lokasi').value = lat + ',' + lng;
        updateAlamat(lat, lng);
    }

    function updateAlamat(lat, lng) {
        let url = `https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json&addressdetails=1&accept-language=id`;

        fetch(url)
            .then(res => res.json())
            .then(data => {
                const a = data.address;
                const lokasiEl = document.getElementById('alamat-lokasi');
                const parts = [
                    a.building, a.amenity,
                    a.house_number ? 'No. ' + a.house_number : null,
                    a.road || a.footway || a.path,
                    a.neighbourhood, a.suburb,
                    a.village || a.town || a.city,
                    a.city_district || a.district || a.county,
                    a.state, a.postcode, a.country
                ];
                const address = parts.filter(Boolean).join(', ');
                marker.setPopupContent(`<strong>Alamat:</strong><br>${address}`).openPopup();
                if (lokasiEl) lokasiEl.innerText = address;
            })
            .catch(() => {
                marker.setPopupContent('Gagal mengambil alamat').openPopup();
                let lokasiEl = document.getElementById('alamat-lokasi');
                if (lokasiEl) lokasiEl.innerText = 'Gagal mengambil alamat';
            });
    }

</script>

@endsection
