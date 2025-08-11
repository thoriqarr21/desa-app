<?php

namespace App\Http\Controllers;

use App\Models\DesaKegiatan;
use App\Models\KategoriKegiatan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DesaKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function __construct()
     {
         $this->middleware('permission:kegiatan-list|kegiatan-create|kegiatan-edit|kegiatan-delete', ['only' => ['index', 'show']]);
         $this->middleware('permission:kegiatan-create', ['only' => ['create', 'store']]);
         $this->middleware('permission:kegiatan-edit', ['only' => ['edit', 'update']]);
         $this->middleware('permission:kegiatan-delete', ['only' => ['destroy']]);
     }
     public function index(Request $request): View
{
    // $user = Auth::user();
    $search = $request->input('search');
    $bulan = $request->input('bulan');
    $kategori = $request->input('kategori');
    $kegiatans = DesaKegiatan::when($search, function ($query, $search) {
                    return $query->where('nama_kegiatan', 'like', "%{$search}%")
                                 ->orWhere('deskripsi_kegiatan', 'like', "%{$search}%");
                })
                // ->where('user_id', $user->id) 
                ->when($bulan, function ($query, $bulan) {
                    return $query->whereMonth('tanggal_mulai', $bulan);
                })
                ->when($kategori, function ($query) use ($kategori) {
                    return $query->whereHas('kategoriKegiatan', function ($q2) use ($kategori) {
                            $q2->where('id', $kategori);
                        });
                })
                ->orderByDesc('created_at')
                ->paginate(5)
                ->appends($request->all());

                $kategoriList = KategoriKegiatan::orderBy('nama_kategori')
                ->pluck('nama_kategori', 'id');

    // Mengirimkan data ke view
    return view('kegiatan.index', compact('kegiatans', 'bulan', 'kategori', 'kategoriList'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $kategoriKegiatans = KategoriKegiatan::all();
        return view('kegiatan.create', compact('kategoriKegiatans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'nama_kegiatan' => 'required',
        'deskripsi_kegiatan' => 'required',
        'tanggal_mulai' => 'required|date',
        'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        'waktu_mulai' => 'required',
        'waktu_selesai' => 'required',
        'lokasi' => 'required',
        'gambar' => 'required|image|mimes:jpeg,png,jpg|max:10240',
    ]);

    $existingKegiatan = DesaKegiatan::where('nama_kegiatan', $request->nama_kegiatan)->first();
    
    if ($existingKegiatan) {
        return redirect()->route('kegiatan.index')->with('error', 'Kegiatan ini sudah dibuat.');
    }

    $tanggalMulai = \Carbon\Carbon::parse($request->tanggal_mulai);
    $tanggalSelesai = \Carbon\Carbon::parse($request->tanggal_selesai);
    $lamaHari = $tanggalMulai->diffInDays($tanggalSelesai) + 1 . ' hari';

    $data = $request->only([
        'nama_kegiatan',
        'deskripsi_kegiatan',
        'kategori_id',           
        'tanggal_mulai',
        'tanggal_selesai',  
        'waktu_mulai',
        'waktu_selesai',
        'lokasi',
    ]);

    $data['user_id'] = Auth::id();
    $data['lama_hari'] = $lamaHari;
    $data['status'] = 'Berjalan'; 

    if ($request->hasFile('gambar')) {
        $data['gambar'] = $request->file('gambar')->store('gambar_kegiatan', 'public');
    }

    DesaKegiatan::create($data);

    return redirect()->route('kegiatan.index')
        ->with('success', 'Kegiatan berhasil ditambahkan.');
}


    /**
     * Display the specified resource.
     */
    public function show(DesaKegiatan $kegiatan): View
    {
        Carbon::setLocale('id');
        return view('kegiatan.show', compact('kegiatan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DesaKegiatan $kegiatan): View
    {
        $kategoriKegiatans = KategoriKegiatan::all();
        return view('kegiatan.edit', compact('kegiatan', 'kategoriKegiatans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'nama_kegiatan' => 'required',
            'deskripsi_kegiatan' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'status' => 'required',
            'lokasi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
        ]);
        $tanggalMulai = \Carbon\Carbon::parse($request->tanggal_mulai);
        $tanggalSelesai = \Carbon\Carbon::parse($request->tanggal_selesai);
        // $lamaHari = $tanggalMulai->diffInDays($tanggalSelesai) . ' hari';
        $lamaHari = $tanggalMulai->diffInDays($tanggalSelesai) + 1 . ' hari';


        $data = $request->only([
            'nama_kegiatan',
            'deskripsi_kegiatan',
            'kategori_id',           
            'user_id',
            'tanggal_mulai',
            'tanggal_selesai',  
            'waktu_mulai',
            'waktu_selesai', 
            'lokasi',
            'status', 
        ]);        

        $data['lama_hari'] = $lamaHari;

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('gambar_kegiatan', 'public');
        }

        $kegiatan = DesaKegiatan::findOrFail($id);
        $kegiatan->update($data);

        return redirect()->route('kegiatan.index')->with('primary', 'Kegiatan berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DesaKegiatan $kegiatan): RedirectResponse
    {
        $kegiatan->delete();

        return redirect()->route('kegiatan.index')->with('danger', 'Kegiatan berhasil dihapus');
    }
}
