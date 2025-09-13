<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
         return [ new Middleware('role:admin')];
    }
    
    public function index(){
        $data = Profile::firstWhere('user_id', Auth::id());
        return view('sistem.profile.index', compact('data'));
    }

    public function edit($id){
        $data = Profile::where('user_id', $id)->firstOrFail();
        return view('sistem.profile.ubah', compact('data'));
    }

public function update(ProfileRequest $request, string $id)
{
    $pengguna = Profile::where('user_id', $id)->firstOrFail();

    // data dasar
    $data = [
        'nama'       => $request->nama,
        'alamat'      => $request->alamat,
        'no_hp'      => $request->no_hp,
    ];

    // cek apakah ada file foto baru
    if ($request->hasFile('foto')) {
        $gambar_mentah = $request->file('foto');
        $nama_mentah   = 'profile_' . Str::uuid();
        $format_gambar = $gambar_mentah->getClientOriginalExtension();
        $gambar_matang = $nama_mentah . '.' . $format_gambar;
        $lokasi_gambar = $gambar_mentah->storeAs('upload/profile', $gambar_matang, 'dir_public');

        // tambahkan ke array data hanya jika ada file baru
        if($pengguna->foto != "upload/profile/default.png"){
            File::delete(public_path($pengguna->foto));
        }
        $data['foto'] = $lokasi_gambar;
    }

    // update data
    $input = $pengguna->update($data);

    if ($input) {
        Alert::success('Sukses', 'Data selesai diubah!');
        return redirect()->route('profile.index');
    } else {
        Alert::error('Gagal', 'Data gagal diubah!');
        return redirect()->back();
    }
}

}
