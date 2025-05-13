<?php

namespace App\Http\Controllers;

use App\Models\DesaKegiatan;
use App\Models\LaporanKegiatan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LaporanKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function __construct()
     {
         $this->middleware('permission:laporankegiatan-list|laporankegiatan-create|laporankegiatan-edit|laporankegiatan-delete', ['only' => ['index', 'show']]);
         $this->middleware('permission:laporankegiatan-create', ['only' => ['create', 'store']]);
         $this->middleware('permission:laporankegiatan-edit', ['only' => ['edit', 'update']]);
         $this->middleware('permission:laporankegiatan-delete', ['only' => ['destroy']]);
     }
    public function index(Request $request): View
    {
        $search = $request->input('search');
        $laporan = LaporanKegiatan::when($search, function ($query, $search) {
                            return $query->where('nama_kegiatan', 'like', "%{$search}%")
                                         ->orWhere('deskripsi_kegiatan', 'like', "%{$search}%");
                        })
                        ->paginate(10);
    
        // Mengirimkan data ke view
        return view('laporan_kegiatan.index', compact('laporan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $kegiatans = DesaKegiatan::all();
        return view('laporan_kegiatan.create', compact('kegiatans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'keterangan'=> 'required',
            'hasil'=> 'required',
            'tujuan_kegiatan'=> 'required',
            'evaluasi'=> 'required',
            'kegiatan_id' => 'required|exists:desa_kegiatans,id',
            'dokumentasi.*' => 'file|mimes:jpeg,png,jpg,mp4,mov,avi|max:10240', // max 10MB
        ]);
        
        $existingLaporan = LaporanKegiatan::where('kegiatan_id', $request->kegiatan_id)->first();
    
        // Jika sudah ada laporan, redirect dengan pesan
        if ($existingLaporan) {
            return redirect()->route('laporan_kegiatan.index')->with('error', 'Kegiatan ini sudah memiliki laporan.');
        }
    
        // Jika belum ada laporan, lanjutkan untuk menyimpan laporan baru
        $laporan = LaporanKegiatan::create([
            'kegiatan_id' => $request->kegiatan_id,
            'hasil' => $request->hasil,
            'tujuan_kegiatan' => $request->tujuan_kegiatan,
            'evaluasi' => $request->evaluasi,
            'user_id' => Auth::id(),
            'keterangan' => $request->keterangan,
            'is_approved' => null,
        ]);
    
        if ($request->hasFile('dokumentasi')) {
            foreach ($request->file('dokumentasi') as $file) {
                $path = $file->store('dokumentasi', 'public');
    
                $mime = $file->getMimeType();
                $fileType = str_contains($mime, 'video') ? 'video' : 'image';
    
                $laporan->dokumentasi()->create([
                    'file_path'   => $path,
                    'file_type'   => $fileType,
                ]);
            }
        }
    
        return redirect()->route('laporan_kegiatan.index')->with('success', 'Laporan berhasil dikirim.');
    }

    
    /**
     * Display the specified resource.
     */
    public function show(LaporanKegiatan $laporanKegiatan): View
    {
        $laporanKegiatan->load('dokumentasi');
        return view('laporan_kegiatan.show', compact('laporanKegiatan'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LaporanKegiatan $laporanKegiatan): View
    {
        $kegiatan = DesaKegiatan::all();
        return view('laporan_kegiatan.edit', compact('laporanKegiatan', 'kegiatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'keterangan'=> 'required',
            'hasil'=> 'required',
            'tujuan_kegiatan'=> 'required',
            'evaluasi'=> 'required',
            'kegiatan_id' => 'required|exists:desa_kegiatans,id',
            'dokumentasi.*' => 'file|mimes:jpeg,png,jpg,mp4,mov,avi|max:10240', // max 10MB
        ]);
    
        // Mencari laporan berdasarkan ID
        $laporan = LaporanKegiatan::findOrFail($id);
        
        // Memperbarui data laporan
        $laporan->update([
            'laporan_id' => $request->laporan_id,
            'keterangan' => $request->keterangan,
            'hasil' => $request->hasil,
            'tujuan_kegiatan' => $request->tujuan_kegiatan,
            'evaluasi' => $request->evaluasi,
            'user_id' => Auth::id(),
            'is_approved' => null,
        ]);
    
        // Mencari progres yang terkait dengan laporan
    
        // Mengupdate dokumentasi jika ada file baru
        if ($request->hasFile('dokumentasi')) {
            // Hapus semua dokumentasi yang ada sebelumnya
            $laporan->dokumentasi()->delete();
    
            // Menambahkan file baru
            foreach ($request->file('dokumentasi') as $file) {
                $path = $file->store('dokumentasi', 'public');
    
                // Deteksi jenis file: image atau video
                $mime = $file->getMimeType();
                $fileType = str_contains($mime, 'video') ? 'video' : 'image';
    
                $laporan->dokumentasi()->create([
                    'laporan_id' => $laporan->id,
                    'file_path' => $path,
                    'file_type' => $fileType, // Menyimpan jenis file
                ]);
            }
        }
    
        return redirect()->route('laporan_kegiatan.index')->with('success', 'Laporan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $laporan = LaporanKegiatan::findOrFail($id);

    // Hapus dokumentasi terkait dan file fisiknya
    foreach ($laporan->dokumentasi as $dok) {
        if ($dok->file_path && \Storage::disk('public')->exists($dok->file_path)) {
            \Storage::disk('public')->delete($dok->file_path);
        }
        $dok->delete();
    }

    // Hapus laporan
    $laporan->delete();

    return redirect()->route('laporan_kegiatan.index')
                     ->with('success', 'Laporan dan dokumentasinya berhasil dihapus.');
}

public function approve(LaporanKegiatan $laporanKegiatan): View
{
    return view('laporan_kegiatan.approve', compact('laporanKegiatan'));
}

/**
 * Memperbarui status approval laporan kegiatan.
 */
public function approveaction(Request $request, LaporanKegiatan $laporanKegiatan): RedirectResponse
{
    $request->validate([
        'is_approved' => 'nullable|boolean',
        'keterangan_tolak' => 'nullable|string'
    ]);

    $laporanKegiatan->update([
        'is_approved' => $request->is_approved,
        'keterangan_tolak' => $request->is_approved ? null : $request->keterangan_tolak
    ]);

    return redirect()->route('laporan_kegiatan.index')->with('success', 'Laporan berhasil diperbarui.');
}
public function cetak($id)
{
    $laporanKegiatan = LaporanKegiatan::with(['kegiatan', 'user', 'dokumentasi.laporan'])->findOrFail($id);

    $pdf = Pdf::loadView('laporan_kegiatan.pdf', compact('laporanKegiatan'));
    return $pdf->stream('laporan-kegiatan-'.$laporanKegiatan->kegiatan->nama_kegiatan.'.pdf');
}

}
