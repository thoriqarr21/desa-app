@extends('layouts.app')

@section('content')
<div class="container">
    <h3>✅ Proses Persetujuan Laporan Kegiatan</h3>

    <form action="{{ route('laporan_kegiatan.approveaction', $laporanKegiatan) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Status Persetujuan</label><br>
            <input type="radio" name="is_approved" value="1" id="setuju" 
                {{ old('is_approved', $laporanKegiatan->is_approved) == 1 ? 'checked' : '' }}>
            <label for="setuju">Setuju</label>

            <input type="radio" name="is_approved" value="0" id="tidak" 
                {{ old('is_approved', $laporanKegiatan->is_approved) == 0 ? 'checked' : '' }}>
            <label for="tidak">Tidak Setuju</label>
        </div>

        <div class="form-group mt-3" id="alasanTolak" style="display: {{ old('is_approved', $laporanKegiatan->is_approved) == 0 ? 'block' : 'none' }};">
            <label>Alasan Penolakan</label>
            <textarea name="keterangan_tolak" class="form-control">{{ old('keterangan_tolak', $laporanKegiatan->keterangan_tolak) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        <a href="{{ route('laporan_kegiatan.index') }}" class="btn btn-secondary mt-3">Batal</a>
    </form>
</div>

<script>
    const radioTolak = document.getElementById('tidak');
    const radioSetuju = document.getElementById('setuju');
    const alasanBox = document.getElementById('alasanTolak');

    function toggleAlasan() {
        alasanBox.style.display = radioTolak.checked ? 'block' : 'none';
    }

    radioTolak.addEventListener('change', toggleAlasan);
    radioSetuju.addEventListener('change', toggleAlasan);

    window.onload = toggleAlasan;
</script>
@endsection
