@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Proyek: {{ $proyek->nama_proyek }}</h2>

    <div class="card mb-3">
        <div class="card-body">
            <p><strong>Deskripsi:</strong> {{ $proyek->deskripsi }}</p>
            <p><strong>Anggaran:</strong> Rp {{ number_format($proyek->anggaran, 0, ',', '.') }}</p>
            <p><strong>Status:</strong> {{ ucfirst($proyek->status) }}</p>
            <p><strong>Tanggal Mulai:</strong> {{ $proyek->tanggal_mulai }}</p>
            <p><strong>Tanggal Akhir:</strong> {{ $proyek->tanggal_selesai }}</p>
            <p><strong>Masa Kontrak:</strong> {{ $proyek->masa_kontrak }}</p>
        </div>
    </div>

    <h4>Dokumentasi Upload Awal & Tambahan</h4>

    @php
    $grupUploadAwal = $proyek->dokumentasi->filter(fn($d) => $d->persentase <= 30)->groupBy('persentase');
    $grupUploadTambahan = $proyek->dokumentasi->filter(fn($d) => $d->persentase > 30)->groupBy('persentase');
@endphp
    
    {{-- Upload Awal --}}
    <h5 class="mt-4">📌 Upload Awal</h5>
    @foreach ($grupUploadAwal as $persen => $dokGroup)

                    @foreach ($dokGroup as $dok)
                    <div class="col-md-4 mb-3">
                        <img src="{{ asset('storage/' . $dok->file_path) }}" class="img-fluid rounded" alt="Dokumentasi">
                        <p class="mt-2">{{ $dok->keterangan }}</p>
                        <p class="mt-2">Progress: {{ $dok->progres?->persentase ?? '-' }}%</p>
                    </div>
                    @endforeach
    @endforeach
<h5 class="mt-4">📌 Upload Tambahan</h5>
@foreach ($grupUploadTambahan as $persen => $dikGroup)
    <div class="card mb-4">
        <div class="card-header bg-light">
            <strong>Progress {{ $persen }}%</strong>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($dikGroup as $dik)
                <div class="col-md-4 mb-3">
                    <img src="{{ asset('storage/' . $dik->file_path) }}" class="img-fluid rounded" alt="Dokumentasi">
                    <p class="mt-2">{{ $dik->keterangan }}</p>
                    <p class="mt-2">Progress: {{ $dik->persentase }}%</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endforeach

    
{{-- Upload Tambahan --}}
{{-- Form Tambah Dokumentasi Langsung --}}
<form action="{{ route('dokumentasi.storeTambahan') }}" method="POST" enctype="multipart/form-data" class="mb-4">
    @csrf
    <input type="hidden" name="proyek_id" value="{{ $proyek->id }}">

    <div class="row align-items-end">
        <div class="col-md-3">
            <label for="persentase" class="form-label">Pilih Persentase</label>
            <select name="persentase" id="persentase" class="form-control" required>
                <option value="50">50%</option>
                <option value="80">80%</option>
                <option value="100">100%</option>
            </select>
        </div>

        <div class="col-md-5">
            <label for="file" class="form-label">Upload Gambar</label>
            <input type="file" name="file_path" class="form-control" required>
        </div>

        <div class="col-md-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <input type="text" name="keterangan" class="form-control" placeholder="Keterangan" required>
        </div>

        <div class="col-md-1">
            <button type="submit" class="btn btn-success mt-3 w-100"><i class="fa fa-upload"></i></button>
        </div>
    </div>
</form>
</div>
@endsection
