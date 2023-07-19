<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function login_post(Request $request)
    {

{
    $request->validate([
        'username' => 'required',
        'password' => 'required',
    ],
[
    'username.required' => 'username ini wajib diisi',
    'password.required' => 'password ini wajib diisi',
]);

    if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
        // Auth::attempt akan mencoba untuk mengotentikasi pengguna dengan data yang diberikan.
        // Jika berhasil, pengguna akan dianggap telah login.

        // Periksa role pengguna
        $user = Auth::user();
        if ($user->role == 1) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')->with('success','Selamat anda berhasil login');;
        } else {
            return redirect()->route('login');
        }
    }

    return back()->withInput()->withErrors([
        'password' => 'Wrong username or password']);
}
    }

   public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
   
}
