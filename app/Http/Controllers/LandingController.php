<?php

namespace App\Http\Controllers;

use App\Models\Kue;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LandingController extends Controller
{
    public function index(){

        $transaksi = null;
        if (Auth::check()) {
            $transaksi = Transaksi::where('user_id', Auth::id())
                ->with('detTemp.kue')
                ->latest()
                ->first();
        }
        
        $kue = Kue::all();
        return view('landing.konten.index', compact('kue', 'transaksi'));
    }
}
