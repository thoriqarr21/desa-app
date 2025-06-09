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
                    <input type="text" id="searchInput" class="form-control" name="search" value="{{ request('search') }}" placeholder="Cari nama kegiatan">
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
                    <small class="text-muted"  style="font-weight: 600">Kategori</small>
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
                <i class="fas fa-calendar-days icon" style="background-color: #d8edc4"></i>
                <div class="detail-text">
                    <span style="color: rgb(49, 125, 49); font-weight: 800">{{ $kegiatan->tanggal_mulai }}</span>
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
{{-- <div class="px-4 py-4 container-fluid mb-5">
    <div class="mt-4 row">
        <div class="px-3">
            <h6 class="text-muted mb-3">
                Berikut adalah daftar <strong style="font-weight :bold; color:#312f2f; font-size: 18px">Kegiatan</strong> yang telah dibuat untuk mendukung dalam pengelolaan program desa secara efektif.
            </h6>
        </div>
        <div class="col-12">
            <div class="card border shadow-xs mb-4">
                <div class="card-header border-bottom pb-0">
                    <div class="d-sm-flex align-items-center mb-3">
                        <div>
                            <h4 class="font-weight-bold mb-0">Kegiatan</h4>
                            <p class="text-sm mb-sm-0">List Kegiatan Desa Bojong Gede</p>
                        </div>
                        <div class="ms-auto d-flex">
                            <form method="GET" action="{{ route('kegiatan.index') }}">
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
                                    <input type="text" id="searchInput" class="form-control form-control-sm"
                                        placeholder="Search" name="search" value="{{ request('search') }}">
                                </div>
                            </form>

                            <a href="{{ route('kegiatan.create') }}" class="btn btn-sm btn-dark btn-icon d-flex align-items-center justify-content-center mb-0 ms-2 me-2">
                                <i class="fas fa-plus me-2" style="font-size: 13px;"></i>
                                Kegiatan
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body px-0 py-0">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center justify-content-center mb-0" id="kegiatanTable">
                            <thead class="bg-gray-100 text-center">
                                <tr>
                                    <th class="text-secondary font-weight-semibold opacity-7">No</th>
                                    <th class="text-secondary font-weight-semibold opacity-7">Gambar Kegiatan</th>
                                    <th class="text-secondary font-weight-semibold opacity-7 ps-3">Nama Kegiatan</th>
                                    <th class="text-secondary font-weight-semibold opacity-7">Deskripsi Kegiatan</th>
                                    <th class="text-secondary font-weight-semibold opacity-7">Status</th>
                                    <th class="text-secondary font-weight-semibold opacity-7">Lama Kegiatan</th>
                                    <th class="text-center text-secondary font-weight-semibold opacity-7">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @php $i = ($kegiatans->currentPage() - 1) * $kegiatans->perPage(); @endphp
                                @foreach ($kegiatans as $kegiatan)
                                    <tr data-kegiatan="{{ strtolower($kegiatan->nama_kegiatan) }}">
                                        <td>
                                            <p class="fs-6 font-weight-bold mb-0 text-center">{{ ++$i }}</p>
                                        </td>
                                        <td style="max-width: 180px; width: 160px;">
                                            <img src="{{ asset('storage/' . $kegiatan->gambar) }}" class="img-fluid rounded w-100" alt="Gambar">
                                        </td>
                                        <td>
                                            <p class="fs-6 font-weight-normal mb-0 justify-items-center">{{ $kegiatan->nama_kegiatan }}</p>
                                        </td>
                                        <td>
                                            <span class="fs-6 font-weight-normal">{{ $kegiatan->deskripsi_kegiatan }}</span>
                                        </td>
                                        <td class="align-middle" style="justify-items: center">
                                            <div class="d-flex">
                                                <div>
                                                    <p class="mb-0 badge border border-success bg-success fs-6">{{ $kegiatan->status }}</p>     
                                                </div>
                                            </div>
                                        </td>
                                        <td >
                                            <span class="fs-6 font-weight-normal">{{ $kegiatan->lama_hari }}</span>
                                        </td>
                                        <td class="align-middle">
                                            <a href="{{ route('kegiatan.show',$kegiatan->id) }}"><i class="show fas fa-list-ul" aria-hidden="true"></i></a>
                                            <a href="{{ route('kegiatan.edit',$kegiatan->id) }}"><i class="edit fas fa-edit ms-1" aria-hidden="true"></i></a>
                                            <form method="POST" action="{{ route('kegiatan.destroy', $kegiatan->id) }}" style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"><i class="delete fas fa-trash ms-1 me-2"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
</div> --}}
{{-- <style>
        .container-fluid.main-content {
            padding: 20px;
        }
        .header-section {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap; /* Allow wrapping on smaller screens */
        }
        .header-section .form-control {
            border-radius: 8px;
            padding-left: 35px; /* Space for icon */
        }
        .search-input-wrapper {
            position: relative;
            flex-grow: 1;
            margin-right: 15px;
            min-width: 200px; /* Ensure search input has minimum width */
        }
        .search-input-wrapper .fa-search {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #ccc;
        }
        .filter-section {
            display: flex;
            align-items: center;
        }
        .filter-section .dropdown-toggle {
            border-radius: 8px;
        }
        .card-custom {
            border-radius: 10px;
            margin-bottom: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            overflow: hidden; /* Ensure content stays within rounded corners */
        }
        .card-body-custom {
            display: flex;
            align-items: center;
            padding: 20px;
        }
        .card-img-container {
            width: 80px; /* Fixed width for the image */
            height: 80px; /* Fixed height for the image */
            border-radius: 8px;
            overflow: hidden;
            margin-right: 20px;
            flex-shrink: 0; /* Prevent image from shrinking */
        }
        .card-img-container img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Cover the container while maintaining aspect ratio */
        }
        .card-content {
            flex-grow: 1;
        }
        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 5px;
        }
        .card-subtitle {
            font-size: 0.9rem;
            color: #6c757d;
        }
        .view-details-btn {
            background-color: #237d33; /* Darker background */
            color: #fff;
            font-weight: 600;
            border: none;
            border-radius: 8px;
            padding: 8px 15px;
            font-size: 0.9rem;
            flex-shrink: 0; /* Prevent button from shrinking */
        }
        .view-details-btn:hover {
            background-color: #272198;
            color: #fff;
        }
        .details-row {
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 15px 20px;
            background-color: #f7f7f7; /* Lighter background for details row */
            border-top: 2px solid #f1f2f6;
        }
        .detail-item {
            display: flex;
            flex-direction: row;
            align-items: center;
            font-size: 0.9rem;
        }
        .detail-text {
            display: flex;
            flex-direction: column;
            align-items: center;
            font-size: 0.9rem;
            color: #343a40;
        }
        .detail-item .icon {
            padding: 7px;
            border-radius: 8px;
            margin-right: 7px;
            font-size: 1.2rem;
            margin-bottom: 5px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .header-section {
                flex-direction: column;
                align-items: flex-start;
            }
            .search-input-wrapper {
                margin-right: 0;
                margin-bottom: 15px;
                width: 100%;
            }
            .filter-section {
                width: 100%;
                justify-content: space-between;
            }
            .card-body-custom {
                flex-direction: column;
                align-items: flex-start;
            }
            .card-img-container {
                margin-right: 0;
                margin-bottom: 15px;
            }
            .details-row {
                flex-direction: column;
                align-items: flex-start;
            }
            .detail-item {
                margin-bottom: 10px;
                align-items: flex-start;
            }
            .detail-item:last-child {
                margin-bottom: 0;
            }
        }
</style> --}}

@endsection
