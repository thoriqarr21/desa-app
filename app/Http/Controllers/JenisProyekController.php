<?php

namespace App\Http\Controllers;

use App\Models\ProyekBangunan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JenisProyekController extends Controller
{
    /**
     * Display a listing of the resource.
     */

         function __construct()
     {
         $this->middleware('permission:jenis-list|jenis-create|jenis-edit|jenis-delete', ['only' => ['index', 'show']]);
         $this->middleware('permission:jenis-create', ['only' => ['create', 'store']]);
         $this->middleware('permission:jenis-edit', ['only' => ['edit', 'update']]);
         $this->middleware('permission:jenis-delete', ['only' => ['destroy']]);
     }
    public function index()
    {
        $jenisProyeks = ProyekBangunan::latest()->paginate(5);

        return view('jenis_proyek.index',compact('jenisProyeks'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('jenis_proyek.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        request()->validate([
            'nama_jenis' => 'required',
            'deskripsi_jenis' => 'required',
        ]);
    
        ProyekBangunan::create($request->all());
    
        return redirect()->route('jenis_proyek.index')
                        ->with('success','Jenis Proyek created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProyekBangunan $jenisProyek): View
    {
        return view('jenis_proyek.show',compact('jenisProyek'));
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
    public function destroy(ProyekBangunan $jenisProyeks)
    {
        $jenisProyeks->delete();
    
        return redirect()->route('jenis_proyek.index')
                        ->with('success','Jenis Proyek deleted successfully');
    }
}
