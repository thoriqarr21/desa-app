@extends('layouts.app')

@section('content')
<div class="container-fluid py-4 mb-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start text-start margin-tb px-2">
        <!-- Tombol Kembali -->
        <div class="d-flex" style="padding-top: 15px;">
            <a class="btn btn-primary btn-sm fs-5 d-flex align-items-center" 
               href="{{ route('laporan_kegiatan.index') }}" 
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
                        Update Laporan Kegiatan
                    </h4>
                </div>
            </div>
        </div>          
    </div>

    <div class="card shadow-sm border-0 mb-5" style="background-color: #f8f9fa;">
        <div class="card-body p-4">
    <form action="{{ route('laporan_kegiatan.update', $laporanKegiatan) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label class="form-label" for="kegiatan_id">Pilih Kegiatan</label>
            <select name="kegiatan_id" id="kegiatan_id" class="form-control" required>
                <option value="">-- Pilih --</option>
                @foreach ($kegiatan as $item)
                <option value="{{ $item->id }}" {{ $item->id == $laporanKegiatan->kegiatan_id ? 'selected' : '' }}>
                {{ $item->nama_kegiatan }}
                </option>
                @endforeach
            </select>            
            @error('kegiatan_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label class="form-label" for="keterangan">Keterangan Kegiatan</label>
            <textarea
                name="keterangan"
                id="keterangan"
                class="form-control text-long @error('keterangan') is-invalid @enderror"
                maxlength="255"
                required
                rows="3"
            >{{ old('keterangan', $laporanKegiatan->keterangan) }}</textarea>
            <small id="keterangan-count" class="text-muted">0 / 255 karakter</small>
            @error('keterangan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label class="form-label" for="tujuan_kegiatan">Tujuan Kegiatan</label>
            <textarea
                name="tujuan_kegiatan"
                id="tujuan_kegiatan"
                class="form-control text-long @error('tujuan_kegiatan') is-invalid @enderror"
                maxlength="255"
                required
                rows="3"
            >{{ old('tujuan_kegiatan', $laporanKegiatan->tujuan_kegiatan) }}</textarea>
            <small id="tujuan_kegiatan-count" class="text-muted">0 / 255 karakter</small>
            @error('tujuan_kegiatan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="hasil">Hasil Kegiatan</label>
            <textarea
                name="hasil"
                id="hasil"
                class="form-control text-long @error('hasil') is-invalid @enderror"
                maxlength="255"
                required
                rows="3"
            >{{ old('hasil', $laporanKegiatan->hasil) }}</textarea>
            <small id="hasil-count" class="text-muted">0 / 255 karakter</small>
            @error('hasil')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    
        <div class="form-group">
            <label class="form-label" for="evaluasi">Evaluasi Kegiatan</label>
            <textarea
                name="evaluasi"
                id="evaluasi"
                class="form-control text-long @error('evaluasi') is-invalid @enderror"
                maxlength="255"
                required
                rows="3"
            >{{ old('evaluasi', $laporanKegiatan->evaluasi) }}</textarea>
            <small id="evaluasi-count" class="text-muted">0 / 255 karakter</small>
            @error('evaluasi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group">
            <label class="form-label" for="dokumentasi">Dokumentasi (opsional)</label>
            <input type="file" name="dokumentasi[]" class="form-control" multiple accept="image/*,video/*">
            <small class="text-muted">Format gambar: jpg, png. Video: mp4, mov, avi. Maks. 10MB per file.</small>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Update</button>
        <a href="{{ route('laporan_kegiatan.index') }}" class="btn btn-secondary mt-3">Batal</a>
    </form>
</div>
</div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fields = ['keterangan', 'hasil', 'tujuan_kegiatan', 'evaluasi'];
    
        fields.forEach(id => {
            const textarea = document.getElementById(id);
            const counter = document.getElementById(id + '-count');
    
            // Set hitungan awal berdasarkan isi lama
            counter.textContent = `${textarea.value.length} / 255 karakter`;
    
            textarea.addEventListener('input', () => {
                const length = textarea.value.length;
                counter.textContent = `${length} / 255 karakter`;
            });
        });
    });
    </script>

@endsection
