@extends('layouts.app')

@section('content')
<div class="container">
    <h3>✅ Proses Persetujuan Laporan</h3>

    <form action="{{ route('laporan_proyek.update', $laporanProyek) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="keterangan">Deskripsi Proyek</label>
            <textarea name="keterangan" id="keterangan" class="form-control" required>{{ old('keterangan', $laporanProyek->keterangan) }}</textarea>
        </div>
        <div class="form-group">
            <label for="proyek_id">Pilih Proyek</label>
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
            <label for="kendala">KendalaProyek</label>
            <textarea name="kendala" id="kendala" class="form-control" required>{{ old('kendala', $laporanProyek->kendala) }}</textarea>
        </div>
        <div class="form-group">
            <label for="evaluasi">Evaluasi Proyek</label>
            <textarea name="evaluasi" id="evaluasi" class="form-control" required>{{ old('evaluasi', $laporanProyek->evaluasi) }}</textarea>
        </div>

        <div class="form-group">
            <label for="persentase">Persentase Proyek</label>
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
            <label for="dokumentasi">Dokumentasi (opsional)</label>
            <input type="file" name="dokumentasi[]" class="form-control" multiple accept="image/*">
            <small class="form-text text-muted">Boleh upload lebih dari satu. Hanya gambar (jpg/png).</small>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        <a href="{{ route('laporan_proyek.index') }}" class="btn btn-secondary mt-3">Batal</a>
    </form>
</div>


@endsection
