<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atm extends Model
{
    use HasFactory;

    protected $guarded = [];

     public function absen(){
        return $this->hasOne(Absen::class, 'atm_id');
    }
}
