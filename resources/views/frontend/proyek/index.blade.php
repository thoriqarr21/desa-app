@extends('frontend.layouts.master')

@section('content')

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
<div class="container-fluid main-content">
    <div class="header-section">
        <h4 class="mb-0 fw-bolder text-secondary">List Proyek Desa</h4>
        <div class="d-flex align-items-center flex-wrap">
            <form id="searchForm" method="GET" action="{{ route('frontend.proyek.index') }}" class="d-flex align-items-center flex-wrap">
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
        {{-- <button class="btn btn-outline-secondary">
        <i class="fas fa-filter me-1"></i> Filter
        </button> --}}
        </div>
        </div>
    </div>
    @php $i = ($proyeks->currentPage() - 1) * $proyeks->perPage(); @endphp
    @foreach ($proyeks as $proyek)
    <div class="card card-custom card-animate hoverable rounded-3" data-proyek="{{ strtolower($proyek->nama_proyek) }}">
        <div class="card-body card-body-custom ms-3 me-3">
            <div class="card-img-container">
                <img src="{{ asset('storage/' . $proyek->gambar) }}" class="img-fluid rounded w-100" alt="Gambar">
            </div>
            <div class="card-content">
                <h5 class="card-title">{{ $proyek->nama_proyek }}</h5>
                <p class="card-subtitle mb-0" style="font-weight: 600"><i class="fas fa-layer-group me-1"></i>{{ ucfirst($proyek->jenis_proyek) }}</p>
            </div>
            <a href="{{ route('frontend.proyek.show',$proyek->id) }}">
                <button class="view-details-btn">View Details</button>
            </a>
        </div>
        <div class="details-row">
            <div class="detail-item">
                <i class="fas fa-money-check-alt icon" style="background-color: #d4edda;"></i>
                <div class="detail-text">
                    <span style="color: rgb(49, 125, 49); font-weight: 800">Rp. {{ number_format($proyek->anggaran, 0, ',', '.') }}</span>
                    <small class="text-muted"  style="font-weight: 600">Aggaran</small>
                </div>
            </div>
            <div class="detail-item">
                <i class="fas fa-chart-line icon" style="background-color: #cfd1f4"></i>
                <div class="detail-text" >
                    <span style="color: rgb(56, 74, 188); font-weight: 800"> {{ $proyek->laporanProyek && $proyek->laporanProyek->progresTerbaru ? $proyek->laporanProyek->progresTerbaru->persentase : 0 }}%</span>
                    <small class="text-muted"  style="font-weight: 600">Progres</small>
                </div>
            </div>
            <div class="detail-item">
                <i class="fas fa-chart-line icon" style="background-color: rgb(224, 218, 170)"></i>
                <div class="detail-text" >
                    <span style="color: rgb(143, 149, 68); font-weight: 800">{{ $proyek->masa_kontrak }}</span>
                    <small class="text-muted"  style="font-weight: 600">Masa Kontrak</small>
                </div>
            </div>
            <div class="detail-item">
                <i class="fas fa-tasks icon" style="background-color: #d8edc4"></i>
                <div class="detail-text">
                    <span style="color: rgb(49, 125, 49); font-weight: 800">{{ ucfirst($proyek->status) }}</span>
                    <small class="text-muted" style="font-weight: 600">Status</small>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <div class="border-top py-3 px-3 d-flex align-items-center">
        @if ($proyeks->hasPages())
        {!! $proyeks->appends(request()->only(['search', 'per_page']))->links('pagination::bootstrap-5') !!}
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
        window.location.href = "{{ route('frontend.proyek.index') }}"; // redirect ke index tanpa query
    }
});
</script>

@endsection
