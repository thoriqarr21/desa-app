@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Proyek Pembangunan</h2>
    <form action="{{ route('proyek.update', $proyek->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
    
        <!-- Input untuk nama proyek -->
        <div class="form-group">
            <label for="nama_proyek">Nama Proyek</label>
            <input type="text" name="nama_proyek" id="nama_proyek" class="form-control" value="{{ old('nama_proyek', $proyek->nama_proyek) }}" required>
        </div>
    
        
        <!-- Input untuk deskripsi proyek -->
        <div class="form-group">
            <label for="deskripsi_proyek">Deskripsi Proyek</label>
            <textarea name="deskripsi_proyek" id="deskripsi_proyek" class="form-control" required>{{ old('deskripsi_proyek', $proyek->deskripsi_proyek) }}</textarea>
        </div>
        <!-- Input untuk jenis proyek -->
        <div class="form-group">
            <label for="jenis_proyek">Jenis Proyek</label>
            <input type="text" name="jenis_proyek" id="jenis_proyek" class="form-control" value="{{ old('jenis_proyek', $proyek->jenis_proyek) }}" required disabled>
        </div>
        <hr>
        <!-- Dinamis Input berdasarkan jenis_proyek -->
        @if ($jenisProyek === 'jalan')
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
        @elseif ($jenisProyek === 'bangunan')
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
        @elseif ($jenisProyek === 'jembatan')
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
                <label for="tipe_struktur">Tipe Struktur</label>
                <input type="text" name="tipe_struktur" id="tipe_struktur" class="form-control" value="{{ old('tipe_struktur', $proyek->proyekJembatan->tipe_struktur ?? '') }}">
            </div>
        @endif
    
        <hr>
        <!-- Input untuk anggaran -->
        <div class="form-group">
            <label for="anggaran">Anggaran</label>
            <input type="number" name="anggaran" id="anggaran" class="form-control" value="{{ old('anggaran', $proyek->anggaran) }}" required>
        </div>
    
        <!-- Input untuk status -->
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="perencanaan" {{ $proyek->status === 'perencanaan' ? 'selected' : '' }}>Perencanaan</option>
                <option value="berjalan" {{ $proyek->status === 'berjalan' ? 'selected' : '' }}>Berjalan</option>
                <option value="selesai" {{ $proyek->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>
    
        <!-- Input untuk tanggal mulai -->
        <div class="form-group">
            <label for="tanggal_mulai">Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" value="{{ old('tanggal_mulai', $proyek->tanggal_mulai) }}" required>
        </div>
    
        <!-- Input untuk tanggal selesai -->
        <div class="form-group">
            <label for="tanggal_selesai">Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai', $proyek->tanggal_selesai) }}" required>
        </div>
    
        <!-- Input untuk sumber dana -->
        <div class="form-group">
            <label for="sumber_dana">Sumber Dana</label>
            <input type="text" name="sumber_dana" id="sumber_dana" class="form-control" value="{{ old('sumber_dana', $proyek->sumber_dana) }}" required>
        </div>
    
        <!-- Input untuk kontraktor -->
        <div class="form-group">
            <label for="kontraktor">Kontraktor</label>
            <input type="text" name="kontraktor" id="kontraktor" class="form-control" value="{{ old('kontraktor', $proyek->kontraktor) }}" required>
        </div>
    
        <!-- Input untuk penanggung jawab -->
        <div class="form-group">
            <label for="penanggung_jawab">Penanggung Jawab</label>
            <input type="text" name="penanggung_jawab" id="penanggung_jawab" class="form-control" value="{{ old('penanggung_jawab', $proyek->penanggung_jawab) }}" required>
        </div>
    
        <!-- Input untuk lokasi -->
        <div class="form-group">
            <label for="lokasi">Lokasi</label>
            <input type="text" name="lokasi" id="lokasi" class="form-control" value="{{ old('lokasi', $proyek->lokasi) }}" required>
        </div>
    
        <!-- Input untuk gambar (optional) -->
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
@endsection
