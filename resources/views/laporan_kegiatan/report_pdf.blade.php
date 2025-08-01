<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Kegiatan {{ $tahun }}</title>
    <style>
         body {
            font-family: 'Times New Roman', serif;
            font-size: 12pt;
            margin: 10mm 5mm 5mm 10mm;
            line-height: 1.5;
        }
        .detail {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
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
             margin-left: auto;   
             margin-top: 40px;
             width: max-content; 
         }
         
         .signature-table td {
             border: none;
             text-align: center;
             vertical-align: top;
             height: 100px;
         }

        .justify-text {
           text-align: justify;
           word-wrap: break-word;  
           overflow-wrap: break-word; 
           max-width: 100px; 
           white-space: normal;
        }        
        .name-text {
           width: 100px; 
           white-space: normal;
        }        
        .tanggal-text {
           width: 80px; 
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
    

   <h3 class="title">LAPORAN KEGIATAN TAHUN {{ $tahun }}</h3>
   <div class="nomor">Nomor : 140/{{ $nomorUrutFormatted }}/LapKeg/{{ $bulanRomawiFormatted }}/{{ $tahun }}</div>
    <table class="detail">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kegiatan</th>
                <th>Tanggal Kegiatan</th>
                <th>Waktu Kegiatan</th>
                <th>Lokasi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporan as $i => $item)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td class="name-text">{{ ucfirst($item->kegiatan->nama_kegiatan ?? '-') }}</td>
                <td class="tanggal-text" style="text-align: center;">{{ $item->kegiatan->tanggal_mulai ?? '-' }} s/d {{ $item->kegiatan->tanggal_selesai ?? '-' }}</td>
                <td class="justify-text" style="text-align: center;"> {{ \Carbon\Carbon::parse($item->kegiatan->waktu_mulai)->format('H.i') ?? '-' }} s/d {{ \Carbon\Carbon::parse($item->kegiatan->waktu_selesai)->format('H.i') ?? '-' }}</td>
                <td>{{ $item->kegiatan->lokasi_nama ?? '-' }}</td>
                <td class="justify-text" style="text-align: center;">{{ ucfirst($item->kegiatan->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

       <!-- TANDA TANGAN -->
   <table class="signature-table">
    <tr>
        <td>Bojong Gede, {{ \Carbon\Carbon::now()->format('d F Y') }}<br>Kepala Desa Bojong Gede</td>
    </tr>
    <tr>
        <td style="padding-top: 70px;">Dede Malvina</td>
    </tr>
</table>
</body>
</html>
