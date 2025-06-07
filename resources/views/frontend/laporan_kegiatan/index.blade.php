{{-- @extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Daftar Laporan kegiatan</h2>
        </div>
        <div class="pull-right">
            @can('laporan-create')
            <a class="btn btn-success btn-sm mb-2" href="{{ route('frontend.laporan_kegiatan.create') }}"><i class="fa fa-plus"></i> Create New Laporan</a>
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
        <th>Nama kegiatan</th>
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
        <td>{{ $item->kegiatan->nama_kegiatan }}</td>
        <td>{{ number_format($item->kegiatan->anggaran, 0, ',', '.') }}</td>
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
            
                <a class="btn btn-info btn-sm" href="{{ route('frontend.laporan_kegiatan.show', $item->id) }}">
                    <i class="fa-solid fa-list"></i> Lihat
                </a>
                @can('laporan-approve')
                <a class="btn btn-primary btn-sm" href="{{ route('frontend.laporan_kegiatan.approve', $item->id) }}">
                    <i class="fa-solid fa-pen-to-square"></i> Approve
                </a>
                @endcan
                @can('laporan-edit')         
                <a class="btn btn-primary btn-sm" href="{{ route('frontend.laporan_kegiatan.edit', $item->id) }}">
                    <i class="fa-solid fa-pen-to-square"></i> Edit
                </a>
                @endcan
                <form action="{{ route('frontend.laporan_kegiatan.destroy', $item->id) }}" method="POST">
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

<p class="text-center text-primary"><small>Data Laporan kegiatan</small></p>
@endsection --}}


@extends('frontend.layouts.master')

@section('content')

<div class="container-fluid main-content">
    <div class="header-section">
        <h4 class="mb-0 fw-bolder text-secondary">List Laporan Kegiatan</h4>
        <div class="d-flex align-items-center flex-wrap mt-2 mt-md-0">
            <form id="searchForm" method="GET" action="{{ route('frontend.laporan_kegiatan.index') }}" class="d-flex align-items-center flex-wrap">
                <div class="search-input-wrapper me-2">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" class="form-control" name="search" value="{{ request('search') }}" placeholder="Search">
                </div>
            </form>
            @php
            $currentPerPage = request('per_page', 10); // default 10 kalau belum dipilih
            @endphp

            <div class="filter-section">
                <span class="text-muted me-2">Show</span>
                <div class="dropdown me-3">
                    <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                       {{ $currentPerPage }} Entries
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    @foreach ([5, 10, 20, 50] as $count)
                    <li>
                    <a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['per_page' => $count]) }}">
                            {{ $count }} Entries
                    </a>
                    </li>
                @endforeach
            </ul>
            </div>
            <a href="{{ route('frontend.laporan_kegiatan.create') }}">
                <button class="btn btn-outline-secondary fw-bolder">
                <i class="fas fa-plus-square me-1"></i> Tambah
                </button>
            </a>
            </div>
        </div>
    </div>
    @foreach (['success', 'primary', 'danger'] as $type)
    @if(session($type))
        <div class="alert alert-{{ $type }}" role="alert" id="alert-message">{{ session($type) }}</div>
    @endif
@endforeach
@if(session('error'))
    <div class="alert alert-danger" role="alert" id="alert-message">
        {{ session('error') }}
    </div>
@endif
    @php $i = ($laporan->currentPage() - 1) * $laporan->perPage(); @endphp
    @foreach ($laporan as $item)
    <div class="card card-custom card-animate hoverable rounded-3 position-relative" data-kegiatan="{{ strtolower($item->kegiatan->nama_kegiatan) }}">
        {{-- Konten Kartu --}}
        <div class="card-body card-body-custom ms-3 me-3">
            <div class="card-content mt-2">
                <h5 class="card-title d-flex align-items-center">
                    <span style="color: #2e9744; font-weight: bold">Laporan&nbsp;</span>{{ $item->kegiatan->nama_kegiatan }}
                </h5>
                <p class="card-subtitle d-flex align-items-center" style="font-weight: 600">
                    <i class="fas fa-user me-1"></i>{{ ucfirst($item->user->name) }}
                    <span class="badge pt-2 text-white ms-2" style="background-color: rgb(73, 149, 107)">{{ $item->kode_kegiatan }}</span>
                </p>
            </div>
            <div class="d-flex flex-wrap align-items-center mt-2">
                <a href="{{ route('frontend.laporan_kegiatan.show', $item->id) }}">
                    <button class="view-details-btn me-2">View Details</button>
                </a>
                <div class="dropdown">
                    <button class="view-details-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end custom-dropdown">
                        <li>
                            <a class="dropdown-item text-primary fw-bold" href="{{ route('frontend.laporan_kegiatan.edit',$item->id) }}">
                                <i class="fas fa-edit me-2"></i>Edit
                            </a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('frontend.laporan_kegiatan.destroy', $item->id) }}" onsubmit="return confirm('Yakin ingin menghapus laporan ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="dropdown-item text-danger fw-bold" type="submit">
                                    <i class="fas fa-trash me-2"></i>Hapus
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Info Kegiatan --}}
        <div class="details-row">
            <div class="detail-item">
                <i class="fas fa-tasks icon" style="background-color: #d4edda;"></i>
                <div class="detail-text">
                    @if ($item->is_approved == 1)
                        <span class="approve-text badge text-bg-success">Disetujui</span>
                    @elseif ($item->is_approved === 0)
                        <span class="approve-text badge text-bg-danger">Ditolak</span>
                    @else
                        <span class="approve-text badge text-bg-warning">Pending</span>
                    @endif
                    <small class="text-muted" style="font-weight: 600">Status Laporan</small>
                </div>
            </div>
            <div class="detail-item">
                <i class="fas fa-calendar-week icon" style="background-color: #cfd1f4"></i>
                <div class="detail-text">
                    <span style="color: rgb(56, 74, 188); font-weight: 800">{{ $item->kegiatan->lama_hari }}</span>
                    <small class="text-muted" style="font-weight: 600">Lama Hari</small>
                </div>
            </div>
            <div class="detail-item">
                <i class="fas fa-calendar-days icon" style="background-color: #d8edc4"></i>
                <div class="detail-text">
                    <span style="color: rgb(49, 125, 49); font-weight: 800">{{ $item->kegiatan->tanggal_mulai }}</span>
                    <small class="text-muted" style="font-weight: 600">Tanggal Kegiatan</small>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <div class="border-top py-3 px-3 d-flex align-items-center justify-content-center">
        @if ($laporan->hasPages())
        {!! $laporan->appends(request()->only(['search', 'per_page']))->links('pagination::bootstrap-5') !!}
        @else
        <p class="text-muted">Tidak ada halaman tambahan.</p>
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('searchForm').addEventListener('submit', function(e) {
        const searchInput = document.getElementById('searchInput').value.trim();
        if (searchInput === '') {
            e.preventDefault(); // batalkan submit default
            window.location.href = "{{ route('frontend.laporan_kegiatan.index') }}"; // redirect ke index tanpa query
        }
    });

    // Auto-hide alert messages
    document.addEventListener('DOMContentLoaded', function() {
        const alertMessage = document.getElementById('alert-message');
        if (alertMessage) {
            setTimeout(() => {
                alertMessage.style.transition = 'opacity 0.5s ease-out';
                alertMessage.style.opacity = '0';
                setTimeout(() => {
                    alertMessage.remove();
                }, 500); // Remove after fade out
            }, 3000); // 3 seconds before fading out
        }
    });
</script>

{{-- <div class="px-4 py-4 container-fluid mb-5">
    <div class="mt-4 row">
        <div class="px-3 ">
            <h6 class="text-muted mb-3">
                Berikut adalah daftar <strong style="font-weight :bold; color:#312f2f; font-size: 18px">Laporan Kegiatan</strong> yang telah dibuat untuk mendukung dalam pengelolaan program desa secara efektif.
            </h6>
        </div>
        <div class="col-12">
        <div class="card border shadow-xs mb-4">
            <div class="card-header border-bottom pb-0">
                <div class="d-sm-flex align-items-center mb-3">
                    <div>
                        <h4 class="font-weight-bold mb-0">Laporan Kegiatan</h4>
                        <p class="text-sm mb-sm-0">List Laporan Kegiatan Desa Bojong Gede</p>
                    </div>
                    <div class="ms-auto d-flex">
                        <form method="GET" action="{{ route('frontend.laporan_kegiatan.index') }}">
                        <div class="input-group input-group-sm ms-auto me-2">
                            <span class="input-group-text text-body">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
                                    </path>
                                </svg>
                            </span>
                            <input type="text" class="form-control form-control-sm"
                                placeholder="Search">
                        </div>
                    </form>
                        
                        <a href="{{ route('frontend.laporan_kegiatan.create') }}" class="btn btn-sm btn-dark btn-icon d-flex align-items-center justify-content-center mb-0 ms-2 me-2">
                            <i class="fas fa-plus me-2" style="font-size: 13px;"></i>
                            Laporan
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 py-0">
                <div class="table-responsive p-0">
                    <table class="table align-items-center justify-content-center mb-0 w-100">
                        <thead class="bg-gray-100 text-center ">
                            <tr>
                                <th class="text-secondary  font-weight-semibold opacity-7">
                                    No</th>
                                <th class="text-secondary  font-weight-semibold opacity-7">
                                    Kode Laporan Kegiatan</th>
                                <th class="text-secondary  font-weight-semibold opacity-7 ps-3">
                                    Nama Laporan Kegiatan</th>                            
                                <th class="text-secondary  font-weight-semibold opacity-7 ps-3">
                                    Dibuat Oleh</th>
                                <th class="text-secondary  font-weight-semibold opacity-7 ps-3">
                                    Status</th>
                                <th
                                    class="text-center text-secondary  font-weight-semibold opacity-7">Action
                                </th>
                            </tr>
                        </thead>
                        @php $i = ($laporan->currentPage() - 1) * $laporan->perPage(); @endphp
                        @foreach ($laporan as $item)
                        <tbody class="text-center">
                            <tr>
                                <td>
                                    <p class="fs-6 font-weight-bold mb-0 text-center">{{ ++$i }}</p>
                                </td>     
                                <td>
                                    <p class="fs-6 font-weight-bold mb-0 text-center">{{ $item->kode_kegiatan }}</p>
                                </td>                                                   
                                <td style="white-space: normal; word-break: break-word;">
                                    <p class="fs-6 font-weight-normal mb-0">{{ $item->kegiatan->nama_kegiatan }}</p>
                                </td>  
                                <td>
                                    <span class="fs-6 font-weight-normal">{{ $item->user->name }}</span>
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex">
                                        <div class="ms-2">
                                            @if ($item->is_approved == 1)
                                                <span class="badge text-bg-success"">Disetujui</span>
                                            @elseif ($item->is_approved === 0)
                                                <span class="badge text-bg-danger">Ditolak</span>
                                            @else
                                                <span class="badge text-bg-warning">Pending</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <a href="{{ route('frontend.laporan_kegiatan.show',$item->id) }}"><i class="show fas fa-list-ul" aria-hidden="true"></i></a>
                                        <a href="{{ route('frontend.laporan_kegiatan.edit',$item->id) }}"><i class="edit fas fa-edit ms-1" aria-hidden="true"></i></a>
                                        <form method="POST" action="{{ route('frontend.laporan_kegiatan.destroy', $item->id) }}" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                           
                                            <button type="submit"><i class="delete fas fa-trash ms-1 me-2"></i></button>
                                        </form>
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
                
                <div class="border-top py-3 px-3 d-flex align-items-center">
                    {!! $laporan->appends(['search' => request('search')])->links('pagination::bootstrap-5') !!}
                </div>
            </div>
        </div>
    </div>
</div>
</div> --}}

@endsection
