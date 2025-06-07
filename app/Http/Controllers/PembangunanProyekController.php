<?php

namespace App\Http\Controllers;

use App\Models\Jalan;
use App\Models\PembangunanProyek;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PembangunanProyekController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     function __construct()
     {
         $this->middleware('permission:proyek-list|proyek-create|proyek-edit|proyek-delete', ['only' => ['index', 'show']]);
         $this->middleware('permission:proyek-create', ['only' => ['create', 'store']]);
         $this->middleware('permission:proyek-edit', ['only' => ['edit', 'update']]);
         $this->middleware('permission:proyek-delete', ['only' => ['destroy']]);
     }
     public function index(Request $request): View
     {
         $search = $request->input('search');
         $proyeks = PembangunanProyek::with('progresTerbaru') // Eager load
             ->when($search, function ($query, $search) {
                 return $query->where('nama_proyek', 'like', "%{$search}%")
                              ->orWhere('deskripsi_proyek', 'like', "%{$search}%");
             })
             ->latest()
             ->paginate(5);
     
         // Log untuk memeriksa data progres
         foreach ($proyeks as $proyek) {
             \Log::info('Proyek: ' . $proyek->nama_proyek . ' - Progres: ' . ($proyek->progresTerbaru ? $proyek->progresTerbaru->persentase : 'No Progress'));
         }
     
         return view('proyek.index', compact('proyeks'));
     }
     
     
     

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('proyek.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi input
        $request->validate([
            'nama_proyek' => 'required',
            'deskripsi_proyek' => 'required',
            'anggaran' => 'required|numeric',
            'status' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'sumber_dana' => 'required',
            'kontraktor' => 'required',
            'penanggung_jawab' => 'required',
            'lokasi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        // Cek apakah proyek dengan nama yang sama sudah ada
        $existingProyek = PembangunanProyek::where('nama_proyek', $request->nama_proyek)->first();
        
        // Jika sudah ada proyek dengan nama yang sama, redirect dengan pesan error
        if ($existingProyek) {
            return redirect()->route('proyek.index')->with('error', 'Proyek dengan nama tersebut sudah ada.');
        }
        
        // Hitung masa kontrak
        $tanggalMulai = \Carbon\Carbon::parse($request->tanggal_mulai);
        $tanggalSelesai = \Carbon\Carbon::parse($request->tanggal_selesai);
        $masaKontrak = $tanggalMulai->diffInDays($tanggalSelesai) + 1 . ' hari';
    
        $data = $request->only([
            'nama_proyek',
            'deskripsi_proyek',
            'anggaran',
            'status',
            'tanggal_mulai',
            'tanggal_selesai',
            'sumber_dana',
            'kontraktor',
            'penanggung_jawab',
            'lokasi',
        ]);
    
        $data['jenis_proyek'] = $request->jenis_proyek;
        $data['masa_kontrak'] = $masaKontrak;
        
        // Simpan gambar jika ada
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('gambar_proyek', 'public');
        }
    
        // Simpan proyek
        $proyek = PembangunanProyek::create($data);
    
        // Sesuaikan dengan jenis proyek
        if ($request->jenis_proyek === 'jalan') {
            $proyek->proyekJalan()->create([
                'panjang_jalan' => $request->panjang_jalan,
                'lebar_jalan' => $request->lebar_jalan,
                'jenis_permukaan' => $request->jenis_permukaan,
                'kondisi_jalan' => $request->kondisi_jalan,
            ]);
        } elseif ($request->jenis_proyek === 'bangunan') {
            $proyek->proyekBangunan()->create([
                'nama_bangunan' => $request->nama_bangunan,
                'jumlah_lantai' => $request->jumlah_lantai,
                'luas_bangunan' => $request->luas_bangunan,
                'fungsi' => $request->fungsi,
            ]);
        } elseif ($request->jenis_proyek === 'jembatan') {
            $proyek->proyekJembatan()->create([
                'panjang_jembatan' => $request->panjang_jembatan,
                'lebar_jembatan' => $request->lebar_jembatan,
                'kapasitas_beban' => $request->kapasitas_beban,
                'tipe_struktur' => $request->tipe_struktur,
            ]);
        }
    
        return redirect()->route('proyek.index')->with('success', 'Proyek berhasil ditambahkan');
    }
    
    
    /**
     * Display the specified resource.
     */
    public function show(PembangunanProyek $proyek): View
    {// eager load
        return view('proyek.show', compact('proyek'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PembangunanProyek $proyek): View
    {
        return view('proyek.edit',compact('proyek'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        // Validasi inputan dari form
        $request->validate([
            'nama_proyek' => 'required',
            'jenis_proyek' => 'required',
            'deskripsi_proyek' => 'required',
            'anggaran' => 'required|numeric',
            'status' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'sumber_dana' => 'required',
            'kontraktor' => 'required',
            'penanggung_jawab' => 'required',
            'lokasi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        // Menghitung masa kontrak
        $tanggalMulai = Carbon::parse($request->tanggal_mulai);
        $tanggalSelesai = Carbon::parse($request->tanggal_selesai);
        $masaKontrak = $tanggalMulai->diffInDays($tanggalSelesai) + 1 . ' hari';
    
        // Mengambil data dari request
        $data = $request->only([
            'nama_proyek',
            'deskripsi_proyek',
            'anggaran',
            'status',
            'tanggal_mulai',
            'tanggal_selesai',
            'sumber_dana',
            'kontraktor',
            'penanggung_jawab',
            'lokasi',
        ]);

        $data['jenis_proyek'] = $request->jenis_proyek;
        $data['masa_kontrak'] = $masaKontrak;
        
        // Menyimpan gambar jika ada
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('gambar_proyek', 'public');
        }
    
        // Mendapatkan proyek berdasarkan ID
        $proyek = PembangunanProyek::findOrFail($id);
        $oldJenisProyek = $proyek->jenis_proyek;  // Menyimpan jenis proyek lama

        // Jika jenis proyek berubah, hapus data relasi lama
        if ($oldJenisProyek !== $request->jenis_proyek) {
            if ($oldJenisProyek === 'jalan') {
                $proyek->proyekJalan()->delete();
            } elseif ($oldJenisProyek === 'bangunan') {
                $proyek->proyekBangunan()->delete();
            } elseif ($oldJenisProyek === 'jembatan') {
                $proyek->proyekJembatan()->delete();
            }
        }

        $proyek->update($data);
    
        if ($request->jenis_proyek === 'jalan') {
            $proyek->proyekJalan()->create([
                'panjang_jalan' => $request->panjang_jalan,
                'lebar_jalan' => $request->lebar_jalan,
                'jenis_permukaan' => $request->jenis_permukaan,
                'kondisi_jalan' => $request->kondisi_jalan,
            ]);
        } elseif ($request->jenis_proyek === 'bangunan') {
            $proyek->proyekBangunan()->create([
                'nama_bangunan' => $request->nama_bangunan,
                'jumlah_lantai' => $request->jumlah_lantai,
                'luas_bangunan' => $request->luas_bangunan,
                'fungsi' => $request->fungsi,
            ]);
        } elseif ($request->jenis_proyek === 'jembatan') {
            $proyek->proyekJembatan()->create([
                'panjang_jembatan' => $request->panjang_jembatan,
                'lebar_jembatan' => $request->lebar_jembatan,
                'kapasitas_beban' => $request->kapasitas_beban,
                'tipe_struktur' => $request->tipe_struktur,
            ]);
        }
    
        return redirect()->route('proyek.index')->with('primary', 'Proyek berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PembangunanProyek $proyek): RedirectResponse
    {
        $proyek->delete();

        return redirect()->route('proyek.index')->with('danger', 'Proyek berhasil didelete');
    }
}
