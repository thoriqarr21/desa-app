@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
<div class="row">
    <div class="d-flex justify-content-between align-items-center margin-tb">
        <div class="d-flex align-items-center ms-3 ">
            <a class="btn btn-primary btn-sm fs-6 " href="{{ route('kegiatan.index') }}"><i class="fa fa-arrow-left fs-6"></i> Kembali</a>
        </div>
        <div class="card border-0 mb-4 w-40" style="box-shadow: 3px 3px 5px 1px rgb(181, 148, 241);">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-center">
                    <div class="d-flex align-items-center">
                        <h4 class="fw-bold text-dark mb-0">
                            Update Kegiatan
                        </h4>
                    </div>
                </div>
            </div>
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
<div class="card shadow-sm border-0 mb-5" style="background-color: #f8f9fa;">
    <div class="card-body p-4">
<form method="POST" action="{{ route('kegiatan.update', $kegiatan->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong for="nama_kegiatan">Nama Kegiatan</strong>
                <input type="text" name="nama_kegiatan" placeholder="Nama Kegiatan" class="form-control" value="{{ $kegiatan->nama_kegiatan }}">
            </div>
        </div>
        <div class="form-group">
            <strong for="deskripsi_kegiatan">Deskripsi Kegiatan</strong>
            <textarea name="deskripsi_kegiatan" id="deskripsi_kegiatan" class="form-control" required>{{ $kegiatan->deskripsi_kegiatan }}</textarea>
        </div>

        <div class="form-group">
            <strong for="kategori_id">Pilih Kategori</strong>
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
            <strong for="tanggal_mulai">Tanggal Mulai</strong>
            <input type="date" name="tanggal_mulai" placeholder="Tanggal Mulai" class="form-control" value="{{ $kegiatan->tanggal_mulai }}">
        </div>
        <div class="form-group">
            <strong for="tanggal_selesai">Tanggal Selesai</strong>
            <input type="date" name="tanggal_selesai" placeholder="Tanggal Selesai" class="form-control" value="{{ $kegiatan->tanggal_selesai }}">
        </div>
        <div class="form-group">
            <strong for="waktu_mulai">Waktu Mulai</strong>
            <input type="time" name="waktu_mulai" placeholder="waktu Mulai" class="form-control" value="{{ $kegiatan->waktu_mulai }}">
        </div>
        <div class="form-group">
            <strong for="waktu_selesai">Waktu Selesai</strong>
            <input type="time" name="waktu_selesai" placeholder="waktu Selesai" class="form-control" value="{{ $kegiatan->waktu_selesai }}">
        </div>
        <div class="form-group">
            <strong for="status">Status</strong>
            <select name="status" id="status" class="form-control" required>
                <option value="batal" {{ $kegiatan->status === 'batal' ? 'selected' : '' }}>Batal</option>
                <option value="berjalan" {{ $kegiatan->status === 'berjalan' ? 'selected' : '' }}>Berjalan</option>
                <option value="selesai" {{ $kegiatan->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>
        <div class="form-group">
            <strong for="lokasi">Lokasi Kegiatan</strong>
            <input type="text" name="lokasi" placeholder="waktu Selesai" class="form-control" value="{{ $kegiatan->lokasi }}">
        </div>

        <div class="form-group">
            <strong for="gambar">Gambar Proyek</strong>
            <input type="file" name="gambar" id="gambar" class="form-control">
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary btn-sm mt-2 mb-3"><i class="fa-solid fa-floppy-disk me-1" style="font-size: 12px"></i> Submit</button>
        </div>
    </div>
</form>
</div>
</div>
</div>


@endsection
