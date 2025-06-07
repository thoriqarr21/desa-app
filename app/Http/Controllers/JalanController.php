<?php
    
namespace App\Http\Controllers;
    
use App\Models\Jalan;
use App\Models\ProyekJalan;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
    
class JalanController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:jalan-list|jalan-create|jalan-edit|jalan-delete', ['only' => ['index','show']]);
         $this->middleware('permission:jalan-create', ['only' => ['create','store']]);
         $this->middleware('permission:jalan-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:jalan-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $jalans = ProyekJalan::latest()->paginate(5);

        return view('jalans.index',compact('jalans'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('jalans.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
    
        ProyekJalan::create($request->all());
    
        return redirect()->route('jalans.index')
                        ->with('success','jalan created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProyekJalan  $jalan
     * @return \Illuminate\Http\Response
     */
    public function show(ProyekJalan $jalan): View
    {
        return view('jalans.show',compact('jalan'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProyekJalan $jalan
     * @return \Illuminate\Http\Response
     */
    public function edit(ProyekJalan $jalan): View
    {
        return view('jalans.edit',compact('jalan'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProyekJalan  $jalan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProyekJalan $jalan): RedirectResponse
    {
         request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
    
        $jalan->update($request->all());
    
        return redirect()->route('jalans.index')
                        ->with('success','Jalan updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProyekJalan  $jalan
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProyekJalan $jalan): RedirectResponse
    {
        $jalan->delete();
    
        return redirect()->route('jalans.index')
                        ->with('success','Jalan deleted successfully');
    }
}
