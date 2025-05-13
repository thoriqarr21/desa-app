<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Kegiatan - {{ $laporanKegiatan->kegiatan->nama_kegiatan }}</title>
    <style>
  body {
            font-family: 'Times New Roman', serif; /* Font seperti dokumen resmi */
            font-size: 12px;
            line-height: 1.5;
            margin: 20mm; /* Margin keseluruhan dokumen */
        }

        /* Kop Surat */
        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            max-height: 70px;
            margin-bottom: 5px;
        }

        .header h4 {
            font-size: 14px;
            margin-bottom: 2px;
        }

        .header h5 {
            font-size: 12px;
            margin-bottom: 2px;
        }

        .header hr {
            border-top: 1px solid black;
            margin: 10px 0;
        }

        h3 {
            font-size: 16px;
            text-align: center;
            margin-bottom: 15px;
            text-decoration: underline;
        }

        h4 {
            font-size: 14px;
            margin-bottom: 8px;
            color: #000; /* Warna hitam untuk judul section */
            padding-bottom: 5px;
        }

        h5 {
            font-size: 12px;
            margin-top: 15px;
            font-weight: bold;
        }

        p {
            margin: 5px 0;
        }

        strong {
            font-weight: bold;
        }

        .badge {
            padding: 3px 8px;
            color: #fff;
            border-radius: 4px;
            font-size: 11px;
        }

        .bg-success { background-color: #28a745; }
        .bg-danger { background-color: #dc3545; }
        .bg-warning { background-color: #ffc107; color: #000; }

        .section {
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px dashed #ccc;
        }

        .section:first-child {
            border-top: none;
            padding-top: 0;
            margin-top: 10px;
        }

        .image-container {
        width: 130px; /* Atau lebar lain yang Anda inginkan */
        height: auto;
        margin: 5px;
        display: inline-block; /* Mengatur agar elemen berada dalam baris */
        vertical-align: top; /* Mencegah spasi vertikal antar elemen inline-block */
    }

    .image-grid {
        white-space: nowrap; /* Mencegah gambar pindah baris jika muat */
        overflow-x: auto; /* Jika gambar terlalu banyak, muncul scroll horizontal */
    }

    .image-grid img {
        max-width: 100%;
        height: auto;
        border: 1px solid #ccc;
        padding: 3px;
        display: block; /* Tetap block di dalam container */
    }
    
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('path/ke/logo-instansi.png') }}" alt="Logo Instansi">
        <h4>PEMERINTAH KABUPATEN/KOTA BOGOR </h4>
        <h4>KECAMATAN BOJONG GEDE</h4>
        <h5>KANTOR DESA/KELURAHAN BOJONG GEDE</h5>
        <p>Jl. Raya Bojonggede No. 250, Bojonggede, Kabupaten Bogor</p>
        <hr>
    </div>

    <h3>LAPORAN KEGIATAN</h3>

    <div class="section">
        <p><strong>Nama Kegiatan :</strong> {{ $laporanKegiatan->kegiatan->nama_kegiatan }}</p>
    <p><strong>Deskripsi Kegiatan :</strong> {{ $laporanKegiatan->kegiatan->deskripsi_kegiatan }}</p>
    <p><strong>Tanggal Mulai :</strong> {{ $laporanKegiatan->kegiatan->tanggal_mulai }}</p>
    <p><strong>Tanggal Berakhir :</strong> {{ $laporanKegiatan->kegiatan->tanggal_selesai }}</p>
    <p><strong>Waktu Mulai :</strong> {{ $laporanKegiatan->kegiatan->waktu_mulai }}</p>
    <p><strong>Waktu Berakhir :</strong> {{ $laporanKegiatan->kegiatan->waktu_selesai }}</p>
    <p><strong>Dibuat oleh :</strong> {{ $laporanKegiatan->user->name }}</p>
    <p><strong>Status Laporan :</strong>
        b 
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
<hr>
<div class="card shadow-sm border-0 p-4 mt-4">
    <h4>Dokumentasi Kegiatan</h4>
    <div class="row mt-3">
        @forelse ($laporanKegiatan->dokumentasi as $dok)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    @if ($dok->file_type == 'image')
                    <img src="{{ public_path('storage/' . $dok->file_path) }}" class="card-img-top" alt="Dokumentasi" style="max-height: 250px; object-fit: cover;">
                @else
                    <p><strong>Dokumentasi Video:</strong> {{ $dok->file_path }}</p>
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

</body>
</html>