<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan Pengantar</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            font-size: 12pt;
            margin: 10mm 25mm 25mm 25mm;
            line-height: 1.5;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
            overflow: hidden; 
        }

        .header img {
            float: left; 
            height: 70px; 
            width: auto;
            margin-right: 5px; 
            margin-left: 1px;
        }

        .header .info {
        
            text-align: center;
            overflow: hidden; 
        }

        .header h4 {
            margin: 0;
            font-size: 14pt; 
            font-weight: bold;
            line-height: 1.2;
        }

        .header h5 {
            margin: 0;
            font-size: 16pt; 
            font-weight: bold;
            line-height: 1.2;
        }

        .header p {
            margin: 0;
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

        table.detail {
            width: 100%;
            margin-top: 0; 
            margin-bottom: 20px;
            border-collapse: collapse; 
            table-layout: fixed;
        }

        table.detail td {
           vertical-align: top;
           padding: 2px 0; 
           line-height: 1.5; 
           word-wrap: break-word;
           overflow-wrap: break-word;
        }

        table.detail td:nth-child(1) {
            width: 150px; 
            padding-left: 20px; 
        }

        table.detail td:nth-child(2) {
            width: 10px; 
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
       }
       .section-heading {
            margin-top: 30px;
            margin-bottom: 10px;
            font-weight: bold;
            font-size: 14pt; 
        }

        .sub-section-heading {
            margin-top: 0;
            margin-bottom: 5px;
            font-weight: bold;
            font-size: 12pt;
        }

        .image-grid {
            text-align: start; 
           
        }

        .image-container {
            width: 200px; 
            height: auto; 
            margin: 5px;
            display: inline-block; 
            vertical-align: top;
        }

        .image-container img {
            max-width: 100%;
            height: auto;
            border: 1px solid #ccc;
            padding: 3px;
            display: block; 
        }
        .dokumentasi-detail p {
            padding-left: 20px;
        }
        .dokumentasi-detail img {
            margin-left: 20px;
        }
        .info-line {
        display: grid;
        grid-template-columns: 120px 10px auto;
        margin-bottom: 4px;
        margin-left: 20px;
    }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('assets/img/logo_pemkab_bogor.jpg') }}" alt="Logo">
        <div class="info">
            <h4>PEMERINTAH KABUPATEN BOGOR</h4>
            <h4>KECAMATAN BOJONG GEDE</h4>
            <h5>DESA BOJONG GEDE</h5>
           </div>
           <p>Jl. Raya Bojonggede No. 250 Bojonggede-Kabupaten Bogor, Kode Pos 16922</p>
        <div style="clear: both;"></div>
        <div class="line"></div>
    </div>


    

   <h3 class="title">LAPORAN PROYEK DESA</h3>
   <div class="nomor">Nomor : 140/{{ $nomorUrutFormatted }}/LapPro/{{ $bulanRomawiFormatted }}/{{ $tahun }}</div>
   


    <p class="intro-text">
        Yang bertanda tangan di bawah ini Kepala Desa Bojong Gede, Kecamatan Bojong Gede,
        Kabupaten Bogor, Provinsi Jawa Barat isi laporan Proyek sebagai berikut :
    </p>

    <table class="detail">
       <tr><td>1. Nama Proyek</td><td>:</td><td>{{ $laporanProyek->proyek->nama_proyek }}</td></tr>
       <tr><td>2. Tanggal</td><td>:</td><td>{{ $laporanProyek->proyek->tanggal_mulai }} s/d {{ $laporanProyek->proyek->tanggal_selesai }}</td></tr>
       <tr><td>3. Anggaran</td><td>:</td><td>Rp. {{ number_format($laporanProyek->proyek->anggaran, 0, ',', '.') }}</td></tr>
       <tr><td>4. Masa Kontrak</td><td>:</td><td>{{ $laporanProyek->proyek->masa_kontrak }}</td></tr>
       <tr><td>5. Deskripsi Proyek</td><td>:</td><td class="justify-text">{{ $laporanProyek->proyek->deskripsi_proyek }}</td></tr>
       <tr><td>6. Dibuat Oleh</td><td>:</td><td>{{ $laporanProyek->user->name }}</td></tr>
       @php
       $koordinat = explode(',', $laporanProyek->proyek->lokasi);
       $lat = trim($koordinat[0] ?? '');
       $lng = trim($koordinat[1] ?? '');
       $alamat = 'Gagal mengambil alamat';
   
       if ($lat && $lng) {
           $url = "https://nominatim.openstreetmap.org/reverse?lat=$lat&lon=$lng&format=json";
   
           $curl = curl_init();
           curl_setopt_array($curl, [
               CURLOPT_URL => $url,
               CURLOPT_RETURNTRANSFER => true,
               CURLOPT_USERAGENT => 'Laporan Desa Sered (Laravel PDF)',
               CURLOPT_TIMEOUT => 10,
           ]);
           $response = curl_exec($curl);
   
           if (!curl_errno($curl)) {
               $data = json_decode($response, true);
               if (isset($data['display_name'])) {
                   $alamat = $data['display_name'];
               }
           }
   
           curl_close($curl);
        }
        @endphp
        <tr><td>7. Lokasi</td><td>:</td><td class="justify-text">{{ $alamat }}</td></tr>
        <tr><td>8. Status Proyek</td><td>:</td><td>{{ ucfirst($laporanProyek->proyek->status) }}</td></tr>
        <tr><td>9. Status Laporan</td><td>:</td><td>
            @if ($laporanProyek->is_approved == 1)
            <span class="badge bg-success">Disetujui</span>
            @elseif ($laporanProyek->is_approved === 0)
            <span class="badge bg-danger">Ditolak</span>
            @else
            <span class="badge bg-warning">Pending</span>
            @endif
       </td></tr>
       @if ($laporanProyek->is_approved === 0)
       <tr><td>10. Alasan Penolakan Laporan</td><td>:</td><td>{{ $laporanProyek->keterangan_tolak }}</td></tr>
       @endif
       <!-- KETERANGAN -->
       <p>Detail Laporan Proyek</p>
       <tr>
           <td style="width: 45%;">1. Keterangan</td>
           <td style="width: 2%;">:</td>
           <td class="justify-text" style="width: 78%;">{{ $laporanProyek->keterangan }}</td>
       </tr>
       <tr>
           <td>2. Tujuan Proyek</td>
           <td>:</td>
           <td class="justify-text">{{ $laporanProyek->kendala}}</td>
       </tr>
       <tr>
           <td>3. Evaluasi Proyek</td>
           <td>:</td>
           <td class="justify-text">{{ $laporanProyek->evaluasi }}</td>
       </tr>
       {{-- <tr><td>9. Surat bukti diri</td><td>:</td><td></td></tr>
       <tr><td style="padding-left: 30px;">KTP</td><td></td><td>3304080102030003</td></tr>
       <tr><td style="padding-left: 30px;">KK</td><td></td><td>3304080060708224</td></tr> --}}
   </table>
   
   <p style="padding-top: 5px; border-top: 1px solid rgb(202, 202, 202)">Dokumentasi Proyek</p>


   @php
   $grupUploadAwal = $laporanProyek->dokumentasi->where('is_initial', false);
   $grupUploadTambahan = $laporanProyek->dokumentasi->where('is_initial', true)->groupBy('persentase');
