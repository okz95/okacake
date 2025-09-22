<?php

namespace App\Http\Controllers;

use App\Http\Requests\TokoRequest;
use App\Models\Toko;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class TokoController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
         return [ new Middleware('role:admin')];
    }
    
    public function index(){
        $data = Toko::findorfail(1);
        return view('sistem.toko.index', compact('data'));
    }

    public function edit(){
        $data = Toko::findorfail(1);
        return view('sistem.toko.ubah', compact('data'));
    }

    public function update(TokoRequest $request)
{
    
    $toko = Toko::findorfail(1);

    // data dasar
    $data = [
    'nama'    => $request->nama,
    'pemilik' => $request->pemilik,
    'alamat'  => $request->alamat,
    'kota'    => $request->kota,
    'no_hp'   => $request->no_hp,
    'fax'     => $request->fax,
    'email'   => $request->email,
];

    // cek apakah ada file foto baru
    if ($request->hasFile('foto')) {
        $gambar_mentah = $request->file('foto');
        $nama_mentah   = 'toko_' . Str::uuid();
        $format_gambar = $gambar_mentah->getClientOriginalExtension();
        $gambar_matang = $nama_mentah . '.' . $format_gambar;
        $lokasi_gambar = $gambar_mentah->storeAs('upload/toko', $gambar_matang, 'dir_public');

        // tambahkan ke array data hanya jika ada file baru
        if($toko->logo != "upload/toko/default.png"){
            File::delete(public_path($toko->logo));
        }
        $data['logo'] = $lokasi_gambar;
    }

    // update data
    $input = $toko->update($data);

    if ($input) {
        Alert::success('Sukses', 'Data selesai diubah!');
        return redirect()->route('toko.index');
    } else {
        Alert::error('Gagal', 'Data gagal diubah!');
        return redirect()->back();
    }
}
}
