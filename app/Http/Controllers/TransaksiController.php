<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\User;
use App\Models\Pengiriman;
use App\Models\Toko;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class TransaksiController extends Controller implements HasMiddleware
{

    public static function middleware()
    {
         return [ new Middleware('role:admin')];
    }

    public function index()
    {
        
        $transaksi = Transaksi::where('status', 'Memproses Pembayaran')
            ->with('user.profile') // Eager load user and profile relationships
            ->orderBy('created_at', 'desc')
            ->get();
        
        $kurir = User::where('role', 'kurir')->get();
        
        return view('sistem.transaksi.index', compact('transaksi', 'kurir'));
    }

    public function konfirmasi(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Diterima,Ditolak',
            'kurir_id' => 'nullable|exists:users,id',
            'ket' => 'nullable|string',
        ]);

        $transaksi = Transaksi::findOrFail($id);

        if ($request->status === 'Ditolak') {
            $transaksi->status = 'Ditolak';
            $transaksi->ket = $request->ket;

        } else {
            $transaksi->status = 'Dikirim';
            $transaksi->ket = null; // Clear alasan_tolak if accepted
            $transaksi->kurir_id = $request->kurir_id;

            Pengiriman::create([
                'kurir_id'      => $request->kurir_id,
                'transaksi_id'   => $transaksi->id,
                'ongkir'        => $request->ongkir,
                'bukti_sampai'   => 'Tidak Ada'
            ]);
        }
        $transaksi->save();
        Alert::success('Sukses', 'Transaksi berhasil dikonfirmasi');
        return redirect()->route('transaksi.index');
    }

    public function dikirim()
    {
        
        $transaksi = Transaksi::where('status', 'Dikirim')
            ->with('user.profile') // Eager load user and profile relationships
            ->orderBy('created_at', 'desc')
            ->get();
        
        $kurir = User::where('role', 'kurir')->get();
        
        return view('sistem.transaksi.index', compact('transaksi', 'kurir'));
    }

    public function cetak($id){
        $toko= Toko::findorfail(1);
        $transaksi= Transaksi::findorfail($id);
        return view('sistem.transaksi.terima', compact('transaksi', 'toko'));
    }

}
