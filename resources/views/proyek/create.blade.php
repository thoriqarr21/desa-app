@extends('layouts.app')

@section('content')
<div class="container-fluid py-3 mb-5">
    <div class="d-flex justify-content-between align-items-center margin-tb">
        <div class="d-flex align-items-center ms-3">
            <a class="btn btn-primary btn-sm fs-6" href="{{ route('proyek.index') }}"><i class="fa fa-arrow-left fs-6"></i> Kembali</a>
        </div>
        <div class="card border-0 mb-4 w-60" style="box-shadow: 3px 3px 5px 1px rgb(181, 148, 241);">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-center">
                    <div class="d-flex align-items-center">
                        <h4 class="fw-bold text-dark mb-0">
                            🛠️ Tambah Proyek Pembangunan
                        </h4>
                    </div>
                </div>
            </div>
        </div> 
        
    </div>

    <div class="card shadow-sm border-0 mb-5" style="background-color: #f8f9fa;">
        <div class="card-body p-4">
    <form action="{{ route('proyek.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>Nama Proyek</label>
            <input type="text" name="nama_proyek" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Deskripsi Proyek</label>
            <textarea name="deskripsi_proyek" class="form-control" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="jenis_proyek" class="form-label">Jenis Proyek</label>
            <select name="jenis_proyek" id="jenis_proyek" class="form-control" required>
                <option value="">-- Pilih Jenis Proyek --</option>
                <option value="jalan">Proyek Jalan</option>
                <option value="bangunan">Proyek Bangunan</option>
                <option value="jembatan">Proyek Jembatan</option>
            </select>
        </div>
        
        {{-- Form Jalan --}}
        <div id="form-jalan" style="display: none;">
            <div class="mb-3">
                <label>Panjang Jalan</label>
                <input type="number" name="panjang_jalan" class="form-control">
            </div>
            <div class="mb-3">
                <label>Lebar Jalan</label>
                <input type="number" name="lebar_jalan" class="form-control">
            </div>
            <div class="mb-3">
                <label>Jenis Permukaan</label>
                <input type="text" name="jenis_permukaan" class="form-control">
            </div>
            <div class="mb-3">
                <label>Kondisi Jalan</label>
                <select name="kondisi_jalan" class="form-control">
                    <option value="">Pilih Kondisi Jalan</option>
                    <option value="rusak parah">Rusak Parah</option>
                    <option value="rusak ringan">Rusak Ringan</option>
                    <option value="bagus">Bagus</option>
                </select>
            </div>
        </div>
        
        {{-- Form Bangunan --}}
        <div id="form-bangunan" style="display: none;">
            <div class="mb-3">
                <label>Nama Bangunan</label>
                <input type="text" name="nama_bangunan" class="form-control">
            </div>
            <div class="mb-3">
                <label>Jumlah Lantai</label>
                <input type="number" name="jumlah_lantai" class="form-control">
            </div>
            <div class="mb-3">
                <label>Luas Bangunan</label>
                <input type="text" name="luas_bangunan" class="form-control">
            </div>
            <div class="mb-3">
                <label>Fungsi</label>
                <input type="text" name="fungsi" class="form-control">
            </div>
        </div>
        


        {{-- Form Jembatan --}}
        <div id="form-jembatan" style="display: none;">
            <div class="mb-3">
                <label>Panjang Jembatan</label>
                <input type="text" name="panjang_jembatan" class="form-control">
            </div>
            <div class="mb-3">
                <label>Lebar Jembatan</label>
                <input type="number" name="lebar_jembatan" class="form-control">
            </div>
            <div class="mb-3">
                <label>Kapasitas Beban</label>
                <input type="number" name="kapasitas_beban" class="form-control">
            </div>
            <div class="mb-3">
                <label>Tipe Struktur Jembatan</label>
                <select name="tipe_struktur" class="form-control">
                    <option value="">Pilih Tipe Struktur</option>
                    <option value="balok">Balok</option>
                    <option value="Gantung">Gantung</option>
                    <option value="rangka">Rangka</option>
                    <option value="kabel">Kabel</option>
                </select>
            </div>
        </div>
        

        <hr>

        <div class="form-group">
            <label>Anggaran</label>
            <input type="number" name="anggaran" class="form-control" required>
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
            <label>Sumber Dana</label>
            <input type="text" name="sumber_dana" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Kontraktor</label>
            <input type="text" name="kontraktor" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Penanggung Jawab</label>
            <input type="text" name="penanggung_jawab" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="">Pilih Status</option>
                <option value="perencanaan">Perencanaan</option>
                <option value="berjalan">Berjalan</option>
                <option value="selesai">Selesai</option>
            </select>
        </div>

        <div class="form-group">
            <label>Lokasi Proyek</label>
            <input type="text" name="lokasi" id="lokasi" class="form-control" readonly required hidden>
            <div id="alamat-lokasi" class="form-control bg-light" readonly>Tunggu lokasi...</div>
            <small class="form-text text-muted">Klik pada peta untuk memilih titik koordinat.</small>
        </div>
        <div id="map" style="height: 300px;"></div>   
            
        <div class="form-group">
            <label>Gambar</label>
            <input type="file" name="gambar" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
    </form>
</div>
</div>
</div>
<script>
    document.getElementById('jenis_proyek').addEventListener('change', function () {
        const jalan = document.getElementById('form-jalan');
        const bangunan = document.getElementById('form-bangunan');
        const jembatan = document.getElementById('form-jembatan');

        // Semua form disembunyikan dulu
        jalan.style.display = 'none';
        bangunan.style.display = 'none';
        jembatan.style.display = 'none';

        // Baru tampilkan sesuai pilihan
        if (this.value === 'jalan') {
            jalan.style.display = 'block';
        } else if (this.value === 'bangunan') {
            bangunan.style.display = 'block';
        } else if (this.value === 'jembatan') {
            jembatan.style.display = 'block';
        }
    });

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