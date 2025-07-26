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
            $currentPerPage = request('per_page', 10); 
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
                            <form method="POST" action="{{ route('frontend.laporan_kegiatan.destroy', $item->id) }}">
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
            e.preventDefault(); 
            window.location.href = "{{ route('frontend.laporan_kegiatan.index') }}"; 
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
                }, 500); 
            }, 3000);
        }
    });
</script>

@endsection
