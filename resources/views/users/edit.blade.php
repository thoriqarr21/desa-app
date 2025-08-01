@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Update User</h5>
                    <div class="d-flex align-items-center ms-3 ">
                        <a class="btn btn-primary btn-sm fs-6 " href="{{ route('users.index') }}"><i class="fas fa-reply fs-6"></i> Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    @php
                        // Field khusus per jenis proyek
                        $jenis = old('jenis_proyek');
                
                        $fieldPerJenis = match($jenis) {
                            'jalan' => ['panjang_jalan', 'lebar_jalan', 'kondisi_jalan'],
                            'bangunan' => ['luas_bangunan', 'jumlah_lantai', 'fungsi_bangunan'],
                            'jembatan' => ['panjang_jembatan', 'lebar_jembatan', 'kapasitas_beban', 'tipe_struktur'],
                            default => [],
                        };
                
                        // Pisahkan error umum (semua field yang tidak termasuk fieldPerJenis)
                        $filtered = collect($errors->getMessages())
                            ->filter(function($value, $key) use ($fieldPerJenis) {
                                return !in_array($key, ['panjang_jalan', 'lebar_jalan', 'kondisi_jalan', 'luas_bangunan', 'jumlah_lantai', 'fungsi_bangunan', 'panjang_jembatan', 'lebar_jembatan', 'kapasitas_beban', 'tipe_struktur']) // semua field khusus
                                    || in_array($key, $fieldPerJenis); // hanya tampilkan yang sesuai jenis
                            });
                
                        $finalErrors = $filtered->flatten(); // gabung array nested
                    @endphp
                
                    @if ($finalErrors->isNotEmpty())
                        <div class="alert alert-danger" id="alertError">
                            <strong>Terjadi kesalahan!</strong> Silakan periksa inputan Anda:
                            <ul class="mb-0 mt-2">
                                @foreach ($finalErrors as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                @endif
                

                    <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="gambar">Ganti Gambar (biarkan kosong jika tidak diganti)</label><br>
                            @if ($user->gambar)
                                <img src="{{ asset('storage/' . $user->gambar) }}" alt="Foto User" width="100" class="mb-2"><br>
                            @endif
                            <input type="file" name="gambar" class="form-control">
                            @error('gambar')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label"><strong>Name:</strong></label>
                            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label"><strong>Username:</strong></label>
                            <input type="text" name="username" class="form-control" value="{{ $user->username }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label"><strong>Password:</strong></label>
                            <input type="password" name="password" class="form-control" placeholder="Masukkan Password Baru">
                        </div>

                        <div class="mb-3">
                            <label for="confirm-password" class="form-label"><strong>Confirm Password:</strong></label>
                            <input type="password" name="confirm-password" class="form-control" placeholder="Masukkan Password Sesuai di Atas">
                        </div>

                        <div class="mb-3">
                            <label for="roles" class="form-label"><strong>Role:</strong></label>
                            <select name="roles[]" class="form-control" required>
                                @foreach ($roles as $value => $label)
                                    <option value="{{ $value }}" {{ isset($userRole[$value]) ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success">
                                <i class="fa-solid fa-floppy-disk"></i> Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
