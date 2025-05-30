@extends('layouts.app')

@section('content')
<div class="container-fluid py-4 mb-5">
<div class="row">
    <div class="d-flex justify-content-between align-items-center margin-tb">
        <div class="d-flex align-items-center ms-3 ">
            <a class="btn btn-primary btn-sm fs-6 " href="{{ route('kegiatan.index') }}"><i class="fa fa-arrow-left fs-6"></i> Kembali</a>
        </div>
        <div class="card border-0 mb-4 w-40" style="box-shadow: 3px 3px 5px 1px rgb(181, 148, 241);">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-center">
                    <div class="d-flex align-items-center">
                        <h4 class="fw-bold text-dark mb-0">
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
                <strong>Nama kegiatan:</strong>
                <input type="text" name="nama_kegiatan" class="form-control" placeholder="Nama Kegiatan">
            </div>
        </div>
        <div class="form-group">
            <div class="form-group">
                <strong>Deskripsi Kegiatan:</strong>
                <textarea class="form-control" style="height:150px" name="deskripsi_kegiatan" placeholder="Deskripsi Kegiatan"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="kategori_id">Pilih Kategori</label>
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
            <label>Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" class="form-control" required>
        </div>
        <div class="form-group">
            <label class="form-label fw-semibold">Waktu Mulai</label>
            <div class="time-picker-wrapper">
                <span class="time-icon">
                    <i class="fas fa-clock"></i> <!-- Requires FontAwesome -->
                </span>
                <input type="text" id="waktuMulai" name="waktu_mulai" class="form-control custom-time-picker" placeholder="Pilih waktu" required>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label fw-semibold">Waktu Selesai</label>
            <div class="time-picker-wrapper">
                <span class="time-icon">
                    <i class="fas fa-clock"></i> <!-- Icon jam -->
                </span>
                <input type="text" id="waktuSelesai" name="waktu_selesai" class="form-control custom-time-picker" placeholder="Pilih waktu" required>
            </div>
        </div>
        

        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="">Pilih Status</option>
                <option value="perencanaan">Batal</option>
                <option value="berjalan">Berjalan</option>
                <option value="selesai">Selesai</option>
            </select>
        </div>
        <div class="form-group">
            <label>Gambar</label>
            <input type="file" name="gambar" class="form-control">
        </div>
        <div class="form-group">
            <label>Lokasi Kegiatan</label>
            <input type="text" name="lokasi" id="lokasi" class="form-control" readonly required hidden>
            <div id="alamat-lokasi" class="form-control bg-light" readonly>Tunggu lokasi...</div>
            <small class="form-text text-muted">Klik pada peta untuk memilih titik koordinat.</small>
        </div>
        <div id="map" style="height: 300px;"></div>   

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
    dateFormat: "H:i",   // 24-hour format
    time_24hr: true,
    defaultHour: 12,
    defaultMinute: 0
  };
  // Initialize waktuMulai
  flatpickr("#waktuMulai", timeOptions);
  // Initialize waktuSelesai
  flatpickr("#waktuSelesai", timeOptions);

        // <! ---- >

        var map = L.map('map').setView([-6.200000, 106.816666], 13); // Jakarta default

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
}).addTo(map);

var marker = L.marker([-6.200000, 106.816666], { draggable: true }).addTo(map);

// Set koordinat awal
document.getElementById("lokasi").value = '-6.200000,106.816666';
getLocationName(-6.200000, 106.816666); // Ambil nama lokasi awal

marker.on('dragend', function (e) {
    var position = marker.getLatLng();
    document.getElementById("lokasi").value = position.lat + ',' + position.lng;
    getLocationName(position.lat, position.lng); // Tampilkan nama tempat
});

map.on('click', function (e) {
    marker.setLatLng(e.latlng);
    document.getElementById("lokasi").value = e.latlng.lat + ',' + e.latlng.lng;
    getLocationName(e.latlng.lat, e.latlng.lng); // Tampilkan nama tempat
});

function getLocationName(lat, lon) {
    var url = `https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lon}&format=json&addressdetails=1`;

    fetch(url)
        .then(response => response.json())
        .then(data => {
            let lokasiDiv = document.getElementById('alamat-lokasi');
            if (data && data.display_name) {
                lokasiDiv.innerText = data.display_name;
            } else {
                lokasiDiv.innerText = "Alamat tidak ditemukan";
            }
        })
        .catch(error => {
            console.error("Gagal ambil alamat:", error);
            document.getElementById('alamat-lokasi').innerText = "Gagal mengambil alamat";
        });
}
</script>
@endsection
