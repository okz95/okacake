<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetTran extends Model
{
    protected $fillable = [
        'transaksi_id',
        'kue_id',
        'jumlah',
        'bayar'
    ];
}
