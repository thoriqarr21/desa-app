@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Proses Persetujuan Laporan Kegiatan</h3>
    <div class="card shadow-sm border-2 border-radius-5 p-3">
    <form action="{{ route('laporan_kegiatan.approveaction', $laporanKegiatan) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label class="fw-bold form-label">Status Persetujuan</label><br>
            <div class="btn-group" role="group" aria-label="Status Persetujuan">
                <input type="radio" class="btn-check" name="is_approved" value="1" id="setuju"
                    autocomplete="off"
                    {{ old('is_approved', $laporanKegiatan->is_approved) == 1 ? 'checked' : '' }}>
                <label class="btn btn-outline-success" for="setuju"><i class="fas fa-check-circle me-1"></i> Setuju</label>
        
                <input type="radio" class="btn-check" name="is_approved" value="0" id="tidak"
                    autocomplete="off"
                    {{ old('is_approved', $laporanKegiatan->is_approved) == 0 ? 'checked' : '' }}>
                <label class="btn btn-outline-danger" for="tidak"><i class="fas fa-times-circle me-1"></i> Tidak Setuju</label>
            </div>
        </div>
        

        <div class="form-group mt-3" id="alasanTolak" style="display: {{ old('is_approved', $laporanKegiatan->is_approved) == 0 ? 'block' : 'none' }};">
            <label class="form-label">Alasan Penolakan</label>
            <textarea name="keterangan_tolak" class="form-control" style="height: 100px">{{ old('keterangan_tolak', $laporanKegiatan->keterangan_tolak) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        <a href="{{ route('laporan_kegiatan.index') }}" class="btn btn-secondary mt-3">Batal</a>
    </form>
</div>
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
