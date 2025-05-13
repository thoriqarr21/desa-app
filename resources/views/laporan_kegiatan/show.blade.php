@extends('layouts.app')

@section('content')
<div class="container-fluid py-2 mb-5">
    <div class="d-flex justify-content-between align-items-center margin-tb">
        <div class="d-flex align-items-center ms-3 ">
            <a class="btn btn-primary btn-sm fs-6 " href="{{ route('laporan_kegiatan.index') }}"><i class="fa fa-arrow-left fs-6"></i> Kembali</a>
            <a href="{{ route('laporan_kegiatan.cetak', $laporanKegiatan->id) }}" class="btn btn-sm btn-dark ms-2 fs-6" target="_blank">
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
            <h3>📄 Detail Laporan Kegiatan</h3>
            <hr style="box-shadow: 0px 3px 3px 1px rgb(181, 148, 241);">
<div class="card ps-5">
    <p><strong>Nama Kegiatan :</strong> {{ $laporanKegiatan->kegiatan->nama_kegiatan }}</p>
    <p><strong>Deskripsi Kegiatan :</strong> {{ $laporanKegiatan->kegiatan->deskripsi_kegiatan }}</p>
    <p><strong>Tanggal Mulai :</strong> {{ $laporanKegiatan->kegiatan->tanggal_mulai }}</p>
    <p><strong>Tanggal Berakhir :</strong> {{ $laporanKegiatan->kegiatan->tanggal_selesai }}</p>
    <p><strong>Waktu Mulai :</strong> {{ $laporanKegiatan->kegiatan->waktu_mulai }}</p>
    <p><strong>Waktu Berakhir :</strong> {{ $laporanKegiatan->kegiatan->waktu_selesai }}</p>
    <p><strong>Dibuat oleh :</strong> {{ $laporanKegiatan->user->name }}</p>
    <p><strong>Status Laporan :</strong>
        @if ($laporanKegiatan->is_approved == 1)
            <span class="badge text-bg-success">Disetujui</span>
        @elseif ($laporanKegiatan->is_approved === 0)
            <span class="badge text-bg-danger">Ditolak</span>
        @else 
            <span class="badge text-bg-warning text-dark">Pending</span>
        @endif
    </>
</p>

@if ($laporanKegiatan->is_approved === 0)
    <p><strong>Alasan Penolakan:</strong> {{ $laporanKegiatan->keterangan_tolak }}</p>
@endif
<hr>
<p><strong>Keterangan Laporan Kegiatan :</strong> {{ $laporanKegiatan->keterangan }}</p>
<p><strong>hasil Kegiatan :</strong> {{ $laporanKegiatan->hasil }}</p>
<p><strong>Tujuan Kegiatan Kegiatan :</strong> {{ $laporanKegiatan->tujuan_kegiatan }}</p>
<p><strong>Evaluasi Kegiatan :</strong> {{ $laporanKegiatan->evaluasi }}</p>
        </div>
        </div>

        <hr>
<div class="card shadow-sm border-0 p-4 mt-4">
    <h4>📸 Dokumentasi Kegiatan</h4>
    <div class="row mt-3">
        @forelse ($laporanKegiatan->dokumentasi as $dok)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    @if ($dok->file_type == 'image')
                        <img src="{{ asset('storage/' . $dok->file_path) }}" class="card-img-top" alt="Dokumentasi" style="max-height: 250px; object-fit: cover;">
                    @else
                        <video controls class="w-100" style="max-height: 250px; object-fit: cover;">
                            <source src="{{ asset('storage/' . $dok->file_path) }}" type="{{ \File::mimeType(public_path('storage/' . $dok->file_path)) }}">
                            Browser Anda tidak mendukung video.
                        </video>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-muted">Tidak ada dokumentasi tersedia.</p>
            </div>
        @endforelse
    </div>
</div>

    </div>
    @endsection
