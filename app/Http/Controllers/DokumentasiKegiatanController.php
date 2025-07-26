<?php

namespace App\Http\Controllers;

use App\Models\DokumentasiKegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DokumentasiKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'laporan_id'   => 'required|exists:laporan_proyeks,id',
            'file_path'    => 'required|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:10240', // max 10MB
        ]);

        // Simpan file gambar
        $file = $request->file('file_path');
        $filePath = $file->store('dokumentasi', 'public');
        
        // Tentukan tipe file
        $mime = $file->getMimeType();
        $fileType = str_contains($mime, 'video') ? 'video' : 'image';
        
        // Simpan dokumentasi
        DokumentasiKegiatan::create([
            'laporan_id'    => $request->laporan_id,
            'file_path'     => $filePath,
            'file_type'     => $fileType, // <- tambahan
        ]);
        return redirect()->back()->with('success', 'Dokumentasi berhasil ditambahkan.');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'laporan_id'   => 'required|exists:laporan_proyeks,id',
            'file_path'    => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:10240', // opsional, max 10MB
        ]);
    
        $dokumentasi = DokumentasiKegiatan::findOrFail($id);
    
        // Cek apakah ada file baru di-upload
        if ($request->hasFile('file_path')) {
            // Hapus file lama jika ada
            if ($dokumentasi->file_path && \Storage::disk('public')->exists($dokumentasi->file_path)) {
                \Storage::disk('public')->delete($dokumentasi->file_path);
            }
    
            // Simpan file baru
            $file = $request->file('file_path');
            $filePath = $file->store('dokumentasi', 'public');
    
            // Tentukan tipe file
            $mime = $file->getMimeType();
            $fileType = str_contains($mime, 'video') ? 'video' : 'image';
    
            // Update path dan tipe file
            $dokumentasi->file_path = $filePath;
            $dokumentasi->file_type = $fileType;
        }
    
        // Update data lainnya
        $dokumentasi->laporan_id = $request->laporan_id;
        $dokumentasi->save();
    
        return redirect()->back()->with('success', 'Dokumentasi berhasil diperbarui.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(string $id)
    // {
    //     $dokumentasi = DokumentasiKegiatan::findOrFail($id);
    
    //     // Hapus file dari penyimpanan
    //     if (Storage::disk('public')->exists($dokumentasi->file_path)) {
    //         Storage::disk('public')->delete($dokumentasi->file_path);
    //     }
    
    //     // Hapus data dari database
    //     $dokumentasi->delete();
    
    //     return back()->with('success', 'Dokumentasi berhasil dihapus.');
    // }
    }
