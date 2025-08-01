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
<div class="px-4 py-4 container-fluid mb-5">
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
                        <form method="GET" action="{{ route('laporan_kegiatan.index') }}">
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
                        <a href="{{ route('laporan_kegiatan.create') }}" class="btn btn-sm btn-dark btn-icon d-flex align-items-center justify-content-center mb-0 ms-2 me-2" style="font-size: 15px;">
                            <i class="fas fa-plus me-2" style="font-size: 15px;"></i>
                            Laporan
                        </a>
                        <button class="btn btn-sm btn-outline-secondary d-flex align-items-center justify-content-center mb-0 pb-0"
                            type="button" id="dropdownFilter" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fs-5" style="margin-bottom: 5px;"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end p-3" aria-labelledby="dropdownFilter" style="min-width: 220px;">
                            <form method="GET" action="{{ route('laporan_kegiatan.index') }}">
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
                                <a href="{{ route('laporan_kegiatan.index') }}" class="btn btn-sm btn-outline-danger w-100">Reset</a>
                            </form>
                        </ul>
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
                                    Kode Laporan Kegiatan<//th>
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
                                    <div class="d-flex justify-content-center">
                                        <div class="stats">
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
                                    <a href="{{ route('laporan_kegiatan.show',$item->id) }}"><i class="show fas fa-list-ul" aria-hidden="true"></i></a>
                                        <a href="{{ route('laporan_kegiatan.edit',$item->id) }}"><i class="edit fas fa-edit ms-1" aria-hidden="true"></i></a>
                                        @can('laporan-approve')
                                        <a href="{{ route('laporan_kegiatan.approve', $item->id) }}">
                                            <i class="approve fas fa-check-circle"></i>
                                        </a>
                                        @endcan
                                        <form method="POST" action="{{ route('laporan_kegiatan.destroy', $item->id) }}" style="display:inline">
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
                <div class="border-top py-3 px-3 d-flex align-items-center export-wrapper">
                    {!! $laporan->appends(['search' => request('search')])->links('pagination::bootstrap-5') !!}
                </div>
                <form method="get" onsubmit="event.preventDefault(); exportPDF();">
                    <div class="d-flex gap-2  mb-2 ms-2 ms-lg-3 me-2 export-wrapper">
                        <div class="mb-3">
                            <p class="mb-1">Pilih Tahun</p>
                            <select id="tahun" class="form-control" required style="width: 100px; text-align: center">
                                @foreach ($tahunList as $tahun)
                                    <option value="{{ $tahun }}">{{ $tahun }}</option>
                                @endforeach
                            </select>
                        </div>
                
                        <button type="submit" class="btn btn-danger" style="height: 45px; display: flex; align-items: center; justify-content: center; align-self: flex-end">
                            <i class="fas fa-file-pdf me-lg-2 me-2"></i> Export PDF
                        </button>
                
                        <button type="button" class="btn btn-success" onclick="exportExcel()" style="height: 45px; display: flex; align-items: center; justify-content: center; align-self: flex-end">
                            <i class="fas fa-file-excel me-lg-2 me-2"></i> Export Excel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    function exportPDF() {
        const tahun = document.getElementById('tahun').value;
        window.location.href = `/laporan-kegiatan/pdf/${tahun}`;
    }
    function exportExcel() {
        const tahun = document.getElementById('tahun').value;
        window.location.href = `/laporan_kegiatan/export-excel/${tahun}`;
    }
</script>
@endsection
