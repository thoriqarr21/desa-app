<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Proyek {{ $tahun }}</title>
    <style>
         body {
            font-family: 'Times New Roman', serif;
            font-size: 12pt;
            margin: 10mm 5mm 5mm 10mm;
            line-height: 1.5;
        }
        .detail { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .detail th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        .detail th { background-color: #eee; text-align: center; }

        .header {
            overflow: hidden;
            margin-bottom: 10px;
        }   

        .header img {
            float: left;
            height: 80px;
            width: auto;
            margin-right: 10px; 
        }

        .header .info {
            display: table;
            height: 80px; 
            width: calc(100% - 100px); 
            text-align: center;
        }

        .header .info-content {
            display: table-cell;
            vertical-align: middle;
        }

        .header h4, .header h5 {
            margin: 0;
            font-size: 14pt;
            font-weight: bold;
            line-height: 1.2;   
        }

        .header p {
            clear: both;
            text-align: center;
            margin: 5px 0 0 0;
            font-size: 10pt;
            line-height: 1.2;
        }

        .line {
            border-bottom: 3px solid black;
            margin-top: 10px;
            margin-bottom: 15px;
        }

        .no-surat {
            font-size: 10pt;
            text-align: left;
            margin-bottom: 20px;
        }

        h3.title {
            text-align: center;
            text-decoration: underline;
            font-size: 14pt;
            margin-bottom: 5px; 
            margin-top: 2px; 
        }

        .nomor {
            text-align: center;
            margin-bottom: 30px; 
            font-size: 12pt;
        }

        .intro-text {
            text-align: justify;
            margin-bottom: 6px;
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
            color: #000; 
            padding-bottom: 5px;
        }

        h5 {
            font-size: 12px;
            margin-top: 15px;
            font-weight: bold;
        }

        .signature-table {
           
           width: 100%;
           margin-top: 40px;
       }

       .signature-table td {
            border: none;
           text-align: center;
           vertical-align: top;
           height: 100px;
       }
       .justify-text {
           /* text-align: justify; */
           word-wrap: break-word;  
           overflow-wrap: break-word; 
           width: 97px;
           max-width: 100px; /* Batasi lebar agar tetap dalam kolom */
           white-space: normal;
       }        
       .name-text {
           width: 100px; /* Batasi lebar agar tetap dalam kolom */
           white-space: normal;
        }        
        .tanggal-text {
           width: 80px; /* Batasi lebar agar tetap dalam kolom */
           white-space: normal;
        }        
        .detail th:nth-child(2),
        .detail td:nth-child(2) {
       
        word-break: break-word;
    }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('assets/img/logo_pemkab_bogor.jpg') }}" alt="Logo">
        <div class="info">
            <div class="info-content">
                <h4>PEMERINTAH KABUPATEN BOGOR</h4>
                <h4>KECAMATAN BOJONG GEDE</h4>
                <h5>DESA BOJONG GEDE</h5>
            </div>
        </div>
        <p>Jl. Raya Bojonggede No. 250 Bojonggede-Kabupaten Bogor, Kode Pos 16922</p>
        <div class="line"></div>
    </div>
    

   <h3 class="title">LAPORAN PROYEK TAHUN {{ $tahun }}</h3>
   <div class="nomor">Nomor : 140/{{ $nomorUrutFormatted }}/LapPro/{{ $bulanRomawiFormatted }}/{{ $tahun }}</div>
    <table class="detail">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Proyek</th>
                <th>Tanggal Mulai</th>
                <th>Keterangan</th>
                <th>Kendala</th>
                <th>Evaluasi</th>
                <th>Status Approval</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporan as $i => $laporanProyek)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td class="name-text">{{ $laporanProyek->proyek->nama_proyek ?? '-' }}</td>
                <td class="tanggal-text">{{ $laporanProyek->proyek->tanggal_mulai ?? '-' }} s/d {{ $laporanProyek->proyek->tanggal_mulai ?? '-' }}</td>
                <td class="justify-text">{{ $laporanProyek->keterangan }}</td>
                <td class="justify-text">{{ $laporanProyek->kendala }}</td>
                <td class="justify-text">{{ $laporanProyek->evaluasi }}</td>
                <td>            
                @if ($laporanProyek->is_approved == 1)
                <span class="badge bg-success">Disetujui</span>
                @elseif ($laporanProyek->is_approved === 0)
                    <span class="badge bg-danger">Ditolak</span>
                @else
                    <span class="badge bg-warning">Pending</span>
                @endif</td>
            </tr>
            @endforeach
        </tbody>
    </table>

       <!-- TANDA TANGAN -->
   <table class="signature-table">
    <tr>
        <td>Mengetahui,<br>Kepala Desa Bojong Gede</td>
        <td>Bojong Gede, {{ \Carbon\Carbon::now()->format('d F Y') }}<br>Kepala Desa Bojong Gede</td>
    </tr>
    <tr>
        <td style="padding-top: 70px;">{{ $nama_pejabat ?? 'Nama Pejabat' }}</td>
        <td style="padding-top: 70px;">Dede Malvina</td>
    </tr>
</table>
</body>
</html>