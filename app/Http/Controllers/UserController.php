<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use DB;
// use Hash;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
    
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     function __construct()
     {
          $this->middleware('permission:user-list|user-create|user-edit|user-delete|user-show', ['only' => ['index','store']]);
          $this->middleware('permission:user-create', ['only' => ['create','store']]);
          $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
          $this->middleware('permission:user-delete', ['only' => ['destroy']]);
          $this->middleware('permission:user-show', ['only' => ['show']]);
     }
    public function index(Request $request): View
    {
        $query = User::query();

        if ($request->filled('role')) {
            $query->whereHas('roles', function ($q) use ($request) {
                $q->where('name', $request->role);
            });
        }
        
    
        $data = $query->paginate(5);
    
        return view('users.index', compact('data'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $roles = Role::pluck('name','name')->all();

        return view('users.create',compact('roles'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required',
            'password' => 'required|same:confirm-password',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'roles' => 'required'
        ]);
    
        $existingUser = User::where('username', $request->username)->first();
    
        if ($existingUser) {
            return redirect()->route('users.index')->with('error', 'User ini sudah dibuat.');
        }
    
        $input = $request->all();
        $input['password'] = \Illuminate\Support\Facades\Hash::make($input['password']);
    
        if ($request->hasFile('gambar')) {
            $input['gambar'] = $request->file('gambar')->store('users', 'public');
        }
    
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')
                        ->with('success', 'User berhasil dibuat.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
        $user = User::find($id);

        return view('users.show',compact('user'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('users.edit',compact('user','roles','userRole'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required|unique:users,username,'.$id,
            'password' => 'same:confirm-password',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = \Illuminate\Support\Facades\Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        
        if ($request->hasFile('gambar')) {
            $input = $request->file('gambar')->store('users', 'public');
        }

        $user = User::find($id);
        $user->update($input);
        \Illuminate\Support\Facades\DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }

    public function profile(): View
{
    $user = Auth::user();
    return view('users.profile', compact('user'));
}

public function updatePassword(Request $request): RedirectResponse
{
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:6|confirmed',
    ]);

    

    $user = Auth::user();

    if (!Hash::check($request->current_password, $user->password)) {
        return back()->withErrors(['current_password' => 'Password saat ini salah.']);
    }

    $user->password = Hash::make($request->new_password);
    $user->save(); 
    return back()->with('success', 'Password berhasil diperbarui.');
}
}
