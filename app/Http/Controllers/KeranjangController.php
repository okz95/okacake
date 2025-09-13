<?php

namespace App\Http\Controllers;

use App\Models\Kue;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class KeranjangController extends Controller
{
    public function tbh_produk(Request $request)
        {
            if (!Auth::check()) {
                Alert::error('Gagal', 'Silahkan login terlebih dahulu untuk menambahkan produk ke keranjang.');
                return redirect()->route('auth.login');
            }

            $kue = Kue::findOrFail($request->input('kue_id'));
            $jumlah = (int) $request->input('jumlah', 1);
            $user_id = Auth::id();

            $transaksi = Transaksi::firstOrCreate(
                ['user_id' => $user_id, 'status' => 'pending'],
                ['total' => 0, 'kurir' => 'Asep', 'bukti_bayar' => 'N/A']
            );

            $detTemp = $transaksi->detTemp()->where('kue_id', $kue->id)->first();

            if ($detTemp) {
                $detTemp->jumlah += $jumlah;
                $detTemp->bayar = $detTemp->jumlah * $kue->harga;
                $detTemp->save();
            } else {
                $transaksi->detTemp()->create([
                    'kue_id'        => $kue->id,
                    'jumlah'        => $jumlah,
                    'bayar'         => $kue->harga * $jumlah,
                ]);
            }

            $transaksi->total= $transaksi->detTemp()->sum('bayar');
            $transaksi->save();

            Alert::success('Sukses', 'Produk berhasil ditambahkan ke keranjang.');
            return redirect()->route('landing');
        }
    
    

}
