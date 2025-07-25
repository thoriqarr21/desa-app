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
        <div class="card border-0 rounded-5 mb-4 w-full sm:w-2/3 md:w-1/2 lg:w-1/3" style="box-shadow: 3px 3px 5px 1px rgb(181, 148, 241);">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-center">
                    <div class="d-flex align-items-center">
                        <h4 class="fw-bolder text-dark mb-0">
                            Tambah Kegiatan
                        </h4>
                    </div>
                </div>
            </div>
        </div> 
        
    </div>
    
</div>

@if ($errors->any())
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
<form action="{{ route('kegiatan.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="form-group">
            <div class="form-group">
                <label class="form-label">Nama kegiatan:</label>
                <input type="text" name="nama_kegiatan" class="form-control" placeholder="Nama Kegiatan">
            </div>
        </div>
        <div class="form-group">
            <div class="form-group">
                <label class="form-label">Deskripsi Kegiatan:</label>
                <textarea class="form-control text-long" style="height:150px" name="deskripsi_kegiatan" placeholder="Deskripsi Kegiatan"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label" for="kategori_id">Pilih Kategori</label>
            <select name="kategori_id" id="kategori_id" class="form-control" required>
                <option value="">-- Pilih --</option>
                @foreach ($kategoriKegiatans as $kategoriKegiatan)
                    <option value="{{ $kategoriKegiatan->id }}">{{ $kategoriKegiatan->nama_kategori }}</option>
                @endforeach
            </select>
            @error('kategori_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label class="form-label">Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" class="form-control" required>
        </div>

        <div class="form-group">
            <label class="form-label">Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" class="form-control" required>
        </div>
        <div class="form-group">
            <label class="form-label fw-semibold">Waktu Mulai</label>
            <div class="time-picker-wrapper">
                <span class="time-icon">
                    <i class="fas fa-clock"></i>
                </span>
                <input type="text" id="waktuMulai" name="waktu_mulai" class="form-control custom-time-picker" placeholder="Pilih waktu" required>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label fw-semibold">Waktu Selesai</label>
            <div class="time-picker-wrapper">
                <span class="time-icon">
                    <i class="fas fa-clock"></i> 
                </span>
                <input type="text" id="waktuSelesai" name="waktu_selesai" class="form-control custom-time-picker" placeholder="Pilih waktu" required>
            </div>
        </div>  
        {{-- <div class="form-group">
            <label class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="">Pilih Status</option>
                <option value="perencanaan">Batal</option>
                <option value="berjalan">Berjalan</option>
                <option value="selesai">Selesai</option>
            </select>
        </div> --}}
        <div class="form-group">
            <label class="form-label">Gambar</label>
            <input type="file" name="gambar" class="form-control">
        </div>
        <div class="form-group">
            <label class="form-label">Lokasi Kegiatan</label>
            <input type="text" name="lokasi" id="lokasi" class="form-control" readonly required hidden>
            <div id="alamat-lokasi" class="form-control bg-light" style="height: 60px; align-content: center" readonly>Tunggu lokasi...</div>
            <small class="form-text text-muted">Klik pada peta atau cari lokasi untuk memilih titik koordinat.</small>
        </div>
        <div id="map" style="height: 400px;"></div>
        
        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary btn-sm mt-2 mb-3"><i class="fa-solid fa-floppy-disk me-1" style="font-size: 12px"></i> Submit</button>
        </div>
    </div>
</form>
</div>
</div>
</div>

<script>
const timeOptions = {
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",   
    time_24hr: true,
    defaultHour: 12,
    defaultMinute: 0
  };

  flatpickr("#waktuMulai", timeOptions);
  flatpickr("#waktuSelesai", timeOptions);

        // <! ---- >

        var map = L.map('map').setView([-6.200000, 106.816666], 13); // Jakarta default

// Tile layer dari OpenStreetMap
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution: '© OpenStreetMap contributors'
}).addTo(map);

// Marker awal yang bisa digeser
var marker = L.marker([-6.200000, 106.816666], { draggable: true }).addTo(map);
document.getElementById("lokasi").value = '-6.200000,106.816666';
getLocationName(-6.200000, 106.816666);

// Geocoder (search box)
L.Control.geocoder({
  defaultMarkGeocode: false,
  geocoder: L.Control.Geocoder.nominatim({
    geocodingQueryParams: {
      countrycodes: 'id', // Hanya wilayah Indonesia
      addressdetails: 1
    }
  })
})
.on('markgeocode', function(e) {
  const latlng = e.geocode.center;
  marker.setLatLng(latlng).addTo(map);
  map.setView(latlng, 16);

  document.getElementById("lokasi").value = latlng.lat + ',' + latlng.lng;
  getLocationName(latlng.lat, latlng.lng);
})
.addTo(map);

// Saat klik peta
map.on('click', function(e) {
  marker.setLatLng(e.latlng);
  document.getElementById("lokasi").value = e.latlng.lat + ',' + e.latlng.lng;
  getLocationName(e.latlng.lat, e.latlng.lng);
});

// Saat marker digeser
marker.on('dragend', function(e) {
  var pos = marker.getLatLng();
  document.getElementById("lokasi").value = pos.lat + ',' + pos.lng;
  getLocationName(pos.lat, pos.lng);
});

// Ambil nama lokasi lengkap
function getLocationName(lat, lon) {
  var url = `https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lon}&format=json&addressdetails=1&accept-language=id`;

  fetch(url)
    .then(res => res.json())
    .then(data => {
      const output = document.getElementById("alamat-lokasi");
      if (data && data.address) {
        const a = data.address;
        const parts = [
          a.building, a.amenity, a.school, a.hospital, a.cinema, a.marketplace,
          a.road || a.footway || a.path,
          a.house_number ? 'No. ' + a.house_number : null,
          a.bridge, a.tunnel, a.railway,
          a.neighbourhood, a.suburb, a.hamlet,
          a.village || a.town || a.city,
          a.city_district || a.district || a.county,
          a.state_district, a.state, a.postcode, a.country
        ];
        output.innerText = parts.filter(Boolean).join(', ');
      } else {
        output.innerText = "Alamat tidak ditemukan";
      }
    })
    .catch(() => {
      document.getElementById("alamat-lokasi").innerText = "Gagal mengambil alamat";
    });
}
</script>
@endsection
