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
        <h4 class="mb-0 fw-bolder text-secondary">List Kegiatan Desa</h4>
        <div class="d-flex align-items-center flex-wrap">
            <form id="searchForm" method="GET" action="{{ route('frontend.kegiatan.index') }}" class="d-flex align-items-center flex-wrap">
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
 
        </div>
        </div>
    </div>
    @php $i = ($kegiatans->currentPage() - 1) * $kegiatans->perPage(); @endphp
    @foreach ($kegiatans as $kegiatan)
    <div class="card card-custom card-animate hoverable rounded-3" data-kegiatan="{{ strtolower($kegiatan->nama_kegiatan) }}">
        <div class="card-body card-body-custom ms-3 me-3">
            <div class="card-img-container">
                <img src="{{ asset('storage/' . $kegiatan->gambar) }}" 
                class="img-fluid rounded w-100 img-hover-animate border-animate card-animate" 
                alt="Gambar">          
            </div>
            <div class="card-content">
                <h5 class="card-title">{{ $kegiatan->nama_kegiatan }}</h5>
                <p class="card-subtitle mb-0" style="font-weight: 600"><i class="fas fa-user me-1""></i>{{ ucfirst($kegiatan->user->name) }}</p>
            </div>
            <a href="{{ route('frontend.kegiatan.show',$kegiatan->id) }}">
            <button class="view-details-btn">View Details</button>
            </a>
        </div>
        <div class="details-row">
            <div class="detail-item">
                <i class="fas fa-th-list icon" style="background-color: #d4edda;"></i>
                <div class="detail-text">
                    <span style="color: rgb(49, 125, 49); font-weight: 800">{{ ucfirst($kegiatan->kategoriKegiatan->nama_kategori) }}</span>
                    <small class="text-muted"  style="font-weight: 600; margin-left: 0;">Kategori Kegiatan</small>
                </div>
            </div>
            <div class="detail-item">
                <i class="fas fa-calendar-week icon" style="background-color: #cfd1f4"></i>
                <div class="detail-text" >
                    <span style="color: rgb(56, 74, 188); font-weight: 800">{{ $kegiatan->lama_hari }}</span>
                    <small class="text-muted"  style="font-weight: 600">Lama Hari</small>
                </div>
            </div>
            <div class="detail-item">
                <i class="fas fa-calendar-days icon" style="background-color: rgb(224, 218, 170)"></i>
                <div class="detail-text">
                    <span style="color: rgb(143, 149, 68); font-weight: 800">{{ $kegiatan->tanggal_mulai }}</span>
                    <small class="text-muted" style="font-weight: 600">Tanggal Kegiatan</small>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <div class="border-top py-3 px-3 d-flex align-items-center">
        @if ($kegiatans->hasPages())
        {!! $kegiatans->appends(request()->only(['search', 'per_page']))->links('pagination::bootstrap-5') !!}
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
            window.location.href = "{{ route('frontend.kegiatan.index') }}"; // redirect ke index tanpa query
        }
    });
</script>
@endsection
