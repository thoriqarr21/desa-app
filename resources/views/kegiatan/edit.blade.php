@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
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
        <div class="card border-0 rounded-5 mb-4 w-full sm:w-2/3 md:w-1/2 lg:w-1/3" style="box-shadow: 3px 3px 5px 1px rgb(181, 148, 241);">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-center">
                    <div class="d-flex align-items-center">
                        <h4 class="fw-bolder text-dark mb-0">
                            Update Kegiatan
                        </h4>
                    </div>
                </div>
            </div>
        </div> 
        
    </div>
</div>

@if (count($errors) > 0)
    <div class="alert alert-danger">
      <strong>Whoops!</strong> There were some problems with your input.<br><br>
      <ul>
         @foreach ($errors->all() as $error)
           <li>{{ $error }}</li>
         @endforeach
      </ul>
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
                <option value="batal" {{ $kegiatan->status === 'batal' ? 'selected' : '' }}>Batal</option>
                <option value="berjalan" {{ $kegiatan->status === 'berjalan' ? 'selected' : '' }}>Berjalan</option>
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
            <div id="alamat-lokasi" class="form-control bg-light" readonly>Tunggu lokasi...</div>
            <small class="form-text text-muted">Klik pada peta untuk memilih titik koordinat.</small>
        </div>
        
        <div id="map" style="height: 400px;"></div>

        <div class="form-group mt-3">
            <label class="form-label" for="gambar">Gambar Kegiatan</label>
            <input type="file" name="gambar" id="gambar" class="form-control">
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary btn-sm mt-2 mb-3"><i class="fa-solid fa-floppy-disk me-1" style="font-size: 12px"></i> Submit</button>
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

    var marker = L.marker([lat, lng], { draggable: true }).addTo(map)
        .bindPopup('Sedang mendeteksi alamat...')
        .openPopup();

    // Set lokasi awal
    document.getElementById('lokasi').value = lat + ',' + lng;
    updateAlamat(lat, lng);

    // Klik pada peta
    map.on('click', function(e) {
        marker.setLatLng(e.latlng);
        updateLokasiDanAlamat(e.latlng.lat, e.latlng.lng);
    });

    // Drag marker
    marker.on('dragend', function(e) {
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
        .then(response => response.json())
        .then(data => {
            let lokasiElement = document.getElementById('alamat-lokasi');
            if (data && data.address) {
                const a = data.address;

                const parts = [
                    a.building,                        // Nama bangunan
                    a.amenity,                         // Fasilitas umum
                    a.house_number ? 'No. ' + a.house_number : null, // Nomor rumah
                    a.road || a.footway || a.path,     // Nama jalan atau jalur
                    a.neighbourhood,                   // Lingkungan
                    a.suburb,                          // Subkawasan
                    a.village || a.town || a.city,     // Desa/Kota
                    a.city_district || a.district || a.county, // Kecamatan/Kabupaten
                    a.state,                           // Provinsi
                    a.postcode,                        // Kode pos
                    a.country                          // Negara
                ];

                let address = parts.filter(Boolean).join(', ');
                marker.setPopupContent(`<strong>Alamat Kegiatan:</strong><br>${address}`).openPopup();
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
}

</script>

@endsection
