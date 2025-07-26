@extends('layouts.app')

@section('content')
<div class="container-fluid py-3 mb-5">
    <div class="d-flex justify-content-between align-items-center margin-tb">
        <div class="d-flex align-items-center ms-3 ">
            <a class="btn btn-primary btn-sm fs-5 d-flex align-items-center" 
            href="{{ route('laporan_proyek.index') }}" 
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
                            📝 Buat Laporan Proyek
                        </h4>
                    </div>
                </div>
            </div>
        </div> 
        
    </div>

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
            <input type="file" name="dokumentasi[]" class="form-control" accept="image/*,video/*" multiple required>
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
