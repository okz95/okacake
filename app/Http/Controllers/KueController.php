<?php

namespace App\Http\Controllers;

use App\Http\Requests\KueRequest;
use App\Models\Kategori;
use App\Models\Kue;
use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class KueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kue = Kue::orderBy('id', 'desc')->get();;
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
       $lokasi_gambar = $gambar_mentah->storeAs('/produk',$gambar_matang,'dir_public');
    }else{
         $lokasi_gambar = '';
    }

       $input = Kue::create([
                'nama' =>$request->nama,
                'harga' =>$request->harga,
                'kategori_id' =>$request->kategori,
                'satuan_id' =>$request->satuan,
                'stok' =>$request->stok,
                'foto' =>'upload/'.$lokasi_gambar

                ]);
        if ($input) {
            return redirect()->route('kue.index')->with('sukses','Data Berhasil Ditambahkan!');
        }else{
            return redirect()->back()->with('gagal','Data Gagal Ditambahkan!');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
