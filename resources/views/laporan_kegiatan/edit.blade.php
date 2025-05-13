@extends('layouts.app')

@section('content')
<div class="container-fluid py-4 mb-5">
    <div class="d-flex justify-content-between align-items-center margin-tb">
        <div class="d-flex align-items-center ms-3 ">
            <a class="btn btn-primary btn-sm fs-6 " href="{{ route('laporan_kegiatan.index') }}"><i class="fa fa-arrow-left fs-6"></i> Kembali</a>
        </div>
        <div class="card border-0 mb-4 w-35" style="box-shadow: 3px 3px 5px 1px rgb(181, 148, 241);">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-center">
                    <div class="d-flex align-items-center">
                        <h4 class="fw-bold text-dark mb-0">
                            Edit Laporan Kegiatan
                        </h4>
                    </div>
                </div>
            </div>
        </div> 
        
    </div>
    <h3>✅ Edit Laporan</h3>

    <div class="card shadow-sm border-0 mb-5" style="background-color: #f8f9fa;">
        <div class="card-body p-4">
    <form action="{{ route('laporan_kegiatan.update', $laporanKegiatan) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="keterangan">Keterangan Kegiatan</label>
            <textarea name="keterangan" id="keterangan" class="form-control" required>{{ old('keterangan', $laporanKegiatan->keterangan) }}</textarea>
        </div>
        <div class="form-group">
            <label for="kegiatan_id">Pilih Kegiatan</label>
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
            <label for="hasil">Hasil Kegiatan</label>
            <textarea name="hasil" id="hasil" class="form-control" required>{{ old('hasil', $laporanKegiatan->hasil) }}</textarea>
        </div>
        <div class="form-group">
            <label for="tujuan_kegiatan">Tujuan Kegiatan</label>
            <textarea name="tujuan_kegiatan" id="tujuan_kegiatan" class="form-control" required>{{ old('tujuan_kegiatan', $laporanKegiatan->tujuan_kegiatan) }}</textarea>
        </div>
        <div class="form-group">
            <label for="evaluasi">Evaluasi Kegiatan</label>
            <textarea name="evaluasi" id="evaluasi" class="form-control" required>{{ old('evaluasi', $laporanKegiatan->evaluasi) }}</textarea>
        </div>
        
        <div class="form-group">
            <label for="dokumentasi">Dokumentasi (opsional)</label>
            <input type="file" name="dokumentasi[]" class="form-control" accept="image/*,video/*">
            <small class="text-muted">Format gambar: jpg, png. Video: mp4, mov, avi. Maks. 10MB per file.</small>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        <a href="{{ route('laporan_kegiatan.index') }}" class="btn btn-secondary mt-3">Batal</a>
    </form>
</div>
</div>
</div>


@endsection
