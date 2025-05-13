@extends('frontend.layouts.master')

@section('content')
<div class="container">
    <h3>📝 Buat Laporan Proyek</h3>

    <form action="{{ route('frontend.laporan_proyek.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="proyek_id">Pilih Proyek</label>
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
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label>Kendala</label>
            <textarea name="kendala" class="form-control" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label>Evaluasi</label>
            <textarea name="evaluasi" class="form-control" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label>Persentase Awal</label>
            <select name="persentase" class="form-control" required>
                <option value="">Pilih Berapa Persen Progres</option>
                <option value="30">30</option>
                <option value="50">50</option>
                <option value="80">80</option>
                <option value="100">100</option>
            </select>
        </div>


        <div class="form-group">
            <label>Upload Dokumentasi (max 3 gambar)</label>
            <input type="file" name="dokumentasi[]" class="form-control" multiple accept="image/*">
        </div>

        <button type="submit" class="btn btn-success mt-3">Kirim Laporan</button>
        <a href="{{ route('laporan_proyek.index') }}" class="btn btn-secondary mt-3">Batal</a>
    </form>
</div>
@endsection
