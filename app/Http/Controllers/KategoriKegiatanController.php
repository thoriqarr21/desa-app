<?php

namespace App\Http\Controllers;

use App\Models\KategoriKegiatan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

use function Laravel\Prompts\search;

class KategoriKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
     {
         $this->middleware('permission:kategori-list|kategori-create|kategori-edit|kategori-delete', ['only' => ['index', 'show']]);
         $this->middleware('permission:kategori-create', ['only' => ['create', 'store']]);
         $this->middleware('permission:kategori-edit', ['only' => ['edit', 'update']]);
         $this->middleware('permission:kategori-delete', ['only' => ['destroy']]);
     }
     public function index(Request $request)
     {
        $search = $request->input('search');
        $kategoriKegiatans = KategoriKegiatan::when($search, function ($query, $search) {
            return $query->where('nama_kategori', 'like', "%{$search}%")
                        ->orWhere('deskripsi_kategori', 'like', "%{$search}%");
        })
        ->paginate(10);

         return view('kategori_kegiatan.index', compact('kategoriKegiatans'));
     }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('kategori_kegiatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        request()->validate([
            'nama_kategori' => 'required',
            'deskripsi_kategori' => 'required',
        ]);
    
        $existingKategoriKegiatan = kategoriKegiatan::where('nama_kategori', $request->nama_kategori)->first();
    
        // Jika sudah ada KategoriKegiatan, redirect dengan pesan
        if ($existingKategoriKegiatan) {
            return redirect()->route('kategori_kegiatan.index')->with('error', 'Kategori Kegiatan ini sudah di buat.');
        }
        KategoriKegiatan::create($request->all());
    
        return redirect()->route('kategori_kegiatan.index')
                        ->with('success','Kategori Kegiatan created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(KategoriKegiatan $kategoriKegiatan): View
    {
        
        return view('kategori_kegiatan.show',compact('kategoriKegiatan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KategoriKegiatan $kategoriKegiatan): View
    {
        return view('kategori_kegiatan.edit', compact('kategoriKegiatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KategoriKegiatan $kategoriKegiatan): RedirectResponse
    {
        request()->validate([
            'nama_kategori' => 'required',
            'deskripsi_kategori' => 'required',
        ]);

        $kategoriKegiatan->update($request->all());

        return redirect()->route('kategori_kegiatan.index')-> with('primary', 'Kategori Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriKegiatan $kategoriKegiatan): RedirectResponse
    {
        $kategoriKegiatan->delete();
    
        return redirect()->route('kategori_kegiatan.index')
                        ->with('danger','Kategori Kegiatan berhasil dihapus');
    }
}
