<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Absen extends Model
{
    protected $fillable = [
        // 'nip_teknisi',
        // 'nama_teknisi',
        'user_id',
        'latitude',
        'longitude',
        // 'nama_atm',
        'atm_id',
        'kondisi_mesin',
        'keterangan',
        'foto',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function atm(){
        return $this->belongsTo(Atm::class);
    }

    use HasFactory;
}
