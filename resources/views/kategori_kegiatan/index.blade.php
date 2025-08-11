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
<div class="px-lg-4 py-4 container-fluid mb-5">
    <div class="mt-4 row">
        <div class="px-3 ">
            <h6 class="text-muted mb-3">
                Berikut adalah daftar <strong style="font-weight :bold; color:#312f2f; font-size: 18px">Kategori Kegiatan</strong> yang telah dibuat untuk mendukung dalam pengelolaan program desa secara efektif.
            </h6>
        </div>
        <div class="col-12">
        <div class="card border shadow-xs mb-4">
            <div class="card-header border-bottom pb-0">
                <div class="d-sm-flex align-items-center mb-3">
                    <div>
                        <h4 class="font-weight-bold mb-0">Kategori Kegiatan</h4>
                        <p class="text-sm mb-sm-0">List Kegiatan Kegiatan Desa Bojong Gede</p>
                    </div>
                    <div class="ms-auto d-flex">
                        <form method="GET" action="{{ route('kategori_kegiatan.index') }}">
                        <div class="input-group input-group-sm ms-auto me-2" style="max-width: 180px;">
                            <span class="input-group-text text-body px-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14px" height="14px"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
                                    </path>
                                </svg>
                            </span>
                            <input type="text" class="form-control" name="search" placeholder="Search"  value="{{ request('search') }}" style="font-size: 0.85rem; padding: 4px 8px;">
                        </div>
                        </form>
                        
                        
                        <a href="{{ route('kategori_kegiatan.create') }}" class="btn btn-sm btn-dark btn-icon d-flex align-items-center justify-content-center mb-0 me-2 ml-responsive" style="font-size: 15px">
                            <i class="fas fa-plus me-2" style="font-size: 15px;"></i>
                            Kategori Kegiatan
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 py-0">
                <div class="table-responsive p-0">
                    <table class="table align-items-center justify-content-center mb-0">
                        <thead class="bg-gray-100 text-center ">
                            <tr>
                                <th class="text-secondary  font-weight-semibold opacity-7">
                                    No</th>
                                <th class="text-secondary  font-weight-semibold opacity-7 ps-3">
                                    Nama Kategori Kegiatan
                                </th>
                                <th
                                    class="text-center text-secondary  font-weight-semibold opacity-7">Action
                                </th>
                            </tr>
                        </thead>
                        @php $i = ($kategoriKegiatans->currentPage() - 1) * $kategoriKegiatans->perPage(); @endphp
                        @foreach ($kategoriKegiatans as $kategoriKegiatan)
                        <tbody class="text-center">
                            <tr>
                                <td>
                                    <p class="fs-6 font-weight-bold mb-0 text-center">{{ ++$i }}</p>
                                </td>
                                <td>
                                    <p class="fs-6 font-weight-normal mb-0">{{ $kategoriKegiatan->nama_kategori }}</p>
                                </td>
                                <td class="align-middle">
                                    <a href="{{ route('kategori_kegiatan.show',$kategoriKegiatan->id) }}"><i class="show fas fa-list-ul" aria-hidden="true"></i></a>
                                        <a href="{{ route('kategori_kegiatan.edit',$kategoriKegiatan->id) }}"><i class="edit fas fa-edit ms-1" aria-hidden="true"></i></a>
                                        <form method="POST" action="{{ route('kategori_kegiatan.destroy', $kategoriKegiatan->id) }}" style="display:inline">
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
                    {!! $kategoriKegiatans->appends(['search' => request('search')])->links('pagination::bootstrap-5') !!}
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
