@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Kegiatan Desa</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary btn-sm mb-2" href="{{ route('kegiatan.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>
</div>

@if (count($errors) > 0)
    <div class="alert alert-danger">
      <strong>Whoops!</strong> There were some problems with your input.<br><br>
      <ul>
         @foreach ($errors->all() as $error)
           <li>{{ $error }}</li>
         @endforeach
      </ul>
    </div>
@endif

<form method="POST" action="{{ route('kegiatan.update', $kegiatan->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama Kegiatan:</strong>
                <label for="nama_kegiatan">Nama Kegiatan</label>
                <input type="text" name="nama_kegiatan" placeholder="Nama Kegiatan" class="form-control" value="{{ $kegiatan->nama_kegiatan }}">
            </div>
        </div>
        <div class="form-group">
            <label for="deskripsi_kegiatan">Deskripsi  Kegiatan</label>
            <textarea name="deskripsi_kegiatan" id="deskripsi_kegiatan" class="form-control" required>{{ $kegiatan->deskripsi_kegiatan }}</textarea>
        </div>

        <div class="form-group">
            <label for="kategori_id">Pilih Kategori</label>
            <select name="kategori_id" id="kategori_id" class="form-control" required>
                <option value="">-- Pilih --</option>
                @foreach ($kategoriKegiatans as $kategoriKegiatan)
                    <option value="{{ $kategoriKegiatan->id }}" {{ $kategoriKegiatan->id == $kegiatan->kategori_id ? 'selected' : '' }}>
                        {{ $kategoriKegiatan->nama_kategori }}
                    </option>
                @endforeach
            </select>            
            @error('kategori_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="tanggal_mulai">Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" placeholder="Tanggal Mulai" class="form-control" value="{{ $kegiatan->tanggal_mulai }}">
        </div>
        <div class="form-group">
            <label for="tanggal_selesai">Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" placeholder="Tanggal Selesai" class="form-control" value="{{ $kegiatan->tanggal_selesai }}">
        </div>
        <div class="form-group">
            <label for="waktu_mulai">Waktu Mulai</label>
            <input type="time" name="waktu_mulai" placeholder="waktu Mulai" class="form-control" value="{{ $kegiatan->waktu_mulai }}">
        </div>
        <div class="form-group">
            <label for="waktu_selesai">Waktu Selesai</label>
            <input type="time" name="waktu_selesai" placeholder="waktu Selesai" class="form-control" value="{{ $kegiatan->waktu_selesai }}">
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="batal" {{ $kegiatan->status === 'batal' ? 'selected' : '' }}>Batal</option>
                <option value="berjalan" {{ $kegiatan->status === 'berjalan' ? 'selected' : '' }}>Berjalan</option>
                <option value="selesai" {{ $kegiatan->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>
        <div class="form-group">
            <label for="lokasi">Lokasi Kegiatan</label>
            <input type="text" name="lokasi" placeholder="waktu Selesai" class="form-control" value="{{ $kegiatan->lokasi }}">
        </div>

        <div class="form-group">
            <label for="gambar">Gambar Proyek</label>
            <input type="file" name="gambar" id="gambar" class="form-control">
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary btn-sm mt-2 mb-3"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
        </div>
    </div>
</form>


@endsection
