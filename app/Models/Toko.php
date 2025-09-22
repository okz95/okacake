<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    protected $fillable = [
        'nama',
        'pemilik',
        'alamat',
        'kota',
        'no_hp',
        'fax',
        'email',
        'logo',
    ];
}
