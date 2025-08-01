<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Kegiatan Desa</title>
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
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('assets/img/logo_pemkab_bogor.jpg') }}" alt="Logo">
        <div class="info">
            <h4>PEMERINTAH KABUPATEN BOGOR</h4>
            <h4>KECAMATAN BOJONG GEDE</h4>
            <h5>DESA BOJONG GEDE</h5>
            {{-- <p>Telp/Hp. 085700157725 Website: http://sered-banjarnegara.desa.id</p> --}}
           </div>
           <p>Jl. Raya Bojonggede No. 250 Bojonggede-Kabupaten Bogor, Kode Pos 16922</p>
        <div style="clear: both;"></div>
        <div class="line"></div>
    </div>


    {{-- <div class="no-surat">No. Kode Desa : 33.04.08.2010</div> --}}

   <h3 class="title">LAPORAN KEGIATAN DESA</h3>
   <div class="nomor">Nomor : 140/{{ $nomorUrutFormatted }}/LapKeg/{{ $bulanRomawiFormatted }}/{{ $tahun }}</div>
   {{-- @php
   $bulanRomawi = ['I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII'];
   $bulan = $bulanRomawi[date('n') - 1];
   $tahun = date('Y');
   @endphp
   <div class="nomor">Nomor : 140/01/LapKeg/{{ $bulan }}/{{ $tahun }}</div> --}}


    <p class="intro-text">
        Yang bertanda tangan di bawah ini Kepala Desa Bojong Gede, Kecamatan Bojong Gede,
        Kabupaten Bogor, Provinsi Jawa Barat isi laporan kegiatan sebagai berikut :
    </p>

    <table class="detail">
       <tr><td>1. Nama Kegiatan</td><td>:</td><td>{{ $laporanKegiatan->kegiatan->nama_kegiatan }}</td></tr>
       <tr><td>2. Tanggal</td><td>:</td><td>{{ $laporanKegiatan->kegiatan->tanggal_mulai }} s/d {{ $laporanKegiatan->kegiatan->tanggal_selesai }}</td></tr>
       <tr><td>3. Waktu</td><td>:</td><td>{{ $laporanKegiatan->kegiatan->waktu_mulai }} Wib s/d {{ $laporanKegiatan->kegiatan->waktu_selesai }} Wib</td></tr>
       <tr><td>4. Deskripsi Kegiatan</td><td>:</td><td class="justify-text">{{ $laporanKegiatan->kegiatan->deskripsi_kegiatan }}</td></tr>
       <tr><td>5. Dibuat Oleh</td><td>:</td><td>{{ $laporanKegiatan->user->name }}</td></tr>
       @php
       $koordinat = explode(',', $laporanKegiatan->kegiatan->lokasi);
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
       <tr><td>6. Lokasi</td><td>:</td><td class="justify-text">{{ $alamat }}</td></tr>
       <tr><td>7. Lama Hari Kegiatan</td><td>:</td><td>{{ $laporanKegiatan->kegiatan->lama_hari }}</td></tr>
       <tr><td>8. Status Laporan</td><td>:</td><td>
           @if ($laporanKegiatan->is_approved == 1)
               <span class="badge bg-success">Disetujui</span>
           @elseif ($laporanKegiatan->is_approved === 0)
               <span class="badge bg-danger">Ditolak</span>
           @else
               <span class="badge bg-warning">Pending</span>
           @endif
       </td></tr>
       @if ($laporanKegiatan->is_approved === 0)
       <tr><td>9. Alasan Penolakan Laporan</td><td>:</td><td>{{ $laporanKegiatan->keterangan_tolak }}</td></tr>
       @endif
       <!-- KETERANGAN -->
       <p>Detail Laporan Kegiatan</p>
       <tr>
           <td style="width: 45%;">1. Keterangan</td>
           <td style="width: 2%;">:</td>
           <td class="justify-text" style="width: 78%;">{{ $laporanKegiatan->keterangan }}</td>
       </tr>
       <tr>
           <td>2. Hasil Kegiatan</td>
           <td>:</td>
           <td class="justify-text">{{ $laporanKegiatan->hasil }}</td>
       </tr>
       <tr>
           <td>3. Tujuan Kegiatan</td>
           <td>:</td>
           <td class="justify-text">{{ $laporanKegiatan->tujuan_kegiatan }}</td>
       </tr>
       <tr>
           <td>4. Evaluasi Kegiatan</td>
           <td>:</td>
           <td class="justify-text">{{ $laporanKegiatan->evaluasi }}</td>
       </tr>
       {{-- <tr><td>9. Surat bukti diri</td><td>:</td><td></td></tr>
       <tr><td style="padding-left: 30px;">KTP</td><td></td><td>3304080102030003</td></tr>
       <tr><td style="padding-left: 30px;">KK</td><td></td><td>3304080060708224</td></tr> --}}
   </table>
   
   <p style="padding-top: 5px; border-top: 1px solid rgb(202, 202, 202)">Dokumentasi Kegiatan</p>
   @forelse ($laporanKegiatan->dokumentasi as $dok)
   @if ($dok->file_type == 'image')
       <img src="{{ public_path('storage/' . $dok->file_path) }}" style="width: 200px; margin: 5px;" alt="Dokumentasi">
   @else
       <p><p>Dokumentasi Video:</p> {{ $dok->file_path }}</p>
   @endif
   @empty
       <p><em>Tidak ada dokumentasi tersedia.</em></p>
   @endforelse
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