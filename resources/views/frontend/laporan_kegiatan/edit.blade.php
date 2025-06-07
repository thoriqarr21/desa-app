@extends('frontend.layouts.master')

@section('content')
<style>
    body {
        background-color: #f8f9fa; /* Light grey background */
        font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; /* A clean, modern font */
    }
    .container-fluid {
        padding-left: 20px; /* Adjust as needed */
        padding-right: 20px; /* Adjust as needed */
    }
    .margin-tb {
        margin-top: 20px;
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between; /* To push items to ends */
        align-items: center;
        width: 100%; /* Ensure it spans full width */
    }

    /* Header Card (Buat Laporan Kegiatan) */
    .header-card-wrapper {
        flex-grow: 1; /* Allow it to grow and take available space */
        display: flex;
        justify-content: center; /* Center the card horizontally */
        /* Adjust these negative margins to visually center the card,
           compensating for the left button and right placeholder */
        margin-left: -50px;
        margin-right: -50px;
    }

    .header-card {
        background-color: #ffffff;
        border-radius: 12px; /* Lebih bulat */
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Bayangan yang lebih halus */
        padding: 15px 30px; /* Padding disesuaikan */
        display: inline-block; /* Agar lebar sesuai konten */
        white-space: nowrap; /* Prevent text wrapping */
    }
    .header-card h4 {
        font-size: 1.5rem; /* Ukuran font disesuaikan */
        font-weight: 700; /* Lebih tebal */
        color: #343a40; /* Warna teks gelap */
        margin-bottom: 0;
        display: flex;
        align-items: center;
        gap: 10px; /* Jarak antara ikon dan teks */
    }

    /* Main Form Card */
    .main-form-card {
        background-color: #ffffff; /* Latar belakang putih */
        border-radius: 12px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08); /* Bayangan yang lebih lembut */
        padding: 40px;
        margin-top: 20px;
    }

    /* Form Labels */
    .form-label-custom {
        font-weight: 700;
        font-size: 16px;
        color: #333;
    }

    select.form-select {
        height: 45px;
        font-weight: 500;
        color: #333;
    }


    /* Custom input fields, textareas, and selects */
    .form-control-custom, .form-select-custom {
        border-radius: 8px;
        padding: 12px 15px;
        border: 1px solid #dee2e6; /* Light grey border */
        font-size: 1rem;
        color: #495057;
        transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        height: 45px; /* Fixed height for inputs */
    }
    .form-control-custom::placeholder {
        color: #adb5bd;
        font-weight: 400;
    }
    .form-control-custom:focus, .form-select-custom:focus {
        border-color: #007bff; /* Blue border on focus */
        box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25); /* Light blue shadow on focus */
        outline: none;
    }
    /* Hover effect */
    .form-control-custom:not(:focus):hover, .form-select-custom:not(:focus):hover {
        border-color: #80bdff; /* Lighter blue on hover */
    }

    /* Input group text/icons */
    .input-group-text-custom {
        background-color: #f8f9fa; /* Lighter background for add-on */
        border: 1px solid #dee2e6;
        border-right: none;
        border-radius: 8px 0 0 8px;
        padding: 12px 15px;
        color: #6c757d; /* Icon color */
        height: 45px; /* Match input height */
    }
    .input-group-text-custom + .form-control-custom,
    .input-group-text-custom + .form-select-custom {
        border-left: none; /* Remove left border of input/select to merge with add-on */
        border-radius: 0 8px 8px 0; /* Round right corners */
    }
    .input-group-text-custom-right { /* For calendar icon on the right */
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-left: none;
        border-radius: 0 8px 8px 0;
        padding: 12px 15px;
        color: #6c757d;
        height: 45px;
    }
    .form-control-custom + .input-group-text-custom-right {
        border-right: none; /* remove right border to merge with add-on */
        border-radius: 8px 0 0 8px; /* round left corners */
    }


    /* Textarea specific styling */
    textarea.form-control-custom {
        min-height: 120px; /* Adjust height as needed for description */
        resize: vertical; /* Allow vertical resizing */
        height: auto; /* Allow auto height based on content or min-height */
    }

    /* Status Toggle Radio Buttons (Open/Closed) */
    .status-toggle {
        display: flex;
        margin-top: 5px;
        width: fit-content;
        gap: 15px; /* Spacing between "Open" and "Closed" cards */
    }
    .status-toggle input[type="radio"] {
        display: none; /* Hide default radio button */
    }
    .status-toggle .status-option-card {
        background-color: #f8f9fa; /* Default card background */
        border: 1px solid #e0e0e0; /* Light border */
        border-radius: 8px;
        padding: 10px 20px;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 500;
        color: #495057;
        white-space: nowrap;
    }
    .status-toggle .status-option-card .icon {
        font-size: 1.1rem;
    }
    .status-toggle input[type="radio"]:checked + .status-option-card {
        background-color: #e6f7ff; /* Light blue background when selected */
        border-color: #007bff; /* Primary blue border when selected */
        box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.1); /* Light blue shadow */
        color: #007bff; /* Primary blue text when selected */
    }
    /* Specific colors for icons */
    #status_open:checked + .status-option-card .icon-open {
        color: #28a745; /* Green for check icon */
    }
    #status_closed:checked + .status-option-card .icon-closed {
        color: #dc3545; /* Red for cross icon */
    }


    /* Form Section Spacing */
    .form-section {
        margin-bottom: 25px; /* Increased space between form groups */
    }
    /* Special adjustment for thumbnail row */
    .thumbnail-row {
        margin-bottom: 25px;
    }
    .thumbnail-label {
        font-weight: 500;
        color: #495057;
        font-size: 0.95rem;
    }
    .thumbnail-image-container {
        width: 100px; /* Match image size */
        height: 100px;
        border-radius: 12px; /* More rounded */
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #e9ecef; /* Placeholder background */
        border: 1px solid #dee2e6;
        flex-shrink: 0; /* Prevent shrinking */
    }
    .thumbnail-image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .btn-upload-thumbnail {
        background-color: #1a5e4d; /* Dark green from image */
        color: #ffffff;
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 500;
        border: none;
        transition: background-color 0.2s ease;
    }
    .btn-upload-thumbnail:hover {
        background-color: #154c3e;
    }


    /* Action Buttons */
    .btn-primary-custom {
        background-color: #4662c8; /* Green */
        color: #ffffff;
        border-radius: 8px;
        padding: 12px 25px;
        font-weight: 500;
        border: none;
        transition: background-color 0.2s ease;
    }
    .btn-primary-custom:hover {
        background-color: #334faa; /* Darker green */
        color: #ffffff;
    }
    .btn-cancel-custom {
        background-color: #dc3545; /* Red */
        color: #ffffff;
        border-radius: 8px;
        padding: 12px 25px;
        font-weight: 500;
        border: none;
        transition: background-color 0.2s ease;
    }
    .btn-cancel-custom:hover {
        background-color: #c82333; /* Darker red */
        color: #ffffff;
    }
    .btn-custom:focus {
        box-shadow: none; /* Remove default focus outline */
    }

    /* Back Button */
    .btn-back-custom {
        background-color: #007bff; /* Primary blue */
        color: #ffffff;
        border-radius: 8px;
        padding: 8px 15px;
        font-size: 1rem;
        font-weight: 500;
        border: none;
        transition: background-color 0.2s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .btn-back-custom:hover {
        background-color: #0056b3; /* Darker blue */
    }
    .btn-back-custom i {
        font-size: 1rem;
    }

    /* Remove the duplicate H3 */
    h3.duplicate-header {
        display: none;
    }

    /* Responsive adjustments */
    @media (max-width: 992px) { /* Adjust breakpoint for larger screens */
        .header-card-wrapper {
            margin-left: 0;
            margin-right: 0;
        }
        .header-card {
            width: 100%;
            text-align: center;
        }
    }
    @media (max-width: 768px) {
        .main-form-card {
            padding: 25px;
        }
        .header-card h4 {
            font-size: 1.2rem;
            flex-direction: column;
            text-align: center;
            gap: 5px;
        }
        .status-toggle {
            flex-direction: column;
            width: 100%;
            gap: 10px;
        }
        .status-toggle .status-option-card {
            width: 100%;
            justify-content: center;
        }
        .d-flex.justify-content-between.align-items-center.margin-tb {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }
        .d-flex.justify-content-between.align-items-center.margin-tb > .card {
            width: 100% !important;
            margin-left: 0;
            margin-right: 0;
        }
        .d-flex.align-items-center.ms-3 {
            margin-left: 0 !important;
        }
        .thumbnail-row .col-md-3 {
            text-align: center;
        }
        .thumbnail-row .col-md-9 {
            flex-direction: column;
            align-items: center;
            margin-top: 15px;
        }
        .thumbnail-image-container {
            margin-bottom: 15px;
        }
        .d-flex.mt-4 {
            flex-direction: column;
            gap: 15px;
        }
        .d-flex.mt-4 .btn {
            width: 100%;
        }
    }
</style>

{{-- Pastikan Anda sudah mengimpor Font Awesome dan Bootstrap Icons di master layout Anda atau di sini --}}
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> --}}
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"> --}}

