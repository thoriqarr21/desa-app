@extends('layouts.app')

@section('content')
<div class="container-fluid py-3 mb-5">
    <div class="d-flex justify-content-between align-items-center margin-tb">
        <div class="d-flex align-items-center ms-3">
            <a class="btn btn-primary btn-sm fs-6" href="{{ route('laporan_proyek.index') }}"><i class="fa fa-arrow-left fs-6"></i> Kembali</a>
        </div>
        <div class="card border-0 mb-4 w-35" style="box-shadow: 3px 3px 5px 1px rgb(181, 148, 241);">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-center">
                    <div class="d-flex align-items-center">
                        <h4 class="fw-bold text-dark mb-0">
                            📝 Buat Laporan Proyek
                        </h4>
                    </div>
                </div>
            </div>
        </div> 
        
    </div>
    <h3>📝 Buat Laporan Proyek</h3>

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
            <textarea name="keterangan" class="form-control" rows="3"></textarea>
        </div>
        <div class="form-group">
            <strong>Kendala</strong>
            <textarea name="kendala" class="form-control" rows="3"></textarea>
        </div>
        <div class="form-group">
            <strong>Evaluasi</strong>
            <textarea name="evaluasi" class="form-control" rows="3"></textarea>
        </div>
        <div class="form-group">
            <strong>Persentase Awal</strong>
            <select name="persentase" class="form-control" required>
                <option value="">Pilih Berapa Persen Progres</option>
                <option value="30">30%</option>
                <option value="50">50%</option>
                <option value="80">80%</option>
                <option value="100">100%</option>
            </select>
        </div>


        <div class="form-group">
            <strong>Upload Dokumentasi (max 3 gambar)</strong>
            <input type="file" name="dokumentasi[]" class="form-control" multiple accept="image/*">
        </div>

        <button type="submit" class="btn btn-success mt-3">Kirim Laporan</button>
        <a href="{{ route('laporan_proyek.index') }}" class="btn btn-secondary mt-3">Batal</a>
    </form>
</div>
</div>
</div>
@endsection
