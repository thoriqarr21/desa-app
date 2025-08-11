@extends('layouts.app')

@section('content')
<div class="container-fluid py-3 mb-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start text-start margin-tb px-2">
        <!-- Tombol Kembali -->
        <div class="d-flex" style="padding-top: 15px;">
            <a class="btn btn-primary btn-sm fs-5 d-flex align-items-center" 
               href="{{ route('laporan_proyek.index') }}" 
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
                        Tambah Laporan Proyek 
                    </h4>
                </div>
            </div>
        </div>          
    </div>
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="fileSizeToast" class="toast text-bg-danger" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Peringatan</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Ukuran total file melebihi batas 10 MB
                <div id="countdown">Menutup dalam 5 detik...</div>
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
    <form action="{{ route('laporan_proyek.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <strong for="proyek_id">Pilih Proyek</strong>
            <select name="proyek_id" id="proyek_id" class="form-control" required>
                <option value="">-- Pilih --</option>
                @foreach ($proyeks as $proyek)
                    <option value="{{ $proyek->id }}">{{ $proyek->nama_proyek }}</option>
                @endforeach
            </select>
            @error('proyek_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <strong>Keterangan</strong>
            <textarea name="keterangan" id="keterangan" class="form-control text-long" maxlength="255" placeholder="Masukkan Keterangan" rows="3"></textarea>
            <small id="keterangan-count" class="text-muted">0 / 255 karakter</small>
        </div>
        <div class="form-group">
            <strong>Kendala</strong>
            <textarea name="kendala" id="kendala"  class="form-control text-long" maxlength="255" placeholder="Masukkan Kendala" rows="3"></textarea>
            <small id="kendala-count" class="text-muted">0 / 255 karakter</small>
        </div>
        <div class="form-group">
            <strong>Evaluasi</strong>
            <textarea name="evaluasi" id="evaluasi"  class="form-control text-long" maxlength="255" placeholder="Masukkan Evaluasi" rows="3"></textarea>
            <small id="evaluasi-count" class="text-muted">0 / 255 karakter</small>
        </div>
        <div class="form-group">
            <strong>Persentase Awal</strong>
            <select name="persentase" class="form-control" required>
                <option value="">Pilih Berapa Persen Progres</option>
                <option value="0">0%</option>
                <option value="50">50%</option>
                <option value="100">100%</option>
            </select>
        </div>


        <div class="form-group mb-3">
            <strong>Upload Dokumentasi (max 3 file: gambar/video)</strong>
            <input type="file" name="dokumentasi[]" class="form-control" accept="image/*,video/*" multiple required onchange="validateFileSize(this)">
            <small class="text-muted">Format gambar: jpg, png. Video: mp4, mov, avi. Maks. 10MB per file.</small>
        </div>
        
        <button type="submit" class="btn btn-success mt-3">Kirim Laporan</button>
        <a href="{{ route('laporan_proyek.index') }}" class="btn btn-secondary mt-3">Batal</a>
    </form>
</div>
</div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    // List semua textarea yang ingin dihitung
    const textareas = [
        'keterangan',
        'kendala',
        'evaluasi'
    ];

    textareas.forEach(id => {
        const textarea = document.getElementById(id);
        const counter = document.getElementById(id + '-count');

        // Update hitungan saat load halaman (jika ada isi default)
        counter.textContent = `${textarea.value.length} / 255 karakter`;

        // Event input untuk update hitungan realtime
        textarea.addEventListener('input', () => {
            const length = textarea.value.length;
            counter.textContent = `${length} / 255 karakter`;
        });
    });
});
</script>
@endsection
