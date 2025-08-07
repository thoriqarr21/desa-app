@extends('frontend.layouts.master')

@section('content')
<style>
    body {
        background-color: #f8f9fa; 
        font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; 
    }
    .container-fluid {
        padding-left: 20px; 
        padding-right: 20px; 
    }
    .margin-tb {
        margin-top: 20px;
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between; 
        align-items: center;
        width: 100%; 
    }

    /* Header Card (Buat Laporan Kegiatan) */
    .header-card-wrapper {
        flex-grow: 1; 
        display: flex;
        justify-content: center; 
        margin-left: -50px;
        margin-right: -50px;
    }

    .header-card {
        background-color: #ffffff;
        border-radius: 12px; /* Lebih bulat */
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); 
        padding: 15px 30px; 
        display: inline-block; 
        white-space: nowrap; 
    }
    .header-card h4 {
        font-size: 1.5rem; 
        font-weight: 700;
        color: #343a40; 
        margin-bottom: 0;
        display: flex;
        align-items: center;
        gap: 10px; 
    }

    /* Main Form Card */
    .main-form-card {
        background-color: #ffffff; 
        border-radius: 12px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08); 
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
        border: 1px solid #dee2e6; 
        font-size: 1rem;
        color: #495057;
        transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        height: 45px; 
    }
    .form-control-custom::placeholder {
        color: #adb5bd;
        font-weight: 400;
    }
    .form-control-custom:focus, .form-select-custom:focus {
        border-color: #007bff; 
        box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25); 
        outline: none;
    }
    /* Hover effect */
    .form-control-custom:not(:focus):hover, .form-select-custom:not(:focus):hover {
        border-color: #80bdff;
    }

    /* Input group text/icons */
    .input-group-text-custom {
        background-color: #f8f9fa; 
        border: 1px solid #dee2e6;
        border-right: none;
        border-radius: 8px 0 0 8px;
        padding: 12px 15px;
        color: #6c757d; 
        height: 45px; 
    }
    .input-group-text-custom + .form-control-custom,
    .input-group-text-custom + .form-select-custom {
        border-left: none;
        border-radius: 0 8px 8px 0; 
    }
    .input-group-text-custom-right { 
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-left: none;
        border-radius: 0 8px 8px 0;
        padding: 12px 15px;
        color: #6c757d;
        height: 45px;
    }
    .form-control-custom + .input-group-text-custom-right {
        border-right: none; 
        border-radius: 8px 0 0 8px; 
    }


    /* Textarea specific styling */
    textarea.form-control-custom {
        min-height: 120px;
        resize: vertical; 
        height: auto; 
    }

    /* Status Toggle Radio Buttons (Open/Closed) */
    .status-toggle {
        display: flex;
        margin-top: 5px;
        width: fit-content;
        gap: 15px; 
    }
    .status-toggle input[type="radio"] {
        display: none;
    }
    .status-toggle .status-option-card {
        background-color: #f8f9fa;
        border: 1px solid #e0e0e0; 
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
        background-color: #e6f7ff; 
        border-color: #007bff; 
        box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.1);
        color: #007bff; 
    }
    /* Specific colors for icons */
    #status_open:checked + .status-option-card .icon-open {
        color: #28a745; 
    }
    #status_closed:checked + .status-option-card .icon-closed {
        color: #dc3545; 
    }


    /* Form Section Spacing */
    .form-section {
        margin-bottom: 25px; 
    }
  
    .thumbnail-row {
        margin-bottom: 25px;
    }
    .thumbnail-label {
        font-weight: 500;
        color: #495057;
        font-size: 0.95rem;
    }
    .thumbnail-image-container {
        width: 100px; 
        height: 100px;
        border-radius: 12px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #e9ecef; 
        border: 1px solid #dee2e6;
        flex-shrink: 0; 
    }
    .thumbnail-image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .btn-upload-thumbnail {
        background-color: #1a5e4d; 
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
    .btn-success-custom {
        background-color: #28a745; 
        color: #ffffff;
        border-radius: 8px;
        padding: 12px 25px;
        font-weight: 500;
        border: none;
        transition: background-color 0.2s ease;
    }
    .btn-success-custom:hover {
        background-color: #218838; 
        color: #ffffff;
    }
    .btn-cancel-custom {
        background-color: #dc3545; 
        color: #ffffff;
        border-radius: 8px;
        padding: 12px 25px;
        font-weight: 500;
        border: none;
        transition: background-color 0.2s ease;
    }
    .btn-cancel-custom:hover {
        background-color: #c82333; 
        color: #ffffff;
    }
    .btn-custom:focus {
        box-shadow: none; 
    }

    .btn-back-custom i {
        font-size: 1rem;
    }

    /* Remove the duplicate H3 */
    h3.duplicate-header {
        display: none;
    }

    /* Responsive adjustments */
    @media (max-width: 992px) { 
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


<div class="container-fluid py-3 mb-5">

    <div class="header-section">
        <div class="page-breadcrumb d-flex align-items-center gap-2">
            <h4 class="fw-bold text-dark mb-0">
                <i class="fas fa-plus me-1"></i>
                Create Laporan Kegiatan
            </h4>
        </div>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alertError">
        <strong>Terjadi kesalahan!</strong> Silakan periksa kembali data yang Anda masukkan:
        <ul class="mt-2 mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
    </div>
    @endif
    <div class="card main-form-card">
        <div class="card-body p-4">
            <form action="{{ route('frontend.laporan_kegiatan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf              
                <div class="row mb-4 align-items-center form-section">
                    <div class="col-md-3">
                        <label for="kegiatan_id" class="form-label-custom">Nama Kegiatan</label>
                    </div>  
                    <div class="col-md-9">
                        <div class="position-relative">
                            <i class="bi bi-pencil-square position-absolute top-50 start-0 translate-middle-y ms-3 text-success"></i>
                            <select name="kegiatan_id" id="kegiatan_id" class="form-select ps-5 rounded-3 border border-success" required>
                                <option value="">-- Pilih --</option>
                                @foreach ($kegiatans as $kegiatan)
                                    <option value="{{ $kegiatan->id }}">{{ $kegiatan->nama_kegiatan }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('kegiatan_id')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="row mb-4 form-section">
                    <div class="col-md-3">
                        <label for="keterangan" class="form-label-custom">Keterangan Kegiatan</label>
                    </div>
                    <div class="col-md-9">
                        <textarea name="keterangan" class="form-control form-control-custom" rows="5" placeholder="Masukkan Keterangan"></textarea>
                    </div>
                </div>

                <div class="row mb-4 form-section">
                    <div class="col-md-3">
                        <label for="tujuan_kegiatan" class="form-label-custom">Tujuan Kegiatan</label>
                    </div>
                    <div class="col-md-9">
                        <textarea name="tujuan_kegiatan" class="form-control form-control-custom" rows="3" placeholder="Masukkan Tujuan Kegiatan"></textarea>
                    </div>
                </div>

                <div class="row mb-4 form-section">
                    <div class="col-md-3">
                        <label for="hasil" class="form-label-custom">Hasil Kegiatan</label>
                    </div>
                    <div class="col-md-9">
                        <textarea name="hasil" class="form-control form-control-custom" rows="3" placeholder="Masukkan Hasil Kegiatan"></textarea>
                    </div>
                </div>

                <div class="row mb-4 form-section">
                    <div class="col-md-3">
                        <label for="evaluasi" class="form-label-custom">Evaluasi</label>
                    </div>
                    <div class="col-md-9">
                        <textarea name="evaluasi" class="form-control form-control-custom" rows="3" placeholder="Masukkan Evaluasi"></textarea>
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
                    <button type="submit" class="btn btn-success-custom">Create Now</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
