@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center margin-tb">
        <div class="d-flex align-items-center ms-3 ">
            <a class="btn btn-primary btn-sm fs-5 d-flex align-items-center" 
            href="{{ route('proyek.index') }}" 
            style="height: 45px; padding: 0 20px;">
             <i class="fas fa-reply fs-6 me-2"></i>
             <span>Kembali</span>
         </a>                       
        </div>
        <div class="card border-0 mb-4 w-30" style="box-shadow: 3px 3px 5px 1px rgb(181, 148, 241);">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-center">
                    <div class="d-flex align-items-center">
                        <h4 class="fw-bold text-dark mb-0">
                            Edit Proyek
                        </h4>
                    </div>
                </div>
            </div>
        </div> 
        
    </div>
    <div class="card shadow-sm border-0 mb-5" style="background-color: #f8f9fa;">
        <div class="card-body p-4">
    <form action="{{ route('proyek.update', $proyek->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
    
        <!-- Input untuk nama proyek -->
        <div class="form-group">
            <strong for="nama_proyek">Nama Proyek</strong>
            <input type="text" name="nama_proyek" id="nama_proyek" class="form-control" value="{{ old('nama_proyek', $proyek->nama_proyek) }}" required>
        </div>
    
        <!-- Input untuk deskripsi proyek -->
        <div class="form-group">
            <strong for="deskripsi_proyek">Deskripsi Proyek</strong>
            <textarea name="deskripsi_proyek" id="deskripsi_proyek" class="form-control" required>{{ old('deskripsi_proyek', $proyek->deskripsi_proyek) }}</textarea>
        </div>

        <!-- Input untuk jenis proyek -->
        <div class="form-group">
            <strong for="jenis_proyek">Jenis Proyek</strong>
            <select id="jenis_proyek" name="jenis_proyek" class="form-control" required>
                <option value="">-- Pilih Jenis Proyek --</option>
                <option value="jalan" {{ old('jenis_proyek', $proyek->jenis_proyek) == 'jalan' ? 'selected' : '' }}>Jalan</option>
                <option value="bangunan" {{ old('jenis_proyek', $proyek->jenis_proyek) == 'bangunan' ? 'selected' : '' }}>Bangunan</option>
                <option value="jembatan" {{ old('jenis_proyek', $proyek->jenis_proyek) == 'jembatan' ? 'selected' : '' }}>Jembatan</option>
            </select>
        </div>

        <hr>
        <!-- Dinamis Input berdasarkan jenis_proyek -->
        <div id="form-jalan" style="display: {{ old('jenis_proyek', $proyek->jenis_proyek) == 'jalan' ? 'block' : 'none' }}">
            <div class="form-group">
                <strong for="panjang_jalan">Panjang Jalan</strong>
                <input type="number" name="panjang_jalan" id="panjang_jalan" class="form-control" value="{{ old('panjang_jalan', $proyek->proyekJalan->panjang_jalan ?? '') }}">
            </div>
            <div class="form-group">
                <strong for="lebar_jalan">Lebar Jalan</strong>
                <input type="number" name="lebar_jalan" id="lebar_jalan" class="form-control" value="{{ old('lebar_jalan', $proyek->proyekJalan->lebar_jalan ?? '') }}">
            </div>
            <div class="form-group">
                <strong for="jenis_permukaan">Jenis Permukaan</strong>
                <input type="text" name="jenis_permukaan" id="jenis_permukaan" class="form-control" value="{{ old('jenis_permukaan', $proyek->proyekJalan->jenis_permukaan ?? '') }}">
            </div>
            {{-- @if($proyek->proyekJalan) --}}
            <div class="form-group">
                <strong for="kondisi_jalan">Kondisi Jalan</strong>
                <select name="kondisi_jalan" class="form-control">
                    <option value="">Pilih Kondisi Jalan</option>
                    <option value="rusak parah" {{ old('kondisi_jalan', $proyek->proyekJalan->kondisi_jalan ?? '') == 'rusak parah' ? 'selected' : '' }}>Rusak Parah</option>
                    <option value="rusak ringan" {{ old('kondisi_jalan', $proyek->proyekJalan->kondisi_jalan ?? '') == 'rusak ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                    <option value="bagus" {{ old('kondisi_jalan', $proyek->proyekJalan->kondisi_jalan ?? '') == 'bagus' ? 'selected' : '' }}>Bagus</option>
                </select>
            </div>
        {{-- @endif --}}
        
        </div>

        <div id="form-bangunan" style="display: {{ old('jenis_proyek', $proyek->jenis_proyek) == 'bangunan' ? 'block' : 'none' }}">
            <div class="form-group">
                <strong for="nama_bangunan">Nama Bangunan</strong>
                <input type="text" name="nama_bangunan" id="nama_bangunan" class="form-control" value="{{ old('nama_bangunan', $proyek->proyekBangunan->nama_bangunan ?? '') }}">
            </div>
            <div class="form-group">
                <strong for="jumlah_lantai">Jumlah Lantai</strong>
                <input type="number" name="jumlah_lantai" id="jumlah_lantai" class="form-control" value="{{ old('jumlah_lantai', $proyek->proyekBangunan->jumlah_lantai ?? '') }}">
            </div>
            <div class="form-group">
                <strong for="luas_bangunan">Luas Bangunan</strong>
                <input type="number" name="luas_bangunan" id="luas_bangunan" class="form-control" value="{{ old('luas_bangunan', $proyek->proyekBangunan->luas_bangunan ?? '') }}">
            </div>
            <div class="form-group">
                <strong for="fungsi">Fungsi</strong>
                <input type="text" name="fungsi" id="fungsi" class="form-control" value="{{ old('fungsi', $proyek->proyekBangunan->fungsi ?? '') }}">
            </div>
        </div>

        <div id="form-jembatan" style="display: {{ old('jenis_proyek', $proyek->jenis_proyek) == 'jembatan' ? 'block' : 'none' }}">
            <div class="form-group">
                <strong for="panjang_jembatan">Panjang Jembatan</strong>
                <input type="number" name="panjang_jembatan" id="panjang_jembatan" class="form-control" value="{{ old('panjang_jembatan', $proyek->proyekJembatan->panjang_jembatan ?? '') }}">
            </div>
            <div class="form-group">
                <strong for="lebar_jembatan">Lebar Jembatan</strong>
                <input type="number" name="lebar_jembatan" id="lebar_jembatan" class="form-control" value="{{ old('lebar_jembatan', $proyek->proyekJembatan->lebar_jembatan ?? '') }}">
            </div>
            <div class="form-group">
                <strong for="kapasitas_beban">Kapasitas Beban</strong>
                <input type="number" name="kapasitas_beban" id="kapasitas_beban" class="form-control" value="{{ old('kapasitas_beban', $proyek->proyekJembatan->kapasitas_beban ?? '') }}">
            </div>

            {{-- @if($proyek->proyekJembatan) --}}
            <div class="form-group">
                <strong for="tipe_struktur">Tipe Struktur Jembatan</strong>
                <select name="tipe_struktur" class="form-control">
                    <option value="">Pilih Tipe Struktur</option>
                    <option value="balok" {{ old('tipe_struktur', $proyek->proyekJembatan->tipe_struktur ?? '') == 'balok' ? 'selected' : '' }}>Balok</option>
                    <option value="gantung" {{ old('tipe_struktur', $proyek->proyekJembatan->tipe_struktur ?? '') == 'gantung' ? 'selected' : '' }}>Gantung</option>
                    <option value="rangka" {{ old('tipe_struktur', $proyek->proyekJembatan->tipe_struktur ?? '') == 'rangka' ? 'selected' : '' }}>Rangka</option>
                    <option value="kabel" {{ old('tipe_struktur', $proyek->proyekJembatan->tipe_struktur ?? '') == 'kabel' ? 'selected' : '' }}>Kabel</option>
                </select>
            </div>
            {{-- @endif --}}
        </div>
    
        <hr>

        <!-- Input untuk anggaran -->
        <div class="form-group">
            <strong for="anggaran">Anggaran</strong>
            <input type="number" name="anggaran" id="anggaran" class="form-control" value="{{ old('anggaran', $proyek->anggaran) }}" required>
        </div>

        <!-- Input untuk status -->
        <div class="form-group">
            <strong for="status">Status</strong>
            <select name="status" id="status" class="form-control" required>
                <option value="perencanaan" {{ $proyek->status === 'perencanaan' ? 'selected' : '' }}>Perencanaan</option>
                <option value="berjalan" {{ $proyek->status === 'berjalan' ? 'selected' : '' }}>Berjalan</option>
                <option value="selesai" {{ $proyek->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>

        <div class="form-group">
            <strong for="tanggal_mulai">Tanggal Mulai</strong>
            <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" value="{{ old('tanggal_mulai', $proyek->tanggal_mulai) }}" required>
        </div>

        <div class="form-group">
            <strong for="tanggal_selesai">Tanggal Selesai</strong>
            <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai', $proyek->tanggal_selesai) }}" required>
        </div>

        <div class="form-group">
            <strong for="sumber_dana">Sumber Dana</strong>
            <input type="text" name="sumber_dana" id="sumber_dana" class="form-control" value="{{ old('sumber_dana', $proyek->sumber_dana) }}" required>
        </div>
    
        <div class="form-group">
            <strong for="kontraktor">Kontraktor</strong>
            <input type="text" name="kontraktor" id="kontraktor" class="form-control" value="{{ old('kontraktor', $proyek->kontraktor) }}" required>
        </div>
    
        <div class="form-group">
            <strong for="penanggung_jawab">Penanggung Jawab</strong>
            <input type="text" name="penanggung_jawab" id="penanggung_jawab" class="form-control" value="{{ old('penanggung_jawab', $proyek->penanggung_jawab) }}" required>
        </div>

        @php
        $lokasi = old('lokasi', $proyek->lokasi);
        $koordinat = explode(',', $lokasi);
        $lat = isset($koordinat[0]) ? floatval(trim($koordinat[0])) : -6.200000;
        $lng = isset($koordinat[1]) ? floatval(trim($koordinat[1])) : 106.816666;
    @endphp
    
    <div class="form-group">
        <strong>Lokasi Proyek</strong>
        <input type="text" name="lokasi" id="lokasi" class="form-control" value="{{ $lat }},{{ $lng }}" readonly required hidden>
        <div id="alamat-lokasi" class="form-control bg-light" readonly>Tunggu lokasi...</div>
        <small class="form-text text-muted">Klik pada peta untuk memilih titik koordinat.</small>
    </div>
    
    <div id="map" style="height: 300px;"></div>
        <!-- Gambar proyek -->
        <div class="form-group">
            <strong for="gambar">Gambar Proyek</strong>
            <input type="file" name="gambar" id="gambar" class="form-control">
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<script>
    document.getElementById('jenis_proyek').addEventListener('change', function() {
        var jenisProyek = this.value;
        document.getElementById('form-jalan').style.display = (jenisProyek === 'jalan') ? 'block' : 'none';
        document.getElementById('form-bangunan').style.display = (jenisProyek === 'bangunan') ? 'block' : 'none';
        document.getElementById('form-jembatan').style.display = (jenisProyek === 'jembatan') ? 'block' : 'none';
    });

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
        let url = `https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json&addressdetails=1`;

        fetch(url)
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
    }

</script>
@endsection

{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Proyek Pembangunan</h2>
    <form action="{{ route('proyek.update', $proyek->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
    
        <!-- Input untuk nama proyek -->
        <div class="form-group">
            <strong for="nama_proyek">Nama Proyek</strong>
            <input type="text" name="nama_proyek" id="nama_proyek" class="form-control" value="{{ old('nama_proyek', $proyek->nama_proyek) }}" required>
        </div>
    
        
        <!-- Input untuk deskripsi proyek -->
        <div class="form-group">
            <strong for="deskripsi_proyek">Deskripsi Proyek</strong>
            <textarea name="deskripsi_proyek" id="deskripsi_proyek" class="form-control" required>{{ old('deskripsi_proyek', $proyek->deskripsi_proyek) }}</textarea>
        </div>
        <!-- Input untuk jenis proyek -->
        <div class="form-group">
            <label for="jenis_proyek">Jenis Proyek</label>
            <select id="jenis_proyek" name="jenis_proyek" class="form-control">
                <option value="">-- Pilih Jenis Proyek --</option>
                <option value="jalan">Jalan</option>
                <option value="bangunan">Bangunan</option>
                <option value="jembatan">Jembatan</option>
              </select>
          
        </div>
        <hr>
        <!-- Dinamis Input berdasarkan jenis_proyek -->
       
        <div id="form-jalan" style="display: none;">
            <div class="form-group">
                <label for="panjang_jalan">Panjang Jalan</label>
                <input type="number" name="panjang_jalan" id="panjang_jalan" class="form-control" value="{{ old('panjang_jalan', $proyek->proyekJalan->panjang_jalan ?? '') }}">
            </div>
            <div class="form-group">
                <label for="lebar_jalan">Lebar Jalan</label>
                <input type="number" name="lebar_jalan" id="lebar_jalan" class="form-control" value="{{ old('lebar_jalan', $proyek->proyekJalan->lebar_jalan ?? '') }}">
            </div>
            <div class="form-group">
                <label for="jenis_permukaan">Jenis Permukaan</label>
                <input type="text" name="jenis_permukaan" id="jenis_permukaan" class="form-control" value="{{ old('jenis_permukaan', $proyek->proyekJalan->jenis_permukaan ?? '') }}">
            </div>
            <div class="form-group">
                <label for="kondisi_jalan">Kondisi Jalan</label>
                 <select name="kondisi_jalan" class="form-control">
                    <option value="">Pilih Kondisi Jalan</option>
                    <option value="rusak parah">Rusak Parah</option>
                    <option value="rusak ringan">Rusak Ringan</option>
                    <option value="bagus">Bagus</option>
                </select>
            </div>
            </div>

        <div id="form-bangunan" style="display: none;">
            <div class="form-group">
                <label for="nama_bangunan">Nama Bangunan</label>
                <input type="text" name="nama_bangunan" id="nama_bangunan" class="form-control" value="{{ old('nama_bangunan', $proyek->proyekBangunan->nama_bangunan ?? '') }}">
            </div>
            <div class="form-group">
                <label for="jumlah_lantai">Jumlah Lantai</label>
                <input type="number" name="jumlah_lantai" id="jumlah_lantai" class="form-control" value="{{ old('jumlah_lantai', $proyek->proyekBangunan->jumlah_lantai ?? '') }}">
            </div>
            <div class="form-group">
                <label for="luas_bangunan">Luas Bangunan</label>
                <input type="number" name="luas_bangunan" id="luas_bangunan" class="form-control" value="{{ old('luas_bangunan', $proyek->proyekBangunan->luas_bangunan ?? '') }}">
            </div>
            <div class="form-group">
                <label for="fungsi">Fungsi</label>
                <input type="text" name="fungsi" id="fungsi" class="form-control" value="{{ old('fungsi', $proyek->proyekBangunan->fungsi ?? '') }}">
            </div>
            </div>
  
        <div id="form-jembatan" style="display: none;">
            <div class="form-group">
                <label for="panjang_jembatan">Panjang Jembatan</label>
                <input type="number" name="panjang_jembatan" id="panjang_jembatan" class="form-control" value="{{ old('panjang_jembatan', $proyek->proyekJembatan->panjang_jembatan ?? '') }}">
            </div>
            <div class="form-group">
                <label for="lebar_jembatan">Lebar Jembatan</label>
                <input type="number" name="lebar_jembatan" id="lebar_jembatan" class="form-control" value="{{ old('lebar_jembatan', $proyek->proyekJembatan->lebar_jembatan ?? '') }}">
            </div>
            <div class="form-group">
                <label for="kapasitas_beban">Kapasitas Beban</label>
                <input type="number" name="kapasitas_beban" id="kapasitas_beban" class="form-control" value="{{ old('kapasitas_beban', $proyek->proyekJembatan->kapasitas_beban ?? '') }}">
            </div>
            <div class="form-group">
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
            <label for="anggaran">Anggaran</label>
            <input type="number" name="anggaran" id="anggaran" class="form-control" value="{{ old('anggaran', $proyek->anggaran) }}" required>
        </div>
    
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="perencanaan" {{ $proyek->status === 'perencanaan' ? 'selected' : '' }}>Perencanaan</option>
                <option value="berjalan" {{ $proyek->status === 'berjalan' ? 'selected' : '' }}>Berjalan</option>
                <option value="selesai" {{ $proyek->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>

        <div class="form-group">
            <label for="tanggal_mulai">Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" value="{{ old('tanggal_mulai', $proyek->tanggal_mulai) }}" required>
        </div>

        <div class="form-group">
            <label for="tanggal_selesai">Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai', $proyek->tanggal_selesai) }}" required>
        </div>

        <div class="form-group">
            <label for="sumber_dana">Sumber Dana</label>
            <input type="text" name="sumber_dana" id="sumber_dana" class="form-control" value="{{ old('sumber_dana', $proyek->sumber_dana) }}" required>
        </div>
    
        <div class="form-group">
            <label for="kontraktor">Kontraktor</label>
            <input type="text" name="kontraktor" id="kontraktor" class="form-control" value="{{ old('kontraktor', $proyek->kontraktor) }}" required>
        </div>
    
        <div class="form-group">
            <label for="penanggung_jawab">Penanggung Jawab</label>
            <input type="text" name="penanggung_jawab" id="penanggung_jawab" class="form-control" value="{{ old('penanggung_jawab', $proyek->penanggung_jawab) }}" required>
        </div>

        <div class="form-group">
            <label for="lokasi">Lokasi</label>
            <input type="text" name="lokasi" id="lokasi" class="form-control" value="{{ old('lokasi', $proyek->lokasi) }}" required>
        </div>

        <div class="form-group">
            <label for="gambar">Gambar</label>
            <input type="file" name="gambar" id="gambar" class="form-control">
        </div>
    
        
    
        <!-- Tombol untuk submit -->
        <button type="submit" class="btn btn-primary">Perbarui Proyek</button>
    </form>
    
</div>
<script>
    document.getElementById('jenis_proyek').addEventListener('change', function () {
        const jalan = document.getElementById('form-jalan');
        const bangunan = document.getElementById('form-bangunan');
        const jembatan = document.getElementById('form-jembatan');
        if (this.value === 'jalan') {
            jalan.style.display = 'block';
            bangunan.style.display = 'none';
        } else if (this.value === 'bangunan') {
            jalan.style.display = 'none';
            bangunan.style.display = 'block';
        } else if (this.value === 'jembatan') {
            jalan.style.display = 'none';
            jembatan.style.display = 'block';
        } else {
            jalan.style.display = 'none';
            bangunan.style.display = 'none';
        }
    });
</script>
@endsection --}}
