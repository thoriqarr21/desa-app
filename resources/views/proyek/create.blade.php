@extends('layouts.app')

@section('content')
<div class="container-fluid py-3 mb-5">
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
    
        <!-- Judul Tambah -->
        <div class="card card-head border-0 mt-3 mt-md-0 mb-4 w-full" 
             style="box-shadow: 2px 2px 3px 1px rgb(219, 219, 219);">
            <div class="card-body p-3">
                <div class="d-flex justify-content-start align-items-start">
                    <h4 class="fw-bolder text-dark mb-0">
                        Tambah Proyek Pembangunan
                    </h4>
                </div>
            </div>
        </div>          
    </div>
    @if ($errors->any())
    @php
        // Field khusus per jenis proyek
        $jenis = old('jenis_proyek');

        $fieldPerJenis = match($jenis) {
            'jalan' => ['panjang_jalan', 'lebar_jalan', 'kondisi_jalan'],
            'bangunan' => ['luas_bangunan', 'jumlah_lantai', 'fungsi_bangunan'],
            'jembatan' => ['panjang_jembatan', 'lebar_jembatan', 'kapasitas_beban', 'tipe_struktur'],
            default => [],
        };

        // Pisahkan error umum (semua field yang tidak termasuk fieldPerJenis)
        $filtered = collect($errors->getMessages())
            ->filter(function($value, $key) use ($fieldPerJenis) {
                return !in_array($key, ['panjang_jalan', 'lebar_jalan', 'kondisi_jalan', 'luas_bangunan', 'jumlah_lantai', 'fungsi_bangunan', 'panjang_jembatan', 'lebar_jembatan', 'kapasitas_beban', 'tipe_struktur']) // semua field khusus
                    || in_array($key, $fieldPerJenis); // hanya tampilkan yang sesuai jenis
            });

        $finalErrors = $filtered->flatten(); // gabung array nested
        @endphp
        @if ($finalErrors->isNotEmpty())
            <div class="alert alert-danger" id="alertError">
                <strong>Terjadi kesalahan!</strong> Silakan periksa inputan Anda:
                <ul class="mb-0 mt-2">
                    @foreach ($finalErrors as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    @endif

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
                <input type="number" name="luas_bangunan" class="form-control" placeholder="Satuan Meter Persegi">
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
                <input type="number" name="panjang_jembatan" class="form-control" placeholder="Satuan Meter">
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
            <input type="text" id="anggaran" name="anggaran" class="form-control" required placeholder="Masukkan Nominal Rp.">
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



        <div class="form-group">
            <strong>Lokasi Proyek</strong>
            <input type="text" name="lokasi" id="lokasi" class="form-control" readonly required hidden>
            <div id="alamat-lokasi" class="form-control bg-light" readonly style="height: 50px; align-content: center">Tunggu lokasi...</div>
            <small class="form-text text-muted">Klik atau search pada peta untuk memilih titik koordinat.</small>
        </div>
        <div id="map" style="height: 400px;"></div>   
            
        <div class="form-group mt-3">
            <strong>Gambar</strong>
            <input type="file" name="gambar" class="form-control">
            <small class="text-muted">Format gambar: jpg, jpeg, png. Maks. 10MB per file.</small>
        </div>

        <button type="submit" class="btn btn-primary mt-4 fs-6" style="height: 40px; width: 140px"></i>Simpan</button>
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

       // Koordinat default (Jakarta)
       var lat = -6.200000;
    var lng = 106.816666;

    // Inisialisasi map
    var map = L.map('map').setView([lat, lng], 16);

    // Tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Marker draggable
    var marker = L.marker([lat, lng], { draggable: true }).addTo(map);
    document.getElementById("lokasi").value = lat + ',' + lng;
    getLocationName(lat, lng);

    // Geocoder (kotak pencarian lokasi)
    L.Control.geocoder({
        defaultMarkGeocode: false,
        geocoder: L.Control.Geocoder.nominatim({
            geocodingQueryParams: {
                countrycodes: 'id',
                addressdetails: 1
            }
        })
    })
    .on('markgeocode', function(e) {
        const latlng = e.geocode.center;
        marker.setLatLng(latlng).addTo(map);
        map.setView(latlng, 18);

        document.getElementById("lokasi").value = latlng.lat + ',' + latlng.lng;
        getLocationName(latlng.lat, latlng.lng);
    })
    .addTo(map);

    // Fungsi ambil nama lokasi
    function getLocationName(lat, lon) {
        const url = `https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json&addressdetails=1&accept-language=id`;

        fetch(url)
            .then(response => response.json())
            .then(data => {
                const output = document.getElementById("alamat-lokasi");
                const address = data.address || {};

                // Utamakan jika titik berada di jembatan
                const lokasiUtama = address.bridge || data.name || address.attraction || address.tourism || address.building || address.public_building || address.amenity;

                const detailAlamat = [
                    address.road || address.footway,
                    address.neighbourhood,
                    address.village || address.town || address.city,
                    address.suburb,
                    address.city_district,
                    address.state_district,
                    address.state,
                    address.postcode,
                    address.country
                ].filter(Boolean).join(', ');

                const hasil = lokasiUtama
                    ? `${lokasiUtama}, ${detailAlamat}`
                    : data.display_name || "Alamat tidak ditemukan";

                output.innerText = hasil;
            })
            .catch(err => {
                document.getElementById("alamat-lokasi").innerText = "Gagal mengambil alamat";
                console.error(err);
            });
    }

    // Saat klik di peta
    map.on('click', function(e) {
        lat = e.latlng.lat;
        lng = e.latlng.lng;
        marker.setLatLng([lat, lng]);
        document.getElementById("lokasi").value = lat + ',' + lng;
        getLocationName(lat, lng);
    });

    // Saat marker digeser
    marker.on('dragend', function(e) {
        var pos = marker.getLatLng();
        document.getElementById("lokasi").value = pos.lat + ',' + pos.lng;
        getLocationName(pos.lat, pos.lng);
    });
    const anggaranInput = document.getElementById('anggaran');

anggaranInput.addEventListener('keyup', function (e) {
    let value = this.value.replace(/[^\d]/g, '');
    if (value) {
        this.value = formatRupiah(value, 'Rp. ');
    } else {
        this.value = '';
    }
});

function formatRupiah(angka, prefix) {
    let numberString = angka.toString(),
        sisa = numberString.length % 3,
        rupiah = numberString.substr(0, sisa),
        ribuan = numberString.substr(sisa).match(/\d{3}/g);

    if (ribuan) {
        let separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    return prefix + rupiah;
}
</script>

@endsection