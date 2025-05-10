@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Kegiatan Desa</h2>
        </div>
        <div class="pull-right">
            @can('kegiatan-create')
            <a class="btn btn-success btn-sm mb-2" href="{{ route('kegiatan.create') }}"><i class="fa fa-plus"></i> Create New Kegiatan Desa</a>
            @endcan
        </div>
    </div>
</div>

@session('success')
    <div class="alert alert-success" role="alert"> 
        {{ $value }}
    </div>
@endsession

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Gambar Kegiatan</th>
        <th>Nama Kegiatan</th>
        <th>Deskripsi Kegiatan</th>
        <th>status</th>
        <th>Lama Kegiatan</th>
        <th width="280px">Action</th>
    </tr>
    @php $i = ($kegiatans->currentPage() - 1) * $kegiatans->perPage(); @endphp
    @foreach ($kegiatans as $kegiatan)
    <tr>
        <td>{{ ++$i }}</td>
        <td>
            <img src="{{ asset('storage/' . $kegiatan->gambar) }}" class="img-fluid rounded" alt="Gambar">
        </td>
        <td>{{ $kegiatan->nama_kegiatan }}</td>
        <td>{{ $kegiatan->deskripsi_kegiatan }}</td>
        <td>{{ $kegiatan->status }}</td>
        <td>{{ $kegiatan->lama_hari }}</td>
        <td>
            <form action="{{ route('kegiatan.destroy',$kegiatan->id) }}" method="POST">
                <a class="btn btn-info btn-sm" href="{{ route('kegiatan.show',$kegiatan->id) }}"><i class="fa-solid fa-list"></i> Show</a>
                @can('kegiatan-edit')
                <a class="btn btn-primary btn-sm" href="{{ route('kegiatan.edit',$kegiatan->id) }}"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                @endcan

                @csrf
                @method('DELETE')

                @can('kegiatan-delete')
                <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i> Delete</button>
                @endcan
            </form>
        </td>
    </tr>
    @endforeach
</table>

{!! $kegiatans->links() !!}


@endsection
