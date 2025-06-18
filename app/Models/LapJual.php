<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LapJual extends Model
{
    protected $fillable = [
        'det_tran_id',
        'transaksi_id',
        'kue_id',
        'jumlah',
        'bayar'
    ];
}
