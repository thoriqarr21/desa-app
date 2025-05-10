@extends('frontend.layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Kategori Kegiatan</h2>
        </div>
        <div class="pull-right">
            @can('kategori-create')
            <a class="btn btn-success btn-sm mb-2" href="{{ route('frontend.kategori_kegiatan.create') }}"><i class="fa fa-plus"></i> Create New Kategori</a>
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
        <th>Nama</th>
        <th>Deskripsi</th>
        <th width="280px">Action</th>
    </tr>
    @foreach ($kategoriKegiatans as $kategoriKegiatan)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $kategoriKegiatan->nama_kategori }}</td>
        <td>{{ $kategoriKegiatan->deskripsi_kategori }}</td>
        <td>
            <form action="{{ route('kategori_kegiatan.destroy',$kategoriKegiatan->id) }}" method="POST">
                <a class="btn btn-info btn-sm" href="{{ route('kategori_kegiatan.show',$kategoriKegiatan->id) }}"><i class="fa-solid fa-list"></i> Show</a>
                @can('kategori-edit')
                <a class="btn btn-primary btn-sm" href="{{ route('kategori_kegiatan.edit',$kategoriKegiatan->id) }}"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                @endcan

                @csrf
                @method('DELETE')

                @can('kategori-delete')
                <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i> Delete</button>
                @endcan
            </form>
        </td>
    </tr>
    @endforeach
</table>

{!! $kategoriKegiatans->links() !!}


@endsection
