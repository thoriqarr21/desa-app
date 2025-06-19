@extends('layouts.app')

@section('content')
<div class="container-fluid py-3 mb-5">
    <div class="d-flex justify-content-between align-items-center margin-tb">
        <div class="d-flex align-items-center ms-3 ">
            <a class="btn btn-primary btn-sm fs-5 d-flex align-items-center" 
            href="{{ route('proyek.index') }}" 
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
            <strong>Nama Proyek</strong>
            <input type="text" name="nama_proyek" class="form-control" required placeholder="Nama Proyek">
        </div>

        <div class="form-group">
            <strong>Deskripsi Proyek</strong>
            <textarea name="deskripsi_proyek" class="form-control text-long" rows="3" required placeholder="Deskripsi Proyek"></textarea>
        </div>

        <div class="mb-3">
            <strong for="jenis_proyek" class="form-strong">Jenis Proyek</strong>
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
                <strong>Panjang Jalan</strong>
                <input type="number" name="panjang_jalan" class="form-control" placeholder="Satuan Meter">
            </div>
            <div class="mb-3">
                <strong>Lebar Jalan</strong>
                <input type="number" name="lebar_jalan" class="form-control" placeholder="Satuan Meter">
            </div>
            <div class="mb-3">
                <strong>Jenis Permukaan</strong>
                <select name="jenis_permukaan" class="form-control">
                    <option value="">Pilih Jenis Permukaan</option>
                    <option value="aspal">Aspal</option>
                    <option value="cor beton">Cor Beton</option>
                    <option value="batu kerikil">Batu Kerikil</option>
                    <option value="kayu/papan">Kayu/Papan</option>
                    <option value="tanah">Tanah</option>
                </select>
            </div>
            <div class="mb-3">
                <strong>Kondisi Awal Jalan</strong>
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
                <strong>Nama Bangunan</strong>
                <input type="text" name="nama_bangunan" class="form-control" placeholder="Nama Bangunan">
            </div>
            <div class="mb-3">
                <strong>Jumlah Lantai</strong>
                <input type="number" name="jumlah_lantai" class="form-control" placeholder="Jumlah Lantai">
            </div>
            <div class="mb-3">
                <strong>Luas Bangunan</strong>
                <input type="text" name="luas_bangunan" class="form-control" placeholder="Satuan Meter Persegi">
            </div>
            <div class="mb-3">
                <strong>Fungsi Bangunan</strong>
                <input type="text" name="fungsi" class="form-control" placeholder="Fungsi Bangunan">
            </div>
        </div>
        


        {{-- Form Jembatan --}}
        <div id="form-jembatan" style="display: none;">
            <div class="mb-3">
                <strong>Panjang Jembatan</strong>
                <input type="text" name="panjang_jembatan" class="form-control" placeholder="Satuan Meter">
            </div>
            <div class="mb-3">
                <strong>Lebar Jembatan</strong>
                <input type="number" name="lebar_jembatan" class="form-control" placeholder="Satuan Meter">
            </div>
            <div class="mb-3">
                <strong>Kapasitas Beban</strong>
                <input type="number" name="kapasitas_beban" class="form-control" placeholder="Satuannya Ton">
            </div>
            <div class="mb-3">
                <strong>Tipe Struktur Jembatan</strong>
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
            <strong>Anggaran</strong>
            <input type="number" name="anggaran" class="form-control" required placeholder="Masukkan Nominal Rp.">
        </div>

        <div class="form-group">
            <strong>Tanggal Mulai</strong>
            <input type="date" name="tanggal_mulai" class="form-control" required>
        </div>

        <div class="form-group">
            <strong>Tanggal Selesai</strong>
            <input type="date" name="tanggal_selesai" class="form-control" required>
        </div>

        <div class="form-group">
            <strong>Sumber Dana</strong>
            <input type="text" name="sumber_dana" class="form-control" required placeholder="Sumber Dana">
        </div>

        <div class="form-group">
            <strong>Kontraktor</strong>
            <input type="text" name="kontraktor" class="form-control" required placeholder="Kontraktor">
        </div>

        <div class="form-group">
            <strong>Penanggung Jawab</strong>
            <input type="text" name="penanggung_jawab" class="form-control" required placeholder="Penanggung Jawab">
        </div>

        {{-- <div class="form-group">
            <strong>Status</strong>
            <select name="status" class="form-control" required>
                <option value="">Pilih Status</option>
                <option value="perencanaan">Perencanaan</option>
                <option value="berjalan">Berjalan</option>
                <option value="selesai">Selesai</option>
            </select>
        </div> --}}

        <div class="form-group">
            <strong>Lokasi Proyek</strong>
            <input type="text" name="lokasi" id="lokasi" class="form-control" readonly required hidden>
            <div id="alamat-lokasi" class="form-control bg-light" readonly style="height: 50px; align-content: center">Tunggu lokasi...</div>
            <small class="form-text text-muted">Klik pada peta untuk memilih titik koordinat.</small>
        </div>
        <div id="map" style="height: 400px;"></div>   
            
        <div class="form-group mt-3">
            <strong>Gambar</strong>
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
    const url = `https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lon}&format=json&addressdetails=1&accept-language=id`;

    fetch(url)
        .then(response => response.json())
        .then(data => {
            const lokasiDiv = document.getElementById('alamat-lokasi');

            if (data && data.address) {
                const a = data.address;

                // Ambil komponen alamat selengkap mungkin
                const parts = [
                    a.building,                     // Nama bangunan (jika ada)
                    a.amenity,                      // Fasilitas umum (halte, masjid, dll)
                    a.road || a.footway || a.path,  // Nama jalan/jalur
                    a.house_number ? 'No. ' + a.house_number : null, // No rumah
                    a.bridge,                       // Nama jembatan
                    a.railway,                      // Rel kereta
                    a.tunnel,                       // Terowongan
                    a.neighbourhood,                // Lingkungan/RW
                    a.suburb,                       // Suburban
                    a.hamlet,                       // Kampung/dusun
                    a.village || a.town || a.city,  // Desa/Kota
                    a.municipality || a.city_district || a.district || a.county, // Kecamatan/Kabupaten
                    a.state_district,               // Wilayah administratif tingkat II
                    a.state,                        // Provinsi
                    a.postcode,                     // Kode pos
                    a.country                       // Negara
                ];

                // Gabungkan dan hilangkan nilai kosong
                const fullAddress = parts.filter(Boolean).join(', ');
                lokasiDiv.innerText = fullAddress;
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