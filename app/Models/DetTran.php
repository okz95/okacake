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

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

    public function kue()
    {
        return $this->belongsTo(Kue::class);
    }

    
}
