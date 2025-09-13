<?php

namespace App\Http\Controllers;

use App\Http\Requests\KategoriRequest;
use App\Models\Kategori;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori::orderBy('id', 'desc')->get();

        $title = 'Hapus Data';
        $text = "Apakah Kamu yakin?";
        confirmDelete($title, $text);

         return view('sistem.kategori.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('sistem.kategori.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KategoriRequest $request)
    {
        $input = Kategori::create([
                'nama' =>$request->nama,
                ]);
        if ($input) {
            Alert::success('Sukses', 'Data selesai ditambahkan!');
            return redirect()->route('kategori.index');
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
         $kategori = Kategori::findOrFail($id);
        if($kategori->delete()){
            Alert::success('Sukses', 'Data berhasil dihapus!');
                return redirect()->route('kategori.index');
            }else{
                Alert::error('Gagal', 'Data gagal dihapus!');
                return redirect()->back();
            }
    }
}
