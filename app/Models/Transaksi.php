<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'user_id',
        'total',
        'status',
        'kurir',
        'bukti_bayar'
    ];

    public function detTransaksi()
    {
        return $this->hasMany(DetTran::class);
    }

    public function detTemp()
    {
        return $this->hasMany(DetTemp::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
