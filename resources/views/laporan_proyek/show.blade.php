@extends('layouts.app')

@section('content')
<div class="container-fluid py-2 mb-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start text-start margin-tb">
        <!-- Tombol Kembali & Cetak PDF -->
        <div class="d-flex flex-row flex-wrap gap-2" style="padding-top: 15px;">
            <a class="btn btn-primary btn-sm fs-6 d-flex align-items-center" 
               href="{{ route('laporan_proyek.index') }}" 
               style="height: 45px; padding: 0 20px;">
                <i class="fas fa-reply fs-6 me-2"></i>
                <span>Kembali</span>
            </a>
    
            <a href="{{ route('laporan_proyek.cetak', $laporanProyek->id) }}" 
               class="btn btn-dark btn-sm fs-6 d-flex align-items-center" 
               target="_blank" style="height: 45px; padding: 0 20px;">
                <i class="fas fa-print fs-6 me-2"></i>
                <span>Cetak PDF</span>
            </a>
        </div>
    
        <!-- Judul Detail -->
        <div class="card card-head border-0 mt-3 mt-md-0 mb-4 w-full sm:w-1/3 md:w-1/2 lg:w-1/3" 
            style="box-shadow: 2px 2px 3px 1px rgb(143, 148, 251);">
            <div class="card-body p-3">
                <div class="d-flex justify-content-start align-items-start">
                    <h4 class="fw-bolder text-dark mb-0">
                        Detail Laporan
                    </h4>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid py-2 px-0 mb-5">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex align-items-center">
                <i class="bi bi-info-circle me-2"></i>
                <h4 class="mb-0 text-white">Detail Laporan Proyek {{ $laporanProyek->proyek->nama_proyek }}</h4>
            </div>
    
            <div class="card-body">
                <div class="row mb-1">
                    <!-- Gambar & Info Singkat -->
                    <div class="col-md-5">
                        <div class="mb-2">
                            <strong><i class="bi bi-card-list me-1"></i>Nama Proyek :</strong>
                            <div class="text-muted">{{ $laporanProyek->proyek->nama_proyek }}</div>
                        </div>
                
                        <div class="mb-2">
                            <strong><i class="bi bi-cash me-1"></i>Anggaran :</strong>
                            <div class="text-muted">Rp{{ number_format($laporanProyek->proyek->anggaran, 0, ',', '.') }}</div>
                        </div>
                
                        <div class="mb-2">
                            <strong><i class="bi bi-diagram-3 me-1"></i>Status Proyek :</strong>
                            <span class="badge text-bg-success">{{ ucfirst($laporanProyek->proyek->status) }}</span>
                        </div>
                
                        <div class="mb-2">
                            <strong><i class="bi bi-calendar-week me-1"></i>Masa Kontrak :</strong>
                            <div class="text-muted">{{ $laporanProyek->proyek->masa_kontrak }}</div>
                        </div>
                
                        <div class="mb-2">
                            <strong><i class="bi bi-clock me-1"></i>Periode :</strong>
                            <div class="text-muted">{{ $laporanProyek->proyek->tanggal_mulai }} s/d {{ $laporanProyek->proyek->tanggal_selesai }}</div>
                        </div>
                
                        <div class="mb-2">
                            <strong><i class="bi bi-person-circle me-1"></i>Dibuat oleh :</strong>
                            <div class="text-muted">{{ $laporanProyek->user->name }}</div>
                        </div>
                
                        <div class="mb-2">
                            <strong><i class="bi bi-clipboard-check me-1"></i>Status Laporan :</strong>
                            @if ($laporanProyek->is_approved == 1)
                                <span class="badge text-bg-success">Disetujui</span>
                            @elseif ($laporanProyek->is_approved === 0)
                                <span class="badge text-bg-danger">Ditolak</span>
                            @else 
                                <span class="badge text-bg-warning">Pending</span>
                            @endif
                        </div>
                
                        @if ($laporanProyek->is_approved === 0)
                            <div class="mb-2">
                                <strong><i class="bi bi-exclamation-circle me-1"></i>Alasan Penolakan:</strong>
                                <div class="text-muted">{{ $laporanProyek->keterangan_tolak }}</div>
                            </div>
                        @endif
                    </div>
             
                
                    <!-- Deskripsi & Evaluasi -->
                    <div class="col-md-7">
                        <div class="mb-3">
                            <strong><i class="bi bi-journal-text me-1"></i>Keterangan Laporan:</strong>
                            <div class="text-muted" style="text-align: justify;">{{ $laporanProyek->keterangan }}</div>
                        </div>
                
                        <div class="mb-3">
                            <strong><i class="bi bi-tools me-1"></i>Kendala Proyek:</strong>
                            <div class="text-muted" style="text-align: justify;">{{ $laporanProyek->kendala }}</div>
                        </div>
                
                        <div class="mb-3">
                            <strong><i class="bi bi-bar-chart-line me-1"></i>Evaluasi Proyek:</strong>
                            <div class="text-muted" style="text-align: justify;">{{ $laporanProyek->evaluasi }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr class="animasi-hr">
    <h4>Dokumentasi Upload Awal & Tambahan</h4>

    @php
    // Group dokumentasi based on the 'is_initial' flag
    $grupUploadAwal = $laporanProyek->dokumentasi->where('is_initial', false);
    $grupUploadTambahan = $laporanProyek->dokumentasi->where('is_initial', true)->groupBy('persentase')->sortKeys();
    @endphp
     {{-- Upload Awal --}}
     @php
     $dokAwalPertama = $grupUploadAwal->first();
     @endphp
    <div class="card shadow-sm border-0 p-4 mt-4">
        <h4>📸 Dokumentasi Proyek</h4>
    
        <h5 class="mt-3 mb-2">📌 Upload Awal</h5>
        @if ($dokAwalPertama)
        <div class="card-header bg-light rounded-top-2">
               <div class="text-muted"><strong>Keterangan:</strong> {{ $dokAwalPertama->keterangan }}</div>
               <div class="text-muted"><strong>Progress:</strong> {{ $dokAwalPertama->progres?->persentase ?? '-' }}%</div> 
        </div>
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
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-muted">Tidak ada dokumentasi awal tersedia.</p>
                </div>
            @endforelse
        </div>
        <hr>
        <h5 class="mt-3 mb-2">📌 Upload Tambahan</h5>
        @forelse ($grupUploadTambahan as $persen => $doks)
        <div class="card mb-4 shadow-sm border">
            <div class="card-header bg-light">
                <div class="card-header bg-light d-flex justify-content-between align-items-center px-4 py-3">
                    <!-- Kiri: Progress dan Keterangan -->
                    <div>
                        <p class="mb-1 text-muted fw-bold lg">
                            <i class="fas fa-chart-line me-1"></i> Progress :
                            <span class="badge bg-primary bg-opacity-75" style="font-size: 15px;">{{ $persen }}%</span>
                        </p>
                        <p class="mb-0 text-muted lg">
                            <i class="fas fa-comment-dots me-1"></i>
                            <strong>Keterangan :</strong> {{ $doks->first()->keterangan ?? '-' }}
                        </p>
                    </div>
                    
                    <!-- Kanan: Tombol Edit & Hapus -->
                    <div class="d-flex gap-2 align-items-center">
                        <!-- Tombol Edit -->
                        <button class="btn btn-outline-primary rounded-2 px-3 shadow-sm"
                                data-bs-toggle="modal" data-bs-target="#modalEditPersen{{ $persen }}">
                            <i class="fas fa-pen-to-square me-1"></i> Edit
                        </button>
                    
                        <button type="button"
                        class="btn btn-outline-danger rounded-2 px-3 shadow-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#modalHapusPersen{{ $persen }}">
                        <i class="fas fa-trash-alt me-1"></i> Hapus
                        </button>
                        
                        <!-- Modal Konfirmasi Hapus -->
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
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title text-white" id="editPersenLabel{{ $persen }}">✏️ Edit Dokumentasi {{ $persen }}%</h5>
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
                        <div class="border rounded-4 overflow-hidden position-relative" style="background-color: #f8f9fa; height: 250px; max-width: 100%;">
                            {{-- Tombol Dropdown di pojok kanan atas gambar --}}
                            <div class="position-absolute top-0 end-0 m-2 z-3">
                                <div class="dropdown">
                                    <button class="btn btn-sm bg-light bg-opacity-75 rounded-circle shadow-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fs-6"></i>
                                    </button>                                    
                                    <ul class="dropdown-menu dropdown-menu-end">
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
                                <img src="{{ asset('storage/' . $dok->file_path) }}"
                                     class="w-100 h-100 object-fit-cover"
                                     alt="Dokumentasi">
                            @else
                                <video controls
                                       class="w-100 h-100 object-fit-cover"
                                       style="object-fit: cover;">
                                    <source src="{{ asset('storage/' . $dok->file_path) }}"
                                            type="{{ \File::mimeType(public_path('storage/' . $dok->file_path)) }}">
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
            <!-- Tombol Trigger -->
            @php
            $statusProyek = optional($laporanProyek->proyek)->status;
            @endphp
            
            @if($statusProyek === 'batal' || $statusProyek === 'selesai')
                <button type="button" class="btn btn-secondary w-auto w-sm-100 d-block mx-auto fs-6" disabled>
                    <i class="fa fa-ban me-1"></i> Proyek {{ ucfirst($statusProyek) }}
                </button>
            @else
                <button type="button" class="btn btn-primary w-auto w-sm-100 d-block mx-auto"
                    data-bs-toggle="modal" data-bs-target="#modalUploadDokumentasi">
                    <i class="fa fa-upload me-1"></i> Tambah Dokumentasi Tambahan
                </button>
            @endif
        
            <!-- Modal -->
            <div class="modal fade" id="modalUploadDokumentasi" tabindex="-1" aria-labelledby="uploadDokumentasiLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content border-0 shadow">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="uploadDokumentasiLabel">📸 Upload Dokumentasi Tambahan</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form action="{{ route('laporan_proyek.storeTambahan') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="laporan_id" value="{{ $laporanProyek->id }}">
            
                            <div class="modal-body">
                                <div class="row g-3">
            
                                    <!-- Persentase -->
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
            
                                    <!-- Upload File -->
                                    <div class="col-md-8">
                                        <label class="form-label">Upload Dokumentasi <small>(max 3 file: gambar/video)</small></label>
                                        <input type="file" name="dokumentasi[]" class="form-control" accept="image/*,video/*" multiple required>
                                    </div>
            
                                    <!-- Keterangan -->
                                    <div class="col-12">
                                        <label for="keterangan" class="form-label">Keterangan</label>
                                        <textarea name="keterangan" class="form-control" rows="3" placeholder="Keterangan berupa Kendala dan Evaluasi" required style="height: 120px"></textarea>
                                    </div>
            
                                </div>
                            </div>
            
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success"><i class="fa fa-upload me-1"></i> Upload</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
     </div>
 @endsection
