<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            (new Middleware('guest'))->except('logout'),
        ];
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
            if(Auth::user()->role == 'customer'){
                return redirect()->intended(route('landing'));
            }
            return redirect()->intended(route('dashboard')); // arahkan ke dashboard
        }else{
            Alert::error('Login Gagal!', 'Username/Email atau Password salah');
            return back();
        }

    }

    public function register(){
        return view('landing.konten.register');
    }

    public function register_process(AuthRequest $request){

    if($request->role === 'customer'){
        $status = 'aktif';
    }else{
        $status = 'belum aktif';
    }


    DB::beginTransaction();
    try {
        $user = User::create([
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
            'status'   => $status
        ]);

        Profile::create([
            'nama'    => $request->nama,
            'no_hp'   => $request->no_hp,
            'alamat'  => $request->alamat,
            'user_id' => $user->id,
            'foto'    => 'upload/profile/default.png'
        ]);

        DB::commit();
        Alert::success('Registrasi Berhasil!', 'Silakan login untuk melanjutkan');
        return redirect()->route('auth.login');

    } catch (\Exception $e) {
        DB::rollBack();
        Alert::error('Registrasi Gagal!', 'Silakan coba lagi');
        return redirect()->route('auth.register');
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
