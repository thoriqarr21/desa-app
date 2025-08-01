<table>
    <tr>
        <td colspan="13" style="text-align: center;"><strong>PEMERINTAH KABUPATEN BOGOR</strong></td>
    </tr>
    <tr>
        <td colspan="13" style="text-align: center;"><strong>KECAMATAN BOJONG GEDE</strong></td>
    </tr>
    <tr>
        <td colspan="13" style="text-align: center;"><strong>DESA BOJONG GEDE</strong></td>
    </tr>
    <tr>
        <td colspan="13" style="text-align: center;"><strong>LAPORAN PROYEK PEMBANGUNAN DESA TAHUN {{ $tahun }}</strong></td>
    </tr>
    <tr><td colspan="13"></td></tr> {{-- Kosong 1 baris --}}

    <tr>
        <th>No</th>
        <th>Nama Proyek</th>
        <th>Tanggal Proyek</th>
        <th>Masa Kontrak</th>
        <th>Anggaran</th>
        <th>Lokasi</th>
        <th>Status Proyek</th>
        <th>Sumber Dana</th>
        <th>jenis Proyek</th>
        <th>Keterangan</th>
        <th>Kendala</th>
        <th>Evaluasi</th>
        <th>Status Laporan</th>
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
        <td  style="text-align: center">{{ $item->proyek->masa_kontrak ?? '-' }}</td>
        <td style="text-align: center">Rp. {{ number_format($item->proyek->anggaran, 0, ',', '.') }}</td>
        <td>{{ $item->proyek->lokasi_nama ?? '-' }}</td>
        <td style="text-align: center">{{ ucfirst($item->proyek->status ?? '-') }}</td>
        <td style="text-align: center">{{ ucfirst($item->proyek->sumber_dana ?? '-') }}</td>
        <td style="text-align: center">{{ ucfirst($item->proyek->jenis_proyek ?? '-') }}</td>
        <td>{{ $item->keterangan ?? '-' }}</td>
        <td>{{ $item->kendala ?? '-' }}</td>
        <td>{{ $item->evaluasi ?? '-' }}</td>        
        <td style="text-align: center"> 
        @if ($item->is_approved == 1)
            <span class="badge text-bg-success">Disetujui</span>
        @elseif ($item->is_approved === 0)
            <span class="badge text-bg-danger">Ditolak</span>
        @else
            <span class="badge text-bg-warning">Pending</span>
        @endif</td>
    </tr>
    @endforeach
</table>