<div class="container-fluid py-3 mb-5">
    {{-- <div class="d-flex justify-content-between align-items-center margin-tb">
        <div class="d-flex align-items-center ms-3">
            <a class="btn btn-back-custom" href="{{ route('frontend.laporan_kegiatan.index') }}">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>
        <div class="header-card-wrapper">
            <div class="header-card">
                <div class="d-flex align-items-center justify-content-center">
                    <h4 class="fw-bold text-dark mb-0">
                        <i class="bi bi-pencil-square"></i> Buat Laporan Kegiatan
                    </h4>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="header-section">
        <div class="page-breadcrumb d-flex align-items-center gap-2">
            <h4 class="fw-bold text-dark mb-0">
                <i class="bi bi-pencil-square"></i> 
                Update Laporan Kegiatan
            </h4>
        </div>
        <a class="btn btn-back-custom" href="{{ route('frontend.laporan_kegiatan.index') }}">
             Kembali
        </a>
    </div>


    <div class="card main-form-card">
        <div class="card-body p-4">
            <form action="{{ route('frontend.laporan_kegiatan.update', $laporanKegiatan) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                {{-- <div class="row mb-4 align-items-center form-section thumbnail-row">
                    <div class="col-md-3">
                        <label class="thumbnail-label">Thumbnail Event Terkait</label>
                    </div>
                    <div class="col-md-9 d-flex align-items-center justify-content-start">
                        <div class="thumbnail-image-container me-3">
                            <img src="https://via.placeholder.com/100x100" alt="Thumbnail Event">
                            
                        </div>
                        <button type="button" class="btn btn-upload-thumbnail">Upload</button>
         
                        <input type="file" name="thumbnail_event_terkait" id="thumbnail_event_terkait_upload" style="display: none;" accept="image/*">
                    </div>
                </div> --}}


                {{-- <div class="row mb-4 align-items-center form-section">
                    <div class="col-md-3">
                        <label for="jumlah_dana" class="form-label-custom">Harga</label>
                    </div>
                    <div class="col-md-9">
                        <div class="input-group">
                            <span class="input-group-text input-group-text-custom">$</span>
                            <input type="text" name="jumlah_dana" class="form-control form-control-custom" placeholder="Contoh: 10,000">
                        </div>
                    </div>
                </div>

                <div class="row mb-4 align-items-center form-section">
                    <div class="col-md-3">
                        <label class="form-label-custom">Status Pembangunan</label>
                    </div>
                    <div class="col-md-9">
                        <div class="status-toggle">
                            <input type="radio" id="status_open" name="status" value="Open" checked>
                            <label for="status_open" class="status-option-card">
                                Open <i class="bi bi-check-circle icon-open"></i>
                            </label>
                            <input type="radio" id="status_closed" name="status" value="Closed">
                            <label for="status_closed" class="status-option-card">
                                Closed <i class="bi bi-x-circle icon-closed"></i>
                            </label>
                        </div>
                    </div>
                </div> --}}

                {{-- <div class="row mb-4 align-items-center form-section">
                    <div class="col-md-3">
                        <label for="tanggal_pembangunan" class="form-label-custom">Tanggal Event</label>
                    </div>
                    <div class="col-md-9">
                        <div class="input-group">
                            <input type="text" name="tanggal_event_display" class="form-control form-control-custom" value="dd/mm/yyyy" placeholder="dd/mm/yyyy">
                            <span class="input-group-text input-group-text-custom-right"><i class="bi bi-calendar"></i></span>
                            <input type="date" name="tanggal_pembangunan" id="tanggal_pembangunan_real" style="display: none;">
                        </div>
                    </div>
                </div>

                <div class="row mb-4 align-items-center form-section">
                    <div class="col-md-3">
                        <label for="waktu_event" class="form-label-custom">Waktu Event</label>
                    </div>
                    <div class="col-md-9">
                        <div class="input-group">
                            <input type="time" name="waktu_event_display" class="form-control form-control-custom" value="--.--" placeholder="hh:mm">
                            <span class="input-group-text input-group-text-custom-right"><i class="bi bi-clock"></i></span>
                            <input type="time" name="waktu_event" id="waktu_event_real" style="display: none;">
                        </div>
                    </div>
                </div> --}}

                
                <div class="row mb-4 align-items-center form-section">
                    <div class="col-md-3">
                        <label for="kegiatan_id" class="form-label-custom">Nama Kegiatan</label>
                    </div>  
                    <div class="col-md-9">
                        <div class="position-relative">
                            <i class="bi bi-pencil-square position-absolute top-50 start-0 translate-middle-y ms-3 text-success"></i>
                            <select name="kegiatan_id" id="kegiatan_id" class="form-select ps-5 rounded-3 border border-success" required>
                                @foreach ($kegiatan as $item)
                                <option value="{{ $item->id }}" {{ $item->id == $laporanKegiatan->kegiatan_id ? 'selected' : '' }}>
                                {{ $item->nama_kegiatan }}
                                </option>
                                @endforeach
                            </select>            
                            @error('kegiatan_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row mb-4 form-section">
                    <div class="col-md-3">
                        <label for="keterangan" class="form-label-custom">Keterangan Kegiatan</label>
                    </div>
                    <div class="col-md-9">
                        <textarea name="keterangan" class="form-control form-control-custom" rows="5" placeholder="Bantuan">{{ old('keterangan', $laporanKegiatan->keterangan) }}</textarea>
                    </div>
                </div>

                <div class="row mb-4 form-section">
                    <div class="col-md-3">
                        <label for="hasil" class="form-label-custom">Hasil</label>
                    </div>
                    <div class="col-md-9">
                        <textarea name="hasil" class="form-control form-control-custom" rows="3">{{ old('hasil', $laporanKegiatan->hasil) }}</textarea>
                    </div>
                </div>

                <div class="row mb-4 form-section">
                    <div class="col-md-3">
                        <label for="tujuan_kegiatan" class="form-label-custom">Tujuan Kegiatan</label>
                    </div>
                    <div class="col-md-9">
                        <textarea name="tujuan_kegiatan" class="form-control form-control-custom" rows="3">{{ old('tujuan_kegiatan', $laporanKegiatan->tujuan_kegiatan) }}</textarea>
                    </div>
                </div>

                <div class="row mb-4 form-section">
                    <div class="col-md-3">
                        <label for="evaluasi" class="form-label-custom">Evaluasi</label>
                    </div>
                    <div class="col-md-9">
                        <textarea name="evaluasi" class="form-control form-control-custom" rows="3">{{ old('evaluasi', $laporanKegiatan->evaluasi) }}</textarea>
                    </div>
                </div>

                <div class="row mb-4 align-items-center form-section">
                    <div class="col-md-3">
                        <label class="form-label-custom">Upload Dokumentasi</label>
                    </div>
                    <div class="col-md-9">
                        <input type="file" name="dokumentasi[]" class="form-control form-control-custom" accept="image/*,video/*" multiple required>
                        <small class="text-muted file-upload-small-text">Max 3 file. Gambar: jpg, png. Video: mp4, mov, avi. Maks. 10MB per file.</small>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('frontend.laporan_kegiatan.index') }}">
                        <button type="button" class="btn btn-cancel-custom me-3">Batal, Tidak Jadi</button>
                    </a>
                    <button type="submit" class="btn btn-primary-custom">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- @extends('frontend.layouts.master')


