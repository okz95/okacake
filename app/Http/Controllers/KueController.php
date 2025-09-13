<?php

namespace App\Http\Controllers;

use App\Http\Requests\KueRequest;
use App\Models\Kategori;
use App\Models\Kue;
use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class KueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kue = Kue::orderBy('id', 'desc')->get();

        $title = 'Hapus Data';
        $text = "Apakah Kamu yakin?";
        confirmDelete($title, $text);

         return view('sistem.kue.index', compact('kue'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $satuan = Satuan::all();
        $kategori = Kategori::all();
        return view('sistem.kue.tambah', compact('satuan', 'kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KueRequest $request)
    {
        if($request->hasFile('foto')){

        
       $gambar_mentah = $request->file('foto');
       $nama_mentah = 'produk_'.Str::uuid();
       $format_gambar = $gambar_mentah->getClientOriginalExtension();
       $gambar_matang = $nama_mentah.'.'.$format_gambar;
       $lokasi_gambar = $gambar_mentah->storeAs('upload/produk',$gambar_matang,'dir_public');
    }else{
         $lokasi_gambar = '';
    }

       $input = Kue::create([
                'nama' =>$request->nama,
                'harga' =>$request->harga,
                'kategori_id' =>$request->kategori,
                'satuan_id' =>$request->satuan,
                'stok' =>$request->stok,
                'foto' =>$lokasi_gambar

                ]);
        if ($input) {
            Alert::success('Sukses', 'Data selesai ditambahkan!');
            return redirect()->route('kue.index');
        }else{
            Alert::error('Gagal', 'Data gagal ditambahkan!');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $satuan = Satuan::all();
        $kategori = Kategori::all();
        $kue = Kue::find($id);
        return view('sistem.kue.ubah', compact('satuan', 'kategori', 'kue'));
    }

    /**
     * Update the specified resource in storage.
     */
public function update(KueRequest $request, string $id)
{
    $kue = Kue::findOrFail($id);

    // data dasar
    $data = [
        'nama'       => $request->nama,
        'harga'      => $request->harga,
        'kategori_id'=> $request->kategori,
        'satuan_id'  => $request->satuan,
        'stok'       => $request->stok,
    ];

    // cek apakah ada file foto baru
    if ($request->hasFile('foto')) {
        $gambar_mentah = $request->file('foto');
        $nama_mentah   = 'produk_' . Str::uuid();
        $format_gambar = $gambar_mentah->getClientOriginalExtension();
        $gambar_matang = $nama_mentah . '.' . $format_gambar;
        $lokasi_gambar = $gambar_mentah->storeAs('upload/produk', $gambar_matang, 'dir_public');

        // tambahkan ke array data hanya jika ada file baru
        if($kue->foto != "upload/produk/default.png"){
            File::delete(public_path($kue->foto));
        }
        $data['foto'] = $lokasi_gambar;
    }

    // update data
    $input = $kue->update($data);

    if ($input) {
        Alert::success('Sukses', 'Data selesai diubah!');
        return redirect()->route('kue.index');
    } else {
        Alert::error('Gagal', 'Data gagal diubah!');
        return redirect()->back();
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kue = Kue::findOrFail($id);
        if($kue->delete()){
            if($kue->foto != "upload/produk/default.png"){
            File::delete(public_path($kue->foto));
            }
            Alert::success('Sukses', 'Data berhasil dihapus!');
                return redirect()->route('kue.index');
            }else{
                Alert::error('Gagal', 'Data gagal dihapus!');
                return redirect()->back();
            }
    }
}
