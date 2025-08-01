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
        $bulan = $request->input('bulan');
        $status = $request->input('status');
        $persentase = $request->input('persentase');
    
        // Update status proyek berdasarkan progres terbaru
        $semuaProyek = PembangunanProyek::with('semuaProgres')->get();
    
        foreach ($semuaProyek as $proyek) {
            if ($proyek->status === 'batal') continue;
    
            $maxPersentase = $proyek->semuaProgres->max('persentase') ?? 0;
    
            if ($maxPersentase == 100 && $proyek->status !== 'selesai') {
                $proyek->status = 'selesai';
                $proyek->save();
            } elseif ($maxPersentase < 100 && $proyek->status !== 'berjalan') {
                $proyek->status = 'berjalan';
                $proyek->save();
            }
        }
    
        // Ambil data proyek dengan filter
        $proyeks = PembangunanProyek::query()
            ->with(['progresTerbaru'])
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('nama_proyek', 'like', "%{$search}%")
                      ->orWhere('deskripsi_proyek', 'like', "%{$search}%");
                });
            })
            ->when($bulan, fn($q) => $q->whereMonth('tanggal_mulai', $bulan))
            ->when($status, fn($q) => $q->where('status', $status))
            ->when($persentase !== null, function ($query) use ($persentase) {
                $query->where(function ($q) use ($persentase) {
                    $q->whereRaw("
                        IFNULL((
                            SELECT pp.persentase
                            FROM laporan_proyeks lp
                            LEFT JOIN progres_pembangunans pp ON pp.laporan_id = lp.id
                            WHERE lp.proyek_id = pembangunan_proyeks.id
                            ORDER BY pp.id DESC
                            LIMIT 1
                        ), 0) = ?
                    ", [$persentase]);
                });
            })
            
            ->orderByDesc('created_at')
            ->paginate(5)
            ->appends($request->all());
    
        return view('proyek.index', compact('proyeks', 'bulan', 'status', 'persentase'));
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
            'anggaran' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'sumber_dana' => 'required',
            'kontraktor' => 'required',
            'penanggung_jawab' => 'required',
            'lokasi' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'jenis_proyek' => 'required|in:jalan,bangunan,jembatan',
        
            // Validasi proyek jalan
            'panjang_jalan' => 'nullable|required_if:jenis_proyek,jalan|numeric',
            'lebar_jalan' => 'nullable|required_if:jenis_proyek,jalan|numeric',
            'jenis_permukaan' => 'nullable|required_if:jenis_proyek,jalan',
            'kondisi_jalan' => 'nullable|required_if:jenis_proyek,jalan',
        
            // Validasi proyek bangunan
            'nama_bangunan' => 'nullable|required_if:jenis_proyek,bangunan',
            'jumlah_lantai' => 'nullable|required_if:jenis_proyek,bangunan|numeric',
            'luas_bangunan' => 'nullable|required_if:jenis_proyek,bangunan|numeric',
            'fungsi' => 'nullable|required_if:jenis_proyek,bangunan',
        
            // Validasi proyek jembatan
            'panjang_jembatan' => 'nullable|required_if:jenis_proyek,jembatan|numeric',
            'lebar_jembatan' => 'nullable|required_if:jenis_proyek,jembatan|numeric',
            'kapasitas_beban' => 'nullable|required_if:jenis_proyek,jembatan|numeric',
            'tipe_struktur' => 'nullable|required_if:jenis_proyek,jembatan',
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
            'tanggal_mulai',
            'tanggal_selesai',
            'sumber_dana',
            'kontraktor',
            'penanggung_jawab',
            'lokasi',
        ]);
        $data['anggaran'] = (float) str_replace(['Rp', '.', ' ', ','], '', $request->anggaran);
        $data['jenis_proyek'] = $request->jenis_proyek;
        $data['masa_kontrak'] = $masaKontrak;
        $data['status'] = 'Berjalan';
        
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
            'nama_proyek' => 'required|string|max:255',
            'jenis_proyek' => 'required|in:jalan,bangunan,jembatan', // Pastikan jenis proyek valid
            'deskripsi_proyek' => 'required|string',
            'anggaran' => 'required|numeric|min:0',
            'status' => 'required|in:batal,berjalan,selesai',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'sumber_dana' => 'required|string|max:255',
            'kontraktor' => 'required|string|max:255',
            'penanggung_jawab' => 'required|string|max:255',
            'lokasi' => 'required|string', // Lokasi bisa berupa string koordinat

            // Validasi untuk gambar (opsional)
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',

            // --- Validasi Spesifik Jenis Proyek ---

            // Validasi untuk Proyek Jalan
            'panjang_jalan' => 'required_if:jenis_proyek,jalan|nullable|numeric|min:0',
            'lebar_jalan' => 'required_if:jenis_proyek,jalan|nullable|numeric|min:0',
            'jenis_permukaan' => 'required_if:jenis_proyek,jalan|nullable|string|max:255',
            'kondisi_jalan' => 'required_if:jenis_proyek,jalan|nullable|string|max:255',

            // Validasi untuk Proyek Bangunan
            'nama_bangunan' => 'required_if:jenis_proyek,bangunan|nullable|string|max:255',
            'jumlah_lantai' => 'required_if:jenis_proyek,bangunan|nullable|integer|min:1',
            'luas_bangunan' => 'required_if:jenis_proyek,bangunan|nullable|numeric|min:0',
            'fungsi' => 'required_if:jenis_proyek,bangunan|nullable|string|max:255',

            // Validasi untuk Proyek Jembatan
            'panjang_jembatan' => 'required_if:jenis_proyek,jembatan|nullable|numeric|min:0',
            'lebar_jembatan' => 'required_if:jenis_proyek,jembatan|nullable|numeric|min:0',
            'kapasitas_beban' => 'required_if:jenis_proyek,jembatan|nullable|numeric|min:0',
            'tipe_struktur' => 'required_if:jenis_proyek,jembatan|nullable|string|max:255',
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
        
        // Mendapatkan proyek berdasarkan ID
        $proyek = PembangunanProyek::findOrFail($id);
        $oldJenisProyek = $proyek->jenis_proyek; // Menyimpan jenis proyek lama
        
        // Menyimpan gambar jika ada
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('gambar_proyek', 'public');
        }

        // Update record proyek utama
        $proyek->update($data);
        
        // Tangani detail proyek terkait berdasarkan jenis_proyek
        if ($oldJenisProyek !== $request->jenis_proyek) {
            // Jika jenis proyek berubah, hapus data relasi lama
            if ($oldJenisProyek === 'jalan' && $proyek->proyekJalan) {
                $proyek->proyekJalan->delete();
            } elseif ($oldJenisProyek === 'bangunan' && $proyek->proyekBangunan) {
                $proyek->proyekBangunan->delete();
            } elseif ($oldJenisProyek === 'jembatan' && $proyek->proyekJembatan) {
                $proyek->proyekJembatan->delete();
            }
            
            // Sekarang buat record relasi baru berdasarkan jenis baru
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
        } else {
            // Jika jenis proyek TIDAK berubah, update data relasi yang sudah ada
            if ($request->jenis_proyek === 'jalan') {
                $proyek->proyekJalan()->update([
                    'panjang_jalan' => $request->panjang_jalan,
                    'lebar_jalan' => $request->lebar_jalan,
                    'jenis_permukaan' => $request->jenis_permukaan,
                    'kondisi_jalan' => $request->kondisi_jalan,
                ]);
            } elseif ($request->jenis_proyek === 'bangunan') {
                $proyek->proyekBangunan()->update([
                    'nama_bangunan' => $request->nama_bangunan,
                    'jumlah_lantai' => $request->jumlah_lantai,
                    'luas_bangunan' => $request->luas_bangunan,
                    'fungsi' => $request->fungsi,
                ]);
            } elseif ($request->jenis_proyek === 'jembatan') {
                $proyek->proyekJembatan()->update([
                    'panjang_jembatan' => $request->panjang_jembatan,
                    'lebar_jembatan' => $request->lebar_jembatan,
                    'kapasitas_beban' => $request->kapasitas_beban,
                    'tipe_struktur' => $request->tipe_struktur,
                ]);
            }
        }
        
        return redirect()->route('proyek.index')->with('primary', 'Proyek berhasil di update');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PembangunanProyek $proyek): RedirectResponse
    {
        $proyek->delete();

        return redirect()->route('proyek.index')->with('danger', 'Proyek berhasil dihapus');
    }
}