@endphp

<div class="dokumentasi-detail">
   <p class="sub-section-heading">Upload Awal</p>
   @if ($grupUploadAwal->count() > 0)
   <table class="detail">
    <td style="width: 45%;">Keterangan</td>
    <td style="width: 2%;">:</td>
    <td class="justify-text" style="width: 78%;">{{ $grupUploadAwal->first()->keterangan }}</td></tr>
    <tr><td>Progres</td><td>:</td><td>{{ $grupUploadAwal->first()->progres?->persentase ?? '-' }}%</td></tr>
    <tr><td>Foto/Video</td><td>:</td><td></td></tr>
   </table>
   @endif
   <div class="image-grid"> 
       @forelse ($grupUploadAwal as $dok)
           <div class="image-container">
               @if ($dok->file_type == 'image')
                   <img src="{{ public_path('storage/' . $dok->file_path) }}" alt="Dokumentasi Awal">
               @else
                   <p class="mb-0">Video: {{ $dok->file_path }}</p>
               @endif
           </div>
       @empty
           <p class="mb-0">Tidak ada dokumentasi awal.</p>
       @endforelse
   </div>
</div>

<div class="dokumentasi-detail ">
   <p class="sub-section-heading">Upload Tambahan</p>
   @forelse ($grupUploadTambahan as $persen => $doks)
   <table class="detail" style="border-top: 1px solid rgb(202, 202, 202); padding-top: 10px">
    <td style="width: 45%;">Keterangan</td>
    <td style="width: 2%;">:</td>
    <td class="justify-text" style="width: 78%;">{{ $doks->first()->keterangan }}</td></tr>
    <tr><td>Progres</td><td>:</td><td>{{ $persen }}%</td></tr>
    <tr><td>Foto/Video</td><td>:</td><td></td></tr>
   </table>

       <div class="image-grid">
           @foreach ($doks as $dok)
               <div class="image-container">
                   @if ($dok->file_type == 'image')
                       <img src="{{ public_path('storage/' . $dok->file_path) }}" alt="Dokumentasi Tambahan">
                   @else
                       <p class="mb-0">Video: {{ $dok->file_path }}</p>
                   @endif
               </div>
           @endforeach
       </div>
   @empty
       <p class="mb-0">Tidak ada dokumentasi tambahan.</p>
   @endforelse
</div>
   <!-- Dokumentasi -->
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