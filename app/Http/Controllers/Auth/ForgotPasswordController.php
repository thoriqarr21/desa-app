<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;


    public function showUsernameForm()
    {
        return view('auth.forgot_password_username');
    }

    public function checkUsername(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
        ]);
    
        $user = User::where('username', $request->username)->first();
    
        if (!$user) {
            return back()->with('error', 'Username tidak ditemukan.');
        }
    
        // Redirect ke halaman reset password dengan username sebagai parameter
        return redirect()->route('password.reset.form', ['username' => $user->username]);
    }
    

    public function showChangeForm($username)
    {
        return view('auth.reset_password_username', compact('username'));
    }

    public function updatePassword(Request $request, $username)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);
    
        $user = User::where('username', $username)->firstOrFail();
    
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah.']);
        }
    
        $user->password = Hash::make($request->new_password);
        $user->save();
    
        // Setelah sukses, redirect ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Password berhasil diperbarui, silakan login.');
    }
    
}
