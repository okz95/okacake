<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    protected $table = 'pengirimans';
    protected $fillable = [
        'kurir_id',
        'transaksi_id',
        'ongkir',
        'bukti_sampai'
    ];

    public function transaksi(){
        return $this->belongsTo(Transaksi::class);
    }

    public function kurir()
    {
        return $this->belongsTo(User::class, 'kurir_id')
                    ->where('role', 'kurir');
    }
}