@section('content') --}}
{{-- <div class="container-fluid py-4 mb-5">
    <div class="d-flex justify-content-between align-items-center margin-tb">
        <div class="d-flex align-items-center ms-3 ">
            <a class="btn btn-primary btn-sm fs-6 " href="{{ route('frontend.laporan_kegiatan.index') }}"><i class="fa fa-arrow-left fs-6"></i> Kembali</a>
        </div>
        <div class="card border-0 mb-4 w-35" style="box-shadow: 3px 3px 5px 1px rgb(181, 148, 241);">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-center">
                    <div class="d-flex align-items-center">
                        <h4 class="fw-bold text-dark mb-0">
                            Edit Laporan Kegiatan
                        </h4>
                    </div>
                </div>
            </div>
        </div> 
        
    </div>
    <h3>✅ Edit Laporan</h3>

    <div class="card shadow-sm border-0 mb-5" style="background-color: #f8f9fa;">
        <div class="card-body p-4">
    <form action="{{ route('frontend.laporan_kegiatan.update', $laporanKegiatan) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="keterangan">Keterangan Kegiatan</label>
            <textarea name="keterangan" id="keterangan" class="form-control" required>{{ old('keterangan', $laporanKegiatan->keterangan) }}</textarea>
        </div>
        <div class="form-group">
            <label for="kegiatan_id">Pilih Kegiatan</label>
            <select name="kegiatan_id" id="kegiatan_id" class="form-control" required>
                <option value="">-- Pilih --</option>
                @foreach ($kegiatan as $item)
                <option value="{{ $item->id }}" {{ $item->id == $laporanKegiatan->kegiatan_id ? 'selected' : '' }}>
                {{ $item->nama_kegiatan }}
                </option>
                @endforeach
            </select>            
            @error('kegiatan_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="hasil">Hasil Kegiatan</label>
            <textarea name="hasil" id="hasil" class="form-control" required>{{ old('hasil', $laporanKegiatan->hasil) }}</textarea>
        </div>
        <div class="form-group">
            <label for="tujuan_kegiatan">Tujuan Kegiatan</label>
            <textarea name="tujuan_kegiatan" id="tujuan_kegiatan" class="form-control" required>{{ old('tujuan_kegiatan', $laporanKegiatan->tujuan_kegiatan) }}</textarea>
        </div>
        <div class="form-group">
            <label for="evaluasi">Evaluasi Kegiatan</label>
            <textarea name="evaluasi" id="evaluasi" class="form-control" required>{{ old('evaluasi', $laporanKegiatan->evaluasi) }}</textarea>
        </div>
        
        <div class="form-group">
            <label for="dokumentasi">Dokumentasi (opsional)</label>
            <input type="file" name="dokumentasi[]" class="form-control" accept="image/*,video/*">
            <small class="text-muted">Format gambar: jpg, png. Video: mp4, mov, avi. Maks. 10MB per file.</small>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        <a href="{{ route('frontend.laporan_kegiatan.index') }}" class="btn btn-secondary mt-3">Batal</a>
    </form>
</div>
</div>
</div> --}}


@endsection
