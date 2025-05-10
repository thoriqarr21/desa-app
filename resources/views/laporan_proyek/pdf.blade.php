<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Proyek - {{ $laporanProyek->proyek->nama_proyek }}</title>
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

    <h3>LAPORAN PROYEK</h3>

    <div class="section">
        <p><strong>Nama Proyek :</strong> {{ $laporanProyek->proyek->nama_proyek }}</p>
        <p><strong>Anggaran :</strong> Rp{{ number_format($laporanProyek->proyek->anggaran, 0, ',', '.') }}</p>
        <p><strong>Status Proyek :</strong> {{ $laporanProyek->proyek->status }}</p>
        <p><strong>Masa Kontrak :</strong> {{ $laporanProyek->proyek->masa_kontrak }}</p>
        <p><strong>Tanggal Mulai :</strong> {{ $laporanProyek->proyek->tanggal_mulai }}</p>
        <p><strong>Tanggal Berakhir :</strong> {{ $laporanProyek->proyek->tanggal_selesai }}</p>
        <p><strong>Dibuat oleh :</strong> {{ $laporanProyek->user->name }}</p>
        <p><strong>Status Laporan :</strong>
            @if ($laporanProyek->is_approved == 1)
                <span class="badge bg-success">Disetujui</span>
            @elseif ($laporanProyek->is_approved === 0)
                <span class="badge bg-danger">Ditolak</span>
            @else
                <span class="badge bg-warning">Pending</span>
            @endif
        </p>
        @if ($laporanProyek->is_approved === 0)
            <p><strong>Alasan Penolakan:</strong> {{ $laporanProyek->keterangan_tolak }}</p>
        @endif
    </div>

    <div class="section">
        <h4>Informasi Laporan</h4>
        <p><strong>Keterangan:</strong> {{ $laporanProyek->keterangan }}</p>
        <p><strong>Kendala:</strong> {{ $laporanProyek->kendala }}</p>
        <p><strong>Evaluasi:</strong> {{ $laporanProyek->evaluasi }}</p>

    @php
        $grupUploadAwal = $laporanProyek->dokumentasi->where('is_initial', false);
        $grupUploadTambahan = $laporanProyek->dokumentasi->where('is_initial', true)->groupBy('persentase');
    @endphp

    <div class="image-grid">
        <h4>Upload Awal</h4>
        @if ($grupUploadAwal->count() > 0)
            <p><strong>Keterangan:</strong> {{ $grupUploadAwal->first()->keterangan }}</p>
            <p><strong>Progress:</strong> {{ $grupUploadAwal->first()->progres?->persentase ?? '-' }}%</p>
            <p><strong>Dokumentasi : </strong></p>
        @endif
        <div class="image-grid">
            @forelse ($grupUploadAwal as $dok)
                <div class="image-container">
                    <img src="{{ public_path('storage/' . $dok->file_path) }}" >
                </div>
            @empty
                <p>Tidak ada dokumentasi awal.</p>
            @endforelse
        </div>
    </div>

    <div class="image-grid">
        <h4>Upload Tambahan</h4>
        @forelse ($grupUploadTambahan as $persen => $doks)
            <hr>
            <h5>Progress: {{ $persen }}%</h5>
            <p><strong>Keterangan:</strong> {{ $doks->first()->keterangan }}</p>
            <p><strong>Dokumentasi : </strong></p>
            <div class="image-grid">
                @foreach ($doks as $dok)
                    <div class="image-container">
                        <img src="{{ public_path('storage/' . $dok->file_path) }}" class="image">
                    </div>
                @endforeach
            </div>
        @empty
            <p>Tidak ada dokumentasi tambahan.</p>
        @endforelse
    </div>
</body>
</html>