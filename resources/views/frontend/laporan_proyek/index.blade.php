@extends('frontend.layouts.master')

@section('content')


<div class="container-fluid main-content">
    <div class="header-section mb-4">
        <h4 class="mb-0 fw-bolder text-secondary">List Laporan Proyek Desa</h4>
    
        <div class="d-flex align-items-center flex-wrap mt-2">
            <form id="searchForm" method="GET" action="{{ route('frontend.laporan_proyek.index') }}" class="d-flex align-items-center flex-wrap">
                <div class="search-input-wrapper me-2">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" class="form-control" name="search" value="{{ request('search') }}" placeholder="Cari nama kegiatan">
                </div>
            </form>
    
            @php
            $currentPerPage = request('per_page', 10);
            @endphp
    
            <div class="filter-section">
                <span class="text-muted me-2">Show</span>
                <div class="dropdown">
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
    
                <a href="{{ route('frontend.laporan_proyek.create') }}">
                    <button class="btn btn-outline-secondary fw-bolder ms-2">
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
    <div class="card card-custom card-animate hoverable rounded-3" data-kegiatan="{{ strtolower($item->proyek->nama_proyek) }}">
        <div class="card-body card-body-custom ms-3 me-3">
            <div class="card-content mt-2">
                <h5 class="card-title d-flex align-items-center">
                    <span style="color: #2e9744; font-weight: bold">Laporan&nbsp;</span>{{ $item->proyek->nama_proyek }}  
                </h5>
                <p class="card-subtitle d-flex align-items-center" style="font-weight: 600">
                    <i class="fas fa-user me-1"></i>{{ ucfirst($item->user->name) }}
                    <span class="badge pt-2 text-white ms-2" style="background-color: rgb(73, 149, 107)">{{ $item->kode_laporan }}</span>
                </p>
            </div>
            <div class="d-flex flex-wrap gap-2 mt-2">
                <a href="{{ route('frontend.laporan_proyek.show', $item->id) }}">
                    <button class="view-details-btn">View Details</button>
                </a>
                <div class="dropdown">
                    <button class="view-details-btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end custom-dropdown">
                        <li>
                            <a class="dropdown-item text-primary fw-bold" href="{{ route('frontend.laporan_proyek.edit',$item->id) }}">
                                <i class="fas fa-edit me-2"></i>Edit
                            </a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('frontend.laporan_proyek.destroy', $item->id) }}">
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
                    @endif</span>
                    <small class="text-muted"  style="font-weight: 600">Status Laporan</small>
                </div>
            </div>
            <div class="detail-item">
                <i class="fas fa-calendar-week icon" style="background-color: #cfd1f4"></i>
                <div class="detail-text" >
                    <span style="color: rgb(56, 74, 188); font-weight: 800">{{ $item->progresTerbaru?->persentase ?? 0 }}%</span>
                    <small class="text-muted"  style="font-weight: 600">Progres</small>
                </div>
            </div>
            <div class="detail-item">
                <i class="fas fa-calendar-days icon" style="background-color: #d8edc4"></i>
                <div class="detail-text">
                    <span style="color: rgb(49, 125, 49); font-weight: 800">Rp. {{ number_format($item->proyek->anggaran, 0, ',', '.') }}</span>
                    <small class="text-muted" style="font-weight: 600">Aggaran</small>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <div class="border-top py-3 px-3 d-flex align-items-center">
        @if ($laporan->hasPages())
        {!! $laporan->appends(request()->only(['search', 'per_page']))->links('pagination::bootstrap-5') !!}
        @else
        <p>Tidak ada halaman tambahan.</p>
        @endif
    </div>
</div>
<script>
        document.getElementById('searchForm').addEventListener('submit', function(e) {
        const searchInput = document.getElementById('searchInput').value.trim();
        if (searchInput === '') {
            e.preventDefault(); // batalkan submit default
            window.location.href = "{{ route('frontend.laporan_proyek.index') }}"; // redirect ke index tanpa query
        }
    });
</script>
@endsection
