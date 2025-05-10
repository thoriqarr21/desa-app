@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Daftar Laporan Proyek</h2>
        </div>
        <div class="pull-right">
            @can('laporan-create')
            <a class="btn btn-success btn-sm mb-2" href="{{ route('laporan_proyek.create') }}"><i class="fa fa-plus"></i> Create New Laporan</a>
            @endcan
        </div>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Nama Proyek</th>
        <th>Anggaran</th>
        <th>Persentase</th>
        <th>Dibuat Oleh</th>
        <th>Status</th>
        <th width="280px">Aksi</th>
    </tr>
    @php $i = 1; @endphp
    @foreach ($laporan as $item)
    <tr>
        <td>{{ $i++ }}</td>
        <td>{{ $item->proyek->nama_proyek }}</td>
        <td>{{ number_format($item->proyek->anggaran, 0, ',', '.') }}</td>
        <td>{{ $item->progresTerbaru?->persentase ?? 0 }}%</td>
        <td>{{ $item->user->name }}</td>
        <td>
            @if ($item->is_approved == 1)
                <span class="badge bg-success">Disetujui</span>
            @elseif ($item->is_approved === 0)
                <span class="badge bg-danger">Ditolak</span>
            @else
                <span class="badge bg-warning text-dark">Pending</span>
            @endif
        </td>
        
        <td>
            
                <a class="btn btn-info btn-sm" href="{{ route('laporan_proyek.show', $item->id) }}">
                    <i class="fa-solid fa-list"></i> Lihat
                </a>
                @can('laporan-approve')
                <a class="btn btn-primary btn-sm" href="{{ route('laporan_proyek.approve', $item->id) }}">
                    <i class="fa-solid fa-pen-to-square"></i> Approve
                </a>
                @endcan
                @can('laporan-edit')         
                <a class="btn btn-primary btn-sm" href="{{ route('laporan_proyek.edit', $item->id) }}">
                    <i class="fa-solid fa-pen-to-square"></i> Edit
                </a>
                @endcan
                <form action="{{ route('laporan_proyek.destroy', $item->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus laporan ini?')">
                    <i class="fa-solid fa-trash"></i> Hapus
                </button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

{!! $laporan->links('pagination::bootstrap-5') !!}

<p class="text-center text-primary"><small>Data Laporan Proyek</small></p>
@endsection
