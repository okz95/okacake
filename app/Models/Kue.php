<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Kue extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nama',
        'kategori_id',
        'harga',
        'satuan_id',
        'stok',
        'foto'
    ];

    protected $dates = ['deleted_at'];

    public function kategori(){
        return $this->belongsTo(Kategori::class);
    }

    public function satuan(){
        return $this->belongsTo(Satuan::class);
    }
    
}
