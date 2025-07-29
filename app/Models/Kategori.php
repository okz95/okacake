<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = ['nama'];


    public function kue(){
        return $this->hasOne(Kue::class);
    }
}
