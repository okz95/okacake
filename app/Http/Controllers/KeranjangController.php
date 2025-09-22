<?php

namespace App\Http\Controllers;

use App\Models\DetTemp;
use App\Models\Kue;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class KeranjangController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [ new Middleware('login') ];
    }

    
    public function tbh_produk(Request $request)
    {
    

        $user_id = Auth::id();

        // Ambil transaksi terakhir user
        $lastTrans = Transaksi::where('user_id', $user_id)
            ->latest()
            ->first();

        // Jika ada transaksi terakhir
        if ($lastTrans) {
            if ($lastTrans->status == 'selesai') {
                // Boleh bikin transaksi baru (reset keranjang)
                $transaksi = Transaksi::firstOrCreate(
                    ['user_id' => $user_id, 'status' => 'pesan'],
                    ['total' => 0, 'kurir_id' => 1, 'bukti_bayar' => 'N/A']
                );
            } elseif ($lastTrans->status == 'pesan') {
                // Masih ada keranjang aktif → pakai yang ini
                $transaksi = $lastTrans;
            } else {
                // Masih ada transaksi berjalan selain 'pesan'
                Alert::error('Gagal', 'Anda memiliki pesanan yang masih diproses. Silakan selesaikan terlebih dahulu.');
                return redirect()->route('landing');
            }
        } else {
            // Kalau belum pernah buat transaksi
            $transaksi = Transaksi::create([
                'user_id' => $user_id,
                'status' => 'pesan',
                'total' => 0,
                'kurir_id' => 1,
                'bukti_bayar' => 'N/A'
            ]);
        }

        // Ambil produk
        $kue = Kue::findOrFail($request->input('kue_id'));
        $jumlah = (int) $request->input('jumlah', 1);

        // Cek apakah produk sudah ada di keranjang
        $detTemp = $transaksi->detTemp()->where('kue_id', $kue->id)->first();

        if ($detTemp) {
            $detTemp->jumlah += $jumlah;
            $detTemp->bayar = $detTemp->jumlah * $kue->harga;
            $detTemp->save();
        } else {
            $transaksi->detTemp()->create([
                'kue_id' => $kue->id,
                'jumlah' => $jumlah,
                'bayar'  => $kue->harga * $jumlah,
            ]);
        }

        // Update total transaksi
        $transaksi->total = $transaksi->detTemp()->sum('bayar');
        $transaksi->save();

        Alert::success('Sukses', 'Produk berhasil ditambahkan ke keranjang.');
        return redirect()->route('landing');
    }


    public function pesanan()
        {
           $user_id = Auth::id();
            $transaksi = Transaksi::where('user_id', $user_id)
            ->where('status', 'pesan')
            ->with('detTemp.kue')
            ->latest()
            ->first();

            return view('landing.transaksi.pesanan', compact('transaksi'));
        }
    
    public function update_pesanan(Request $request)
         {
                $detailIds  = $request->input('detail_id', []);
                $jumlahs    = $request->input('jumlah', []);
                $bayars     = $request->input('bayar', []);
                $subtotals  = $request->input('subtotal', []);
                $grandTotal = $request->input('grand_total');

                foreach ($detailIds as $index => $id) {
                    $jumlahBaru   = $jumlahs[$index] ?? 1;
                    $bayarBaru    = $bayars[$index] ?? 0;
                    $subtotalBaru = $subtotals[$index] ?? 0;

                    DetTemp::where('id', $id)->update([
                        'jumlah'   => $jumlahBaru,
                        'bayar'    => $bayarBaru,
                    ]);
                }

                // Simpan total keseluruhan di tabel transaksi
                $transaksi = $request->user()->transaksi()
                ->where('status', 'pesan')
                ->latest()
                ->first();

                if ($transaksi) {
                    $transaksi->update([
                        'total' => $grandTotal,
                    ]);
                }
                Alert::success('Sukses', 'Pesanan berhasil diperbarui!');
                return redirect()->back();
            }

    public function konfirmasi()
    {
        $transaksi = Transaksi::where('user_id', Auth::id())
            ->where('status', 'pesan')
            ->latest()
            ->first();

        if (!$transaksi || $transaksi->detTemp->isEmpty()) {
            Alert::error('Gagal', 'Tidak ada pesanan untuk dikonfirmasi.');
            return redirect()->route('landing');
        }

        $transaksi->status = 'Belum Bayar';
        $transaksi->save();

        Alert::success('Sukses', 'Pesanan berhasil dikonfirmasi. Silakan lanjutkan ke pembayaran.');
        return redirect()->route('keranjang.bayar');
    }

    public function bayar()
    {

        $transaksi = Transaksi::where('user_id', Auth::id())
            ->where('status', '!=', 'pesan')
            ->with('detTemp.kue', 'user.profile', 'kurir.profile')
            ->latest()
            ->first();

        if (!$transaksi || $transaksi->detTemp->isEmpty()) {
            Alert::error('Gagal', 'Tidak ada pesanan untuk dibayar.');
            return redirect()->route('landing');
        }

        return view('landing.transaksi.bayar', compact('transaksi'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,JPEG,PNG,JPG|max:2048',
        ]);

        $user = Auth::user();

        $transaksi = Transaksi::where('user_id', Auth::id())
        ->whereIn('status', ['Belum Bayar', 'Ditolak'])
        ->latest()
        ->first();


        if (!$transaksi) {
            Alert::error('Gagal', 'Transaksi tidak ditemukan atau sudah dibayar.');
            return redirect()->route('transaksi.bayar');
        }

        if ($request->hasFile('foto')) {
            
            $gambar_mentah = $request->file('foto');
            $nama_mentah   = 'bukti_' . Str::uuid();
            $format_gambar = $gambar_mentah->getClientOriginalExtension();
            $gambar_matang = $nama_mentah . '.' . $format_gambar;
            $lokasi_gambar = $gambar_mentah->storeAs('upload/bukti', $gambar_matang, 'dir_public');

            // tambahkan ke array data hanya jika ada file baru
            if($transaksi->bukti_bayar != "upload/bukti/default.png"){
                File::delete(public_path($transaksi->bukti_bayar));
            }

            $data['bukti_bayar'] = $lokasi_gambar;
            $data['status'] = 'Memproses Pembayaran';
        }
            // update data
            $input = $transaksi->update($data);

            if ($input) {
                Alert::success('Sukses', 'Pembayaran berhasil diunggah! Silakan tunggu konfirmasi dari admin.');
                return redirect()->back();
            } else {
                Alert::error('Gagal', 'Pembayaran gagal diunggah, silakan coba lagi.');
                return redirect()->back();
            }
            
    }

    public function hapus(Request $request)
    {
        $detailId = $request->id;
        $detTemp = DetTemp::find($detailId);

        if (!$detTemp) {
            Alert::error('Gagal', 'Item tidak ditemukan di keranjang.');
            return redirect()->back();
        }

        $transaksi = $detTemp->transaksi;

        if ($transaksi->status !== 'pesan') {
            Alert::error('Gagal', 'Item hanya bisa dihapus dari keranjang yang sedang diproses.');
            return redirect()->back();
        }

        // Hapus item dari det_temp
        $detTemp->delete();

        // Perbarui total transaksi
        $transaksi->total = $transaksi->detTemp()->sum('bayar');
        $transaksi->save();

        Alert::success('Sukses', 'Item berhasil dihapus dari keranjang.');
        return redirect()->back();
    }
    

}
