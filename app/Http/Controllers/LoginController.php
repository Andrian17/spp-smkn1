<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.login');
    }

    public function authtenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        //jika login berhasil
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/siswa');
        }
        //jika login gagal
        return back()->with('loginError', 'Login gagal');
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('status', 'anda telah logout');
    }
}
