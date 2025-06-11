@extends('layouts.app')

@section('content')
<div class="container-fluid py-4 mb-5">
    <div class="d-flex justify-content-between align-items-center margin-tb">
        <div class="d-flex align-items-center ms-3 ">
            <a class="btn btn-primary btn-sm fs-5 d-flex align-items-center" 
            href="{{ route('laporan_proyek.index') }}" 
            style="height: 45px; padding: 0 20px;">
             <i class="fas fa-reply fs-6 me-2"></i>
             <span>Kembali</span>
         </a>                       
        </div>
        <div class="card border-0 mb-4 w-35" style="box-shadow: 3px 3px 5px 1px rgb(181, 148, 241);">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-center">
                    <div class="d-flex align-items-center">
                        <h4 class="fw-bolder text-dark mb-0">
                            Edit Laporan Proyek
                        </h4>
                    </div>
                </div>
            </div>
        </div> 
        
    </div>

    <div class="card shadow-sm border-0 mb-5" style="background-color: #f8f9fa;">
        <div class="card-body p-4">
    <form action="{{ route('laporan_proyek.update', $laporanProyek) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label class="form-label" for="proyek_id">Pilih Proyek</label>
            <select name="proyek_id" id="proyek_id" class="form-control" required>
                <option value="">-- Pilih --</option>
                @foreach ($proyek as $item)
                <option value="{{ $item->id }}" {{ $item->id == $laporanProyek->proyek_id ? 'selected' : '' }}>
                {{ $item->nama_proyek }}
                </option>
                @endforeach
            </select>            
            @error('proyek_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label class="form-label" for="keterangan">Keterangan Proyek</label>
            <textarea name="keterangan" id="keterangan" class="form-control text-long" required>{{ old('keterangan', $laporanProyek->keterangan) }}</textarea>
            <small id="keterangan-count" class="text-muted">0 / 255 karakter</small>
        </div>
        <div class="form-group">
            <label class="form-label" for="kendala">KendalaProyek</label>
            <textarea name="kendala" id="kendala" class="form-control text-long" required>{{ old('kendala', $laporanProyek->kendala) }}</textarea>
            <small id="kendala-count" class="text-muted">0 / 255 karakter</small>
        </div>
        <div class="form-group">
            <label class="form-label" for="evaluasi">Evaluasi Proyek</label>
            <textarea name="evaluasi" id="evaluasi" class="form-control text-long" required>{{ old('evaluasi', $laporanProyek->evaluasi) }}</textarea>
            <small id="evaluasi-count" class="text-muted">0 / 255 karakter</small>
        </div>

        <div class="form-group">
            <label class="form-label" for="persentase">Persentase Proyek</label>
            <select name="persentase" id="persentase" class="form-control" required>
                <option value="">-- Pilih --</option>
                @foreach ([30, 50, 80, 100] as $value)
                    <option value="{{ $value }}"
                        {{ $value == old('persentase', optional($laporanProyek->latestProgres)->persentase) ? 'selected' : '' }}>
                        {{ $value }}%
                    </option>
                @endforeach
            </select>
            @error('persentase')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
    
        
        <div class="form-group">
            <label class="form-label" for="dokumentasi">Dokumentasi (opsional)</label>
            <input type="file" name="dokumentasi[]" class="form-control" accept="image/*,video/*" multiple>
            <small class="text-muted">Format gambar: jpg, png. Video: mp4, mov, avi. Maks. 10MB per file.</small>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
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
