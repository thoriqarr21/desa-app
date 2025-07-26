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
        <td colspan="6" style="text-align: center;"><strong>LAPORAN PROYEK TAHUN {{ $tahun }}</strong></td>
    </tr>
    <tr><td colspan="6"></td></tr> {{-- Kosong 1 baris --}}

    <tr>
        <th>No</th>
        <th>Nama Proyek</th>
        <th>Tanggal Proyek</th>
        <th>Anggaran</th>
        <th>Lokasi</th>
        <th>Status</th>
    </tr>

    @foreach ($laporan as $index => $item)
    <tr>
        <td style="text-align: center">{{ $index + 1 }}</td>
        <td>{{ ucfirst($item->proyek->nama_proyek ?? '-') }}</td>
        <td style="text-align: center;">
            {{ $item->proyek->tanggal_mulai ? \Carbon\Carbon::parse($item->proyek->tanggal_mulai)->format('d-m-Y') : '-' }}
            s/d
            {{ $item->proyek->tanggal_selesai ? \Carbon\Carbon::parse($item->proyek->tanggal_selesai)->format('d-m-Y') : '-' }}
        </td>
        <td style="text-align: center">Rp. {{ number_format($item->proyek->anggaran, 0, ',', '.') }}</td>
        <td>{{ $item->proyek->lokasi_nama ?? '-' }}</td>
        <td style="text-align: center">{{ ucfirst($item->proyek->status ?? '-') }}</td>
    </tr>
    @endforeach
</table>
