<?php

namespace App\Http\Controllers;

use App\Models\DokumentasiProyek;
use App\Models\LaporanProyek;
use App\Models\PembangunanProyek;
use App\Models\ProgresPembangunan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DokumentasiProyekController extends Controller
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
    public function create($laporan_id)
    {
        $laporan = LaporanProyek::findOrFail($laporan_id);
        return view('dokumentasi.create', compact('laporan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'laporan_id'   => 'required|exists:laporan_proyeks,id',
            'persentase'  => 'required|integer|min:0|max:100',
            'file_path'    => 'required|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:10240', // max 10MB
            'keterangan'  => 'required|string|max:255',
        ]);

        // Cari atau buat progres berdasarkan persentase dan proyek
        $progres = ProgresPembangunan::firstOrCreate(
            [
                'laporan_id'   => $request->laporan_id,
                'persentase'  => $request->persentase,
            ],
            [
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Simpan file gambar
        $file = $request->file('file_path');
        $filePath = $file->store('dokumentasi', 'public');
        
        // Tentukan tipe file
        $mime = $file->getMimeType();
        $fileType = str_contains($mime, 'video') ? 'video' : 'image';
        
        // Simpan dokumentasi
        DokumentasiProyek::create([
            'laporan_id'    => $request->laporan_id,
            'progres_id'    => $progres->id,
            'file_path'     => $filePath,
            'file_type'     => $fileType, // <- tambahan
            'keterangan'    => $request->keterangan,
            'persentase'    => $request->persentase,
        ]);
        return redirect()->back()->with('success', 'Dokumentasi berhasil ditambahkan.');
    }

    
    public function storeTambahan(Request $request)
    {
        $request->validate([
            'laporan_id' => 'required|exists:laporan_proyeks,id',
            'persentase' => 'required|numeric|min:0|max:100',
            'file_path' => 'required|array|max:3',
            'file_path.*' => 'file|mimes:jpg,jpeg,png,mp4,mov,avi|max:10240',
            'keterangan' => 'nullable|string',
        ]);
    
        // Ambil atau buat progres sesuai persentase
        $progres = ProgresPembangunan::firstOrCreate(
            [
                'laporan_id' => $request->laporan_id,
                'persentase' => $request->persentase,
            ]
        );
    
        // Simpan setiap file
        foreach ($request->file('file_path') as $file) {
            $path = $file->store('dokumentasi', 'public');
    
            DokumentasiProyek::create([
                'laporan_id' => $request->laporan_id,
                'progres_id' => $progres->id,
                'file_path' => $path,
                'keterangan' => $request->keterangan,
                'persentase' => $request->persentase,
            ]);
        }
    
        // Cek jika persentase 100%, ubah status proyek jadi 'selesai'
        if ((int) $request->persentase === 100) {
            $laporan = LaporanProyek::with('proyek')->findOrFail($request->laporan_id);
    
            if ($laporan->proyek && $laporan->proyek->status !== 'selesai') {
                $laporan->proyek->update([
                    'status' => 'selesai',
                ]);
            }
        }
    
        return back()->with('success', 'Dokumentasi tambahan berhasil ditambahkan!');
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dokumentasi = DokumentasiProyek::findOrFail($id);
    
        $laporanId = $dokumentasi->laporan_id;
        $persentase = $dokumentasi->persentase;
        $progresId = $dokumentasi->progres_id;
    
        // Hapus file dari penyimpanan
        if (Storage::disk('public')->exists($dokumentasi->file_path)) {
            Storage::disk('public')->delete($dokumentasi->file_path);
        }
    
        // Hapus dokumentasi dari database
        $dokumentasi->delete();
    
        // Cek apakah masih ada dokumentasi lain untuk progres ini
        $sisaDokumentasi = DokumentasiProyek::where('progres_id', $progresId)->count();
    
        if ($sisaDokumentasi === 0) {
            // Jika tidak ada dokumentasi tersisa, hapus progres
            $progres = ProgresPembangunan::find($progresId);
            if ($progres) {
                $progres->delete();
            }
    
            // Jika progres 100% dihapus, ubah status proyek jadi "berjalan"
            if ((int) $persentase === 100) {
                $laporan = LaporanProyek::with('proyek')->find($laporanId);
                if ($laporan && $laporan->proyek) {
                    $laporan->proyek->update([
                        'status' => 'berjalan',
                    ]);
                }
            }
        }
    
        return back()->with('danger', 'Dokumentasi berhasil dihapus.');
    }
    
    public function destroyTambahanBerdasarkanPersen(Request $request)
    {
        $request->validate([
            'laporan_id' => 'required|exists:laporan_proyeks,id',
            'persentase' => 'required|numeric|min:0|max:100',
        ]);
    
        // Ambil semua dokumentasi berdasarkan laporan dan persentase
        $dokumentasiList = DokumentasiProyek::where('laporan_id', $request->laporan_id)
            ->where('persentase', $request->persentase)
            ->get();
    
        if ($dokumentasiList->isEmpty()) {
            return back()->with('error', 'Tidak ditemukan dokumentasi pada progres ' . $request->persentase . '%.');
        }
    
        // Hapus semua file dan data dokumentasi
        foreach ($dokumentasiList as $dokumentasi) {
            if (Storage::disk('public')->exists($dokumentasi->file_path)) {
                Storage::disk('public')->delete($dokumentasi->file_path);
            }
            $dokumentasi->delete();
        }
    
        // Cari dan hapus progres jika tidak digunakan lagi
        $progres = ProgresPembangunan::where('laporan_id', $request->laporan_id)
            ->where('persentase', $request->persentase)
            ->first();
    
        if ($progres) {
            $masihDigunakan = DokumentasiProyek::where('progres_id', $progres->id)->exists();
            if (!$masihDigunakan) {
                $progres->delete();
            }
        }
    
        // Jika yang dihapus adalah progres 100%, ubah status proyek jadi "berjalan" lagi
        if ((int) $request->persentase === 100) {
            $laporan = LaporanProyek::with('proyek')->findOrFail($request->laporan_id);
    
            if ($laporan->proyek) {
                $laporan->proyek->update([
                    'status' => 'berjalan',
                ]);
            }
        }
    
        return redirect()->back()->with('success', 'Dokumentasi berhasil dihapus.');
    }

}
