<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LabaRugi extends Model
{
    protected $fillable = [
            'jenis',
            'ket',
            'nominal',
            'tgl_catat'
    ];
}
