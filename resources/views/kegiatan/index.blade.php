@extends('layouts.app')

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
<div class="px-md-4 py-4 container-fluid mb-5">
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

                            <a href="{{ route('kegiatan.create') }}" class="btn btn-sm btn-dark btn-icon d-flex align-items-center justify-content-center mb-0 ms-2 me-2" style="font-size: 15px;">
                                <i class="fas fa-plus me-2" style="font-size: 15px;"></i>
                                Kegiatan
                            </a>
                            <button class="btn btn-sm btn-outline-secondary d-flex align-items-center justify-content-center mb-0 pb-0"
                            type="button" id="dropdownFilter" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fs-5" style="margin-bottom: 5px;"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end p-3" aria-labelledby="dropdownFilter" style="min-width: 220px;">
                            <form method="GET" action="{{ route('kegiatan.index') }}">
                                <div class="mb-2">
                                    <label for="bulan" class="form-label mb-1">Filter</label>
                                    <select name="bulan" id="bulan" class="form-select form-select-sm" onchange="this.form.submit()">
                                        <option value="">Pilih Bulan</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                                                {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                            </option>
                                        @endfor
                                    </select>
                                    
                                    <select name="kategori" class="form-select form-select-sm mt-2" onchange="this.form.submit()">
                                        <option value="">Semua Kategori</option>
                                        @foreach ($kategoriList as $id => $kat)
                                        <option value="{{ $id }}" {{ request('kategori') == $id ? 'selected' : '' }}>
                                            {{ ucfirst($kat) }}
                                        </option>
                                        @endforeach                                    
                                    </select>           
                                </div>
                                <a href="{{ route('kegiatan.index') }}" class="btn btn-sm btn-outline-danger w-100">Reset</a>
                            </form>
                        </ul>
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
                                    {{-- <th class="text-secondary font-weight-semibold opacity-7">Deskripsi Kegiatan</th> --}}
                                    <th class="text-secondary font-weight-semibold opacity-7">Status</th>
                                    <th class="text-secondary font-weight-semibold opacity-7">Lama Kegiatan</th>
                                    <th class="text-secondary font-weight-semibold opacity-7">Action</th>
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
                                        @php
                                            $status = strtolower($kegiatan->status);
                                            $class = match($status) {
                                                'batal'    => 'badge border border-danger text-danger bg-danger',
                                                'selesai'  => 'badge border border-success text-success bg-success',
                                                'berjalan' => 'badge border border-primary text-primary bg-primary',
                                            default    => 'badge border border-warning text-warning bg-warning',
                                            };
                                        @endphp
                                        <td class="align-middle text-center">
                                            <span class="badge fs-6 border {{ $class }}">
                                                {{ ucfirst($kegiatan->status) }}
                                            </span>
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

                    <div class="border-top py-3 px-3 d-flex align-items-center pagination-wrapper">
                        {!! $kegiatans->appends(['search' => request('search')])->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
