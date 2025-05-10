@extends('layouts.app')

@section('content')

@session('success')
    <div class="alert alert-success" role="alert"> 
        {{ $value }}
    </div>
@endsession

<div class="px-4 py-4 container-fluid mb-5">
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
                                    <th class="text-secondary font-weight-semibold opacity-7 ps-2">Deskripsi Kegiatan</th>
                                    <th class="text-secondary font-weight-semibold opacity-7 ps-2">Status</th>
                                    <th class="text-secondary font-weight-semibold opacity-7 ps-2">Lama Kegiatan</th>
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
                                            <p class="fs-6 font-weight-normal mb-0">{{ $kegiatan->nama_kegiatan }}</p>
                                        </td>
                                        <td>
                                            <span class="fs-6 font-weight-normal">{{ $kegiatan->deskripsi_kegiatan }}</span>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-flex">
                                                <div class="ms-2">
                                                    <p class="mb-0 badge border border-success text-success bg-success fs-6">{{ $kegiatan->status }}</p>     
                                                </div>
                                            </div>
                                        </td>
                                        <td>
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

                    <div class="border-top py-3 px-3 d-flex align-items-center">
                        {!! $kegiatans->appends(['search' => request('search')])->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
