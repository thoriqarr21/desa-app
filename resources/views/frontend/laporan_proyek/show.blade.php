@extends('frontend.layouts.master')

@section('content')

<div class="container-fluid">
    <div class="header-section">
        <div class="page-breadcrumb d-flex align-items-center gap-2">
            <h5 class="page-text">
                <i class="bi bi-house-door-fill text-success"></i>
                <a href="{{ route('frontend.index') }}" class="text-decoration-none text-muted">Beranda</a>
            </h5>
            <span class="text-muted">/</span>
            <h5 class="page-text">
                <a href="{{ route('frontend.laporan_proyek.index') }}" class="text-decoration-none text-muted">Laporan Proyek</a>
            </h5>
            <span class="text-muted">/</span>
            <h5 class="page-text fw-semibold text-dark">Detail</h5> 
        </div>
        <a href="{{ route('frontend.laporan_proyek.index') }}">
            <button class="btn btn-back">Kembali</button>
        </a>
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
    <div class="row">
        <div class="col-lg-5 col-md-5">
            <div class="card p-4">
                <div class="head-title pb-3 mb-3">
                    <div>
                        <h5 class="title-proyek">Laporan Proyek {{ $laporanProyek->proyek->nama_proyek}}</h5>
                    </div>
                    <span class="ms-3">
                        @if ($laporanProyek->is_approved == 1)
                        <span class="badge text-bg-success" style="font-size: 13px">Disetujui</span>
                        @elseif ($laporanProyek->is_approved === 0)
                        <span class="badge text-bg-danger" style="font-size: 13px">Ditolak</span>
                        @else 
                        <span class="badge text-bg-warning text-dark" style="font-size: 13px">Pending</span>
                        @endif
                    </span>
                </div>
                <div class="d-flex align-items-center mb-4">
                    <img src="{{ asset('storage/' . $laporanProyek->user->gambar) }}" alt="Profile Picture" class="profile-img">
                    <div>
                        <h6 class="mb-0" style="font-weight: 700; color: #333;">{{ ucfirst($laporanProyek->user->name) }}</h6>
                        <small class="text-label">Nama</small>
                    </div>
                </div>

                <div class="info-item">
                    <i class="fas fa-hard-hat icon"></i>
                    <div>
                        <p class="text-value mb-0 title-proyek">{{ $laporanProyek->proyek->nama_proyek }}</p>
                        <p class="text-label">Nama Laporan Proyek</p>
                    </div>
                </div>
                <div class="info-item">
                    <i class="fas fa-barcode icon"></i>
                    <div>
                        <p class="text-value mb-0 title-proyek">{{ $laporanProyek->kode_laporan }}</p>
                        <p class="text-label">Kode Laporan Proyek</p>
                    </div>
                </div>
                <div class="info-item">
                    <i class="fas fa-calendar-alt icon"></i>
                    <div>
                        <div class="periode-dates">
                            <span class="text-value-flex mb-0">{{ $laporanProyek->proyek->tanggal_mulai }}</span>
                            <span> s/d </span>
                            <span class="text-value-flex mb-0">{{ $laporanProyek->proyek->tanggal_selesai }}</span>
                          </div>
                        <p class="text-label">Periode Tanggal Proyek</p>
                    </div>
                </div>
                <div class="info-item">
                    <i class="fas fa-file-contract icon"></i>
                    <div>
                        <p class="text-value mb-0">{{ $laporanProyek->proyek->masa_kontrak }}</p>
                        <p class="text-label">Lama Hari Proyek</p>
                    </div>
                </div>
                <div class="info-item">
                    <i class="fas fa-money-bill-wave icon"></i>
                    <div>
                        <p class="text-value mb-0"> Rp. {{ number_format($laporanProyek->proyek->anggaran, 0, ',', '.') }}</p>
                        <p class="text-label">Anggaran Proyek</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-7 col-md-7">
            <div class="card p-4">
                <div class="d-flex justify-content-between">
                    <h5 class="mb-3" style="font-weight: 600; color: #333;">Detail Laporan Proyek</h5>
                    <div class="dropdown">
                        <button class="view-cetak-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end custom-dropdown">
                            <li>
                                <a class="dropdown-item text-success fw-bold" href="{{ route('frontend.laporan_proyek.cetak', $laporanProyek->id) }}">
                                    <i class="fas fa-edit me-2"></i>Cetak PDF
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <ul class="nav nav-pills " id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-detail-tab" data-bs-toggle="pill" data-bs-target="#pills-detail" type="button" role="tab" aria-controls="pills-detail" aria-selected="true">Detail</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-deskripsi-tab" data-bs-toggle="pill" data-bs-target="#pills-deskripsi" type="button" role="tab" aria-controls="pills-deskripsi" aria-selected="false">Deskripsi</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-dokumentasi-tab" data-bs-toggle="pill" data-bs-target="#pills-dokumentasi" type="button" role="tab" aria-controls="pills-dokumentasi" aria-selected="false">Dokumentasi</button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-detail" role="tabpanel" aria-labelledby="pills-detail-tab">
                        <div class="activity-card">
                            <div class="text-laporan">
                                <h5><i class="bi bi-pencil-square me-2"></i>Keterangan Proyek</h5>
                                <div class="text-muted">{{ $laporanProyek->keterangan }}</div>
                            </div>
                            <div class="text-laporan">
                                <h5><i class="bi bi-pencil-square me-2"></i>Kendala Proyek</h5>
                                <div class="text-muted"> {{ $laporanProyek->kendala }}</div>
                            </div>
                            <div class="text-laporan">
                                <h5><i class="bi bi-pencil-square me-2"></i>Evaluasi Proyek</h5>
                                <div class="text-muted">{{ $laporanProyek->evaluasi }}</div>
                            </div>
                            @if ($laporanProyek->is_approved === 0)
                            <div class="text-laporan">
                                <h5><i class="bi bi-pencil-square me-2"></i>Alasan Penolakan Laporan Proyek</h5>
                                <div class="text-muted">{{ $laporanProyek->keterangan_tolak }}</div>
                            </div>
                            @endif
                            <p class="text-muted text-center m-0 p-3">Detail Laporan proyek.</p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-deskripsi" role="tabpanel" aria-labelledby="pills-deskripsi-tab">
                        <div class="activity-card">
                            <div class="text-deskripsi">
                                <strong><i class="bi bi-pencil-square me-2"></i>Deskripsi Proyek</strong>
                                <div class="text-muted">{{ $laporanProyek->proyek->deskripsi_proyek }}</div>
                            </div>                            
                            <p class="text-muted text-center m-0 p-3">Deskripsi proyek.</p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-dokumentasi" role="tabpanel" aria-labelledby="pills-dokumentasi-tab">
                        <div class="activity-card">
                            <div class="text-laporan">
                                <h5>Dokumentasi Laporan Proyek Awal & Tambahan</h5>
                                @php
                                $grupUploadAwal = $laporanProyek->dokumentasi->where('is_initial', false);
                                $grupUploadTambahan = $laporanProyek->dokumentasi->where('is_initial', true)->groupBy('persentase')->sortKeys();
                                @endphp
                                {{-- Upload Awal --}}
                                @php
                                $dokAwalPertama = $grupUploadAwal->first();
                                @endphp
                            
                                <h6 class="mt-3 mb-2 text-success">📌 Upload Awal</h6>
                                @if ($dokAwalPertama)
                                    <div class="text-muted"><strong>Keterangan:</strong> {{ $dokAwalPertama->keterangan }}</div>
                                    <div class="text-muted"><strong>Progress:</strong> {{ $dokAwalPertama->progres?->persentase ?? '-' }}%</div>
                                @endif
                                <div class="row mt-2">
                                    @forelse ($grupUploadAwal as $dok)
                                        <div class="col-md-6 col-lg-5 mb-4">
                                            <div class="h-100">
                                                @if ($dok->file_type == 'image')
                                                    <img src="{{ asset('storage/' . $dok->file_path) }}" class="card-img-top rounded-4" alt="Dokumentasi">
                                                @else
                                                    <video controls class="w-100" style="max-height: 250px; object-fit: cover;">
                                                        <source src="{{ asset('storage/' . $dok->file_path) }}" type="{{ \File::mimeType(public_path('storage/' . $dok->file_path)) }}">
                                                        Browser Anda tidak mendukung video.
                                                    </video>
                                                @endif
                                                {{-- <p class="mt-2"><strong>Keterangan:</strong> {{ $dok->keterangan }}</p>
                                                <p><strong>Progress:</strong> {{ $dok->progres?->persentase ?? '-' }}%</p> --}}
                                                {{-- <p><strong>Upload Awal:</strong> Ya</p> --}}
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12">
                                            <p class="text-muted">Tidak ada dokumentasi awal tersedia.</p>
                                        </div>
                                    @endforelse
                                </div>
                                <hr class="batas-upload">
                                {{-- Upload Tambahan --}}
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <h6 class="mb-0 me-3 text-primary">📌 Upload Tambahan</h6>
                                    @php
                                    $statusProyek = optional($laporanProyek->proyek)->status;
                                    @endphp
                                    <!-- Tombol untuk membuka modal -->
                                    @if($statusProyek === 'batal' || $statusProyek === 'selesai')
                                    <button type="button" class="btn btn-secondary" disabled>
                                        <i class="fa fa-ban me-1"></i> Proyek {{ ucfirst($statusProyek) }}
                                    </button>
                                    @else
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadTambahanModal">
                                        <i class="fa fa-plus"></i> Tambah
                                    </button>
                                    @endif

                                </div>                                                                                           
                                <!-- Modal -->
                                <div class="modal fade" id="uploadTambahanModal" tabindex="-1" aria-labelledby="uploadTambahanModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <form action="{{ route('frontend.laporan_proyek.storeTambahan') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="laporan_id" value="{{ $laporanProyek->id }}">
                                
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="uploadTambahanModalLabel">Upload Dokumentasi Tambahan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                                </div>
                                
                                                <div class="modal-body">
                                                    <div class="row g-3">
                                                        <div class="col-md-4">
                                                            <label for="persentase" class="form-label">Pilih Persentase</label>
                                                            <select name="persentase" class="form-control" required>
                                                                @forelse ($persenTersisa as $persen)
                                                                    <option value="{{ $persen }}">{{ $persen }}%</option>
                                                                @empty
                                                                    <option disabled>Proyek Selesai</option>
                                                                @endforelse
                                                            </select>
                                                        </div>
                                
                                                        <div class="col-md-8">
                                                            <label for="dokumentasi" class="form-label">Upload Gambar</label>
                                                            <input type="file" name="dokumentasi[]" class="form-control" multiple accept="image/*">
                                                        </div>
                                
                                                        <div class="col-md-12">
                                                            <label for="keterangan" class="form-label">Keterangan</label>
                                                            <textarea name="keterangan" class="form-control" rows="3" placeholder="Keterangan berupa Kendala dan Evaluasi" required></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">
                                                        <i class="fa fa-upload"></i> Upload
                                                    </button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                @forelse ($grupUploadTambahan as $persen => $doks)
                                <div class="card mb-4 shadow-sm border">
                                    <div class="card-header bg-light">
                                        <div class="d-flex justify-content-between align-items-center px-4 py-3">
                                            <!-- Kiri: Progress dan Keterangan -->
                                            <div>
                                                <strong>Progress: {{ $persen }}%</strong>
                                                <p class="mt-2"><strong>Keterangan:</strong> {{ $doks->first()->keterangan ?? '-' }}</p>
                                            </div>
                                            
                                            <!-- Kanan: Tombol Edit & Hapus -->
                                            <div class="d-flex gap-2 align-items-center">
                                                <div class="dropdown">
                                                    <button class="view-cetak-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end custom-dropdown-tom">
                                                        <li>
                                                            <button class="dropdown-item text-primary fw-bold" data-bs-toggle="modal" data-bs-target="#modalEditPersen{{ $persen }}">
                                                                <i class="fas fa-pen-to-square me-2"></i> Edit
                                                            </button>
                                                        </li>
                                                        <li>
                                                            <button class="dropdown-item text-danger fw-bold" data-bs-toggle="modal" data-bs-target="#modalHapusPersen{{ $persen }}">
                                                                <i class="fas fa-trash-alt me-2"></i> Hapus
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                              
                                                <div class="modal fade" id="modalHapusPersen{{ $persen }}" tabindex="-1" aria-labelledby="modalHapusLabel{{ $persen }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content border-0 shadow">
                                                            <div class="modal-header bg-danger text-white">
                                                                <h5 class="modal-title" id="modalHapusLabel{{ $persen }}">
                                                                    <i class="fas fa-trash-alt me-1"></i> Konfirmasi Hapus
                                                                </h5>
                                                                <button type="button" class="btn-close btn-close-white"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                        
                                                            <div class="modal-body">
                                                                <p>Apakah kamu yakin ingin <strong>menghapus seluruh dokumentasi pada progres {{ $persen }}%</strong>?</p>
                                                                <p class="text-muted mb-0">Tindakan ini tidak dapat dibatalkan.</p>
                                                            </div>
                                                        
                                                            <div class="modal-footer">
                                                                <form method="POST" action="{{ route('dokumentasi.destroy_by_progress') }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <input type="hidden" name="laporan_id" value="{{ $laporanProyek->id }}">
                                                                    <input type="hidden" name="persentase" value="{{ $persen }}">
                                                        
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-danger">
                                                                        <i class="fas fa-trash-alt me-1"></i> Hapus
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    
                                            <div class="modal fade" id="modalEditPersen{{ $persen }}" tabindex="-1" aria-labelledby="editPersenLabel{{ $persen }}" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content border-0 shadow">
                                                        <div class="modal-header text-white">
                                                            <h5 class="modal-title" id="editPersenLabel{{ $persen }}">Edit Dokumentasi {{ $persen }}%</h5>
                                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                            
                                                        <form action="{{ route('dokumentasi.update_by_progress') }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="laporan_id" value="{{ $laporanProyek->id }}">
                                                            <input type="hidden" name="persentase" value="{{ $persen }}">
                                            
                                                            <div class="modal-body">
                                                                <div class="row g-3">
                                                                    <!-- Upload File Baru -->
                                                                    <div class="col-md-12">
                                                                        <label class="form-label">Ganti File (opsional)</label>
                                                                        <input type="file" name="dokumentasi[]" class="form-control" accept="image/*,video/*" multiple>
                                                                    </div>
                                            
                                                                    <!-- Keterangan -->
                                                                    <div class="col-12">
                                                                        <label for="keterangan" class="form-label">Keterangan</label>
                                                                        <textarea name="keterangan" class="form-control  text-long" rows="3" required>{{ $doks->first()->keterangan }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                            
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary"><i class="fa fa-save me-1"></i> Update Perubahan</button>
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            @foreach ($doks as $dok)
                                            <div class="col-md-6 col-lg-5 mb-4 position-relative">
                                                <div class="h-100 border rounded-4 overflow-hidden position-relative" style="background-color: #f8f9fa;">
                                                    {{-- Tombol Dropdown di pojok kanan atas gambar --}}
                                                    <div class="position-absolute top-0 end-0 m-2 z-3">
                                                        <div class="dropdown">
                                                            <button class="btn btn-sm btn-light rounded-circle shadow-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="fas fa-ellipsis-v"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end custom-dropdown-tom">
                                                                <li>
                                                                    <form method="POST" action="{{ route('dokumentasi.destroy', $dok->id) }}">
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
                                        
                                                    {{-- Gambar atau video --}}
                                                    @if ($dok->file_type == 'image')
                                                        <img src="{{ asset('storage/' . $dok->file_path) }}" class="w-100 h-100 object-fit-cover" alt="Dokumentasi">
                                                    @else
                                                        <video controls class="w-100" style="max-height: 250px; object-fit: cover;">
                                                            <source src="{{ asset('storage/' . $dok->file_path) }}" type="{{ \File::mimeType(public_path('storage/' . $dok->file_path)) }}">
                                                            Browser Anda tidak mendukung video.
                                                        </video>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <p class="text-muted">Tidak ada dokumentasi tambahan tersedia.</p>
                                </div>
                            @endforelse

                            </div>
                        </div>
                    </div>                  
                </div>
            </div>
        </div>
    </div>
</div>

    <style>

        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
            background-color: #fff;
            margin-bottom: 20px;
        }
        .title-proyek {
            font-weight: 600;
            color: #333;
            margin-bottom: 0;
            word-wrap: break-word; 
            word-break: break-word; 
            overflow-wrap: break-word; 
        }
        .page-text {
            margin-bottom: 0;
        }
        .lokasi-title {
            font-size: 1.1rem;
        }
        .text-deskripsi {
            margin-bottom: 20px;
        }
        .text-deskripsi strong {
            display: flex;
            align-items: center;
            font-size: 1.1rem;
            color: #333;
            margin-bottom: 8px;
        }
        
        .text-deskripsi .text-muted {
            text-align: justify;
            font-size: 1rem;
            color: #6c757d; 
            line-height: 1.6;
        }
        .text-laporan {
            margin-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        .text-laporan h5 {
            display: flex;
            font-weight: 800;
            align-items: center;
            font-size: 1.05rem;
            color: #415d4d;
            margin-bottom: 8px;
        }
    
        .text-laporan .text-muted {
            text-align: justify;
            font-size: 0.95rem;
            color: #6c757d;
            line-height: 1.6;
        }
    
        .head-title {
            display: flex; 
            align-items: center; 
            justify-content: space-between; 
            border-bottom: 1px solid #eee;
        }
        .header-section h4 {
            color: #333;
            font-weight: 600;
        }
        .btn-back {
            background-color: #6ba1ff; 
            border-color: #6ba1ff;
            color: white;
            font-weight: 600;
            padding: 8px 20px;
            border-radius: 8px;
        }
        .btn-back:hover {
            background-color: #2f67c7;
            border-color: #2f67c7;
            color: white;
        }
        .profile-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 15px;
            border: 2px solid #eee;
        }
        .info-item {
            display: flex;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }
        .info-item:last-child {
            border-bottom: none;
        }
        .info-item .icon {     
            padding: 11px;
            border-radius: 15px;
            margin-right: 10px;
            font-size: 1.3rem;
            margin-bottom: 3px;
            background-color: #e0f7e9;
        }
        .info-item .text-value {
            font-size: 16px;
            color: #0a3c09;
            margin-bottom: 0;
            display: block;
            font-weight: 700;
        }
        .text-value-flex {
            font-size: 16px;
            color: #0a3c09;
            margin-bottom: 0;
            font-weight: 700;
        }
        .info-item .text-label {
            font-size: 14px;
            color: #407752;
            font-weight: 500;
            margin-bottom: 0;
        }
        .badge-single {
            padding: 6px;
            border-radius: 10px; 
            font-size: 0.80rem; 
            font-weight: 600; 
            white-space: nowrap; 
            background-color: #63dc7f;
            line-height: 1.1; 
            display: inline-flex; 
            align-items: center; 
            justify-content: center;
        }
        .nav-pills .nav-link {
            border-radius: 10px;
            color: #6c757d;
            font-weight: 500;
            padding: 8px 20px;
        }
        .nav-pills .nav-link.active {
            background-color: #e0f7e9;
            color: #28a745;
            font-weight: 600;
        }
        .activity-card {
            background-color: #ffffff;
            border-radius: 15px;
            padding: 20px;
            margin-top: 15px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.03);
        }
        .activity-date {
            font-size: 13px;
            color: #888;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .activity-item {
            display: flex;
            align-items: flex-start;
            margin-top: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }
        .activity-item:last-child {
            border-bottom: none;
        }
        .activity-icon-wrapper {
            background-color: #f5f5f5;
            border-radius: 10px;
            padding: 10px;
            margin-right: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .activity-icon {
            font-size: 24px;
            color: #6c757d;
        }
        .activity-content {
            flex-grow: 1;
        }
        .activity-title {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
        }
        .activity-detail {
            font-size: 14px;
            color: #555;
            margin-bottom: 5px;
        }
        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 13px;
            margin-left: auto; 
        }
        .status-pending {
            background-color: #fff3cd; 
            color: #ffc107;
        }
        .status-accepted {
            background-color: #d4edda; 
            color: #28a745; 
        }
        .nominal-pengajuan {
            font-size: 14px;
            color: #6c757d;
            margin-top: 10px;
        }
        .nominal-value {
            font-size: 18px;
            font-weight: 700;
            color: #ff6b81; 
            margin-top: 5px;
        }
    .text-muted {
        margin-left: 5px;
    }
    </style>
    @endsection
