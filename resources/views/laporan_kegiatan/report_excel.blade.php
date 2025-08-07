<table>
    <tr>
        <td colspan="6" style="text-align: center;"><strong>PEMERINTAH KABUPATEN BOGOR</strong></td>
    </tr>
    <tr>
        <td colspan="6" style="text-align: center;"><strong>KECAMATAN BOJONG GEDE</strong></td>
    </tr>
    <tr>
        <td colspan="6" style="text-align: center;"><strong>DESA BOJONG GEDE</strong></td>
    </tr>
    <tr>
        <td colspan="6" style="text-align: center;"><strong>LAPORAN KEGIATAN TAHUN {{ $tahun }}</strong></td>
    </tr>
    <tr><td colspan="6"></td></tr> {{-- Kosong 1 baris --}}

    <tr>
        <th>No</th>
        <th>Nama Kegiatan</th>
        <th>Tanggal Kegiatan</th>
        <th>Waktu Kegiatan</th>
        <th>Lokasi</th>
        <th>Status</th>
    </tr>

    @foreach ($laporan as $index => $item)
    <tr>
        <td style="text-align: center">{{ $index + 1 }}</td>
        <td>{{ ucfirst($item->kegiatan->nama_kegiatan ?? '-') }}</td>
        <td style="text-align: center;">{{ optional($item->kegiatan)->tanggal_mulai ? \Carbon\Carbon::parse($item->kegiatan->tanggal_mulai)->translatedFormat('l, d F Y') : '-' }} s/d {{ optional($item->kegiatan)->tanggal_selesai ? \Carbon\Carbon::parse($item->kegiatan->tanggal_selesai)->translatedFormat('l, d F Y') : '-' }}</td>
        <td style="text-align: center;"> {{ \Carbon\Carbon::parse($item->kegiatan->waktu_mulai)->format('H.i') ?? '-' }} s/d {{ \Carbon\Carbon::parse($item->kegiatan->waktu_selesai)->format('H.i') ?? '-' }}</td>
        <td>{{ $item->kegiatan->alamat_terbalik ?? '-' }}</td>
        <td style="text-align: center;">{{ ucfirst($item->kegiatan->status ?? '-') }}</td>
    </tr>
    @endforeach
</table>
