<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;
 // default, tidak dipakai karena akan override

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function username()
    {
        return 'username';
    }

    protected function redirectTo()
{
    $user = Auth::user();

    if ($user->hasAnyRole(['Admin', 'Kades'])) {
        return '/home';
    } elseif ($user->hasRole('Pegawai')) {
        return '/frontend/index';
    }
}
protected function sendFailedLoginResponse(Request $request)
{
    return redirect()->back()
        ->withInput($request->only($this->username(), 'remember'))
        ->with('error', 'Username atau password salah.');
}

    
}
