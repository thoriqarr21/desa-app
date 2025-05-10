@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Kegiatan</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary btn-sm" href="{{ route('kegiatan.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('kegiatan.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="form-group">
            <div class="form-group">
                <strong>Nama kegiatan:</strong>
                <input type="text" name="nama_kegiatan" class="form-control" placeholder="Nama Kegiatan">
            </div>
        </div>
        <div class="form-group">
            <div class="form-group">
                <strong>Deskripsi Kegiatan:</strong>
                <textarea class="form-control" style="height:150px" name="deskripsi_kegiatan" placeholder="Deskripsi Kegiatan"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="kategori_id">Pilih Kategori</label>
            <select name="kategori_id" id="kategori_id" class="form-control" required>
                <option value="">-- Pilih --</option>
                @foreach ($kategoriKegiatans as $kategoriKegiatan)
                    <option value="{{ $kategoriKegiatan->id }}">{{ $kategoriKegiatan->nama_kategori }}</option>
                @endforeach
            </select>
            @error('kategori_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Waktu Mulai</label>
            <input type="time" name="waktu_mulai" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Waktu Selesai</label>
            <input type="time" name="waktu_selesai" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="">Pilih Status</option>
                <option value="perencanaan">Batal</option>
                <option value="berjalan">Berjalan</option>
                <option value="selesai">Selesai</option>
            </select>
        </div>
        <div class="form-group">
            <label>Gambar</label>
            <input type="file" name="gambar" class="form-control">
        </div>
        <div class="form-group">
            <label>Lokasi Kegiatan</label>
            <input type="text" name="lokasi" id="lokasi" class="form-control" required>
            {{-- <div id="alamat-lokasi" class="form-control bg-light" readonly>Tunggu lokasi...</div>
            <small class="form-text text-muted">Klik pada peta untuk memilih titik koordinat.</small> --}}
        </div>

        <div class="form-group text-center">
                <button type="submit" class="btn btn-primary btn-sm mb-3 mt-2"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
        </div>
    </div>
</form>

@endsection
