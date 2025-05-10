@extends('layouts.app')

@section('content')
<div class="container-fluid py-2 mb-5">
    <div class="d-flex justify-content-between align-items-center margin-tb">
        <div class="d-flex align-items-center ms-3 ">
            <a class="btn btn-primary btn-sm fs-6 " href="{{ route('laporan_proyek.index') }}"><i class="fa fa-arrow-left fs-6"></i> Kembali</a>
            <a href="{{ route('laporan_proyek.cetak', $laporanProyek->id) }}" class="btn btn-sm btn-dark ms-2 fs-6" target="_blank">
                Cetak PDF
            </a>
        </div>
        <div class="card border-0 mb-4 w-40" style="box-shadow: 3px 3px 5px 1px rgb(181, 148, 241);">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-center">
                    <div class="d-flex align-items-center">
                        <h4 class="fw-bold text-dark mb-0">
                            Detail Laporan
                        </h4>
                    </div>
                </div>
            </div>
        </div> 
    </div>
        <div class="card shadow-sm border-0">
            <h3>📄 Detail Laporan Proyek</h3>
            <hr style="box-shadow: 0px 3px 3px 1px rgb(181, 148, 241);">
<div class="card ps-5">
    <p><strong>Nama Proyek :</strong> {{ $laporanProyek->proyek->nama_proyek }}</p>
    <p><strong>Anggaran :</strong> Rp{{ number_format($laporanProyek->proyek->anggaran, 0, ',', '.') }}</p>
    <p><strong>Status Proyek :</strong> {{ $laporanProyek->proyek->status }}</p>
    <p><strong>Masa Kontrak :</strong> {{ $laporanProyek->proyek->masa_kontrak }}</p>
    <p><strong>Tanggal Mulai :</strong> {{ $laporanProyek->proyek->tanggal_mulai }}</p>
    <p><strong>Tanggal Berakhir :</strong> {{ $laporanProyek->proyek->tanggal_selesai }}</p>
    <p><strong>Dibuat oleh :</strong> {{ $laporanProyek->user->name }}</p>
    <p><strong>Status Laporan :</strong>
        
        @if ($laporanProyek->is_approved == 1)
            <span class="badge text-bg-success">Disetujui</span>
        @elseif ($laporanProyek->is_approved === 0)
            <span class="badge text-bg-danger">Ditolak</span>
        @else 
            <span class="badge text-bg-warning text-dark">Pending</span>
        @endif
    </>
</p>

@if ($laporanProyek->is_approved === 0)
    <p><strong>Alasan Penolakan:</strong> {{ $laporanProyek->keterangan_tolak }}</p>
@endif
<hr>
<p><strong>Keterangan Laporan Proyek :</strong> {{ $laporanProyek->keterangan }}</p>
<p><strong>Kendala Proyek :</strong> {{ $laporanProyek->kendala }}</p>
<p><strong>Evaluasi Proyek :</strong> {{ $laporanProyek->evaluasi }}</p>
        </div>
        </div>
        <hr>
        <hr>
        <h4>Dokumentasi Upload Awal & Tambahan</h4>

        @php
        // Group dokumentasi based on the 'is_initial' flag
        $grupUploadAwal = $laporanProyek->dokumentasi->where('is_initial', false);
        $grupUploadTambahan = $laporanProyek->dokumentasi->where('is_initial', true)->groupBy('persentase');
        @endphp
        
        {{-- Upload Awal --}}
        <h5 class="mt-4">📌 Upload Awal</h5>
        @foreach ($grupUploadAwal as $dok)
            <div class="col-md-4 mb-3">
                <img src="{{ asset('storage/' . $dok->file_path) }}" class="img-fluid rounded" alt="Dokumentasi">
                <p class="mt-2">{{ $dok->keterangan }}</p>
                <p class="mt-2">Progress: {{ $dok->progres?->persentase ?? '-' }}%</p>
                {{-- <p>is_initial: {{ $dok->is_initial ? 'true' : 'false' }}</p> --}}

            </div>
        @endforeach
        
        {{-- Upload Tambahan --}}
        <h5 class="mt-4">📌 Upload Tambahan</h5>

@foreach ($grupUploadTambahan as $persen => $doks)
    <div class="card mb-4">
        <div class="card-header bg-light">
            <div class="row g-2">
                <strong>Progress: {{ $persen }}%</strong>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <strong class="mb-2">Foto Dokumentasi Proyek</strong>
                @foreach ($doks as $dok)
                    <div class="col-md-4 mb-3">
                        <img src="{{ asset('storage/' . $dok->file_path) }}" class="img-fluid rounded" alt="Dokumentasi">
                        <p><strong>Keterangan:</strong> {{ $dok->keterangan }}</p>
                        <form action="{{ route('dokumentasi.destroy', $dok->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus dokumentasi ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger mt-1">Hapus</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endforeach

    
        
    {{-- Upload Tambahan --}}
    {{-- Form Tambah Dokumentasi Langsung --}}
    <form action="{{ route('laporan_proyek.storeTambahan') }}" method="POST" enctype="multipart/form-data" class="mb-4">
        @csrf
        <input type="hidden" name="laporan_id" value="{{ $laporanProyek->id }}">
    
        <div class="row align-items-end">
            <div class="col-md-3">
                <label for="persentase" class="form-label">Pilih Persentase</label>
                <select name="persentase" class="form-control" required>
                    @forelse ($persenTersisa as $persen)
                        <option value="{{ $persen }}">{{ $persen }}%</option>
                    @empty
                        <option disabled>Proyek Selesai</option>
                    @endforelse
                </select>           
            </div>
            
    
            <div class="col-md-6">
                <label for="dokumentasi">Upload Gambar</label>
                <input type="file" name="dokumentasi[]" class="form-control" multiple accept="image/*">
            </div>
    
            <div class="col-md-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="3" placeholder="Keterangan berupa Kendala dan Evaluasi" required></textarea>
            </div>
    
            <div class="col-md-3 text-center">
                <button type="submit" class="btn btn-success mt-3 w-100"><i class="fa fa-upload"></i> Upload</button>
            </div>
        </div>
    </form>
    </div>
    @endsection
