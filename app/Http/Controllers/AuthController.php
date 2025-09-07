<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [ new Middleware('guest')->except('logout')];
    }
    public function login(){
        return view('landing.konten.login');
    }
    public function login_process(Request $request){
        $input = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // Bisa login pakai username atau email
        $login_type = filter_var($input['username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([$login_type => $input['username'], 'password' => $input['password']], $request->filled('remember'))) {
            $request->session()->regenerate();
            Alert::success('Login Berhasil!', '');
            return redirect()->intended(route('dashboard')); // arahkan ke dashboard
        }else{
            Alert::error('Login Gagal!', 'Username/Email atau Password salah');
            return back();
        }

    }

    public function logout(){
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        Alert::success('Logout Berhasil!', '');
        return redirect()->route('landing');
    }
}
