<?php

namespace App\Http\Controllers;

use App\Models\DesaKegiatan;
use App\Models\KategoriKegiatan;
use App\Models\LaporanProyek;
use Illuminate\Http\Request;

class FrontController extends Controller
{

    public function kategoriIndex() {
        $kategoriKegiatans = KategoriKegiatan::paginate(5); // Pagination 5 per halaman
        return view('frontend.kategori_kegiatan.index', compact('kategoriKegiatans'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function kategoriCreate() {
        return view('frontend.kategori_kegiatan.create');
    }

    public function kategoriStore(Request $request) {
        $request->validate(['nama_kategori' => 'required|string|max:255']);
        KategoriKegiatan::create($request->all());
        return redirect()->route('frontend.kategori_kegiatan.index')->with('success', 'Kategori ditambahkan.');
    }

    public function kegiatanIndex() {
        $data = DesaKegiatan::all();
        return view('frontend.kegiatan.index', compact('data'));
    }

    public function kegiatanCreate() {
        $kategori = KategoriKegiatan::all();
        return view('frontend.kegiatan.create', compact('kategori'));
    }

    public function kegiatanStore(Request $request) {
        $request->validate([
            'nama_kegiatan' => 'required',
            'kategori_kegiatan_id' => 'required',
            // tambahkan validasi lainnya jika ada
        ]);
        DesaKegiatan::create($request->all());
        return redirect()->route('frontend.kegiatan.index')->with('success', 'Kegiatan ditambahkan.');
    }

    public function laporanIndex() {
        $laporan = LaporanProyek::all();
        return view('frontend.laporan.index', compact('laporan'));
    }

    public function laporanCreate() {
        return view('frontend.laporan.create');
    }

    public function laporanStore(Request $request) {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            // tambahkan validasi sesuai kebutuhan
        ]);
        LaporanProyek::create($request->all());
        return redirect()->route('frontend.laporan.index')->with('success', 'Laporan disimpan.');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
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
        //
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
        //
    }
}
