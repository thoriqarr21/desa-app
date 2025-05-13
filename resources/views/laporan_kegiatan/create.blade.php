@extends('layouts.app')

@section('content')
<div class="container-fluid py-3 mb-5">
    <div class="d-flex justify-content-between align-items-center margin-tb">
        <div class="d-flex align-items-center ms-3">
            <a class="btn btn-primary btn-sm fs-6" href="{{ route('laporan_kegiatan.index') }}"><i class="fa fa-arrow-left fs-6"></i> Kembali</a>
        </div>
        <div class="card border-0 mb-4 w-35" style="box-shadow: 3px 3px 5px 1px rgb(181, 148, 241);">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-center">
                    <div class="d-flex align-items-center">
                        <h4 class="fw-bold text-dark mb-0">
                            📝 Buat Laporan Kegiatan
                        </h4>
                    </div>
                </div>
            </div>
        </div> 
        
    </div>
    <h3>📝 Buat Laporan Kegiatan</h3>

    <div class="card shadow-sm border-0 mb-5" style="background-color: #f8f9fa;">
        <div class="card-body p-4">
    <form action="{{ route('laporan_kegiatan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <strong for="kegiatan_id">Pilih Proyek</strong>
            <select name="kegiatan_id" id="kegiatan_id" class="form-control" required>
                <option value="">-- Pilih --</option>
                @foreach ($kegiatans as $kegiatan)
                    <option value="{{ $kegiatan->id }}">{{ $kegiatan->nama_kegiatan }}</option>
                @endforeach
            </select>
            @error('kegiatan_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <strong>Keterangan</strong>
            <textarea name="keterangan" class="form-control" rows="3"></textarea>
        </div>
        <div class="form-group">
            <strong>Hasil</strong>
            <textarea name="hasil" class="form-control" rows="3"></textarea>
        </div>
        <div class="form-group">
            <strong>Tujuan Kegiatan</strong>
            <textarea name="tujuan_kegiatan" class="form-control" rows="3"></textarea>
        </div>
        <div class="form-group">
            <strong>Evaluasi</strong>
            <textarea name="evaluasi" class="form-control" rows="3"></textarea>
        </div>

        <div class="form-group mb-3">
            <label><strong>Upload Dokumentasi (max 3 file: gambar/video)</strong></label>
            <input type="file" name="dokumentasi[]" class="form-control" accept="image/*,video/*" multiple required>
            <small class="text-muted">Format gambar: jpg, png. Video: mp4, mov, avi. Maks. 10MB per file.</small>
        </div>
        
        <button type="submit" class="btn btn-success mt-3">Kirim Laporan</button>
        <a href="{{ route('laporan_kegiatan.index') }}" class="btn btn-secondary mt-3">Batal</a>
    </form>
</div>
</div>
</div>
@endsection
