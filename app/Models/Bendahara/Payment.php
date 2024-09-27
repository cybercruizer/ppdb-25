<?php

namespace App\Models\Bendahara;

use App\Models\Siswa;
use App\Models\Tahun;
use App\Models\Bendahara\Tagihan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    protected $fillable = [
        'siswa_id', 'tagihan_id', 'tahun_id', 'nominal'
    ];


    // Relasi many-to-one dengan model Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    // Relasi many-to-one dengan model Tagihan
    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class, 'tagihan_id');
    }

    // Relasi many-to-one dengan model Tahun
    public function tahun()
    {
        return $this->belongsTo(Tahun::class, 'tahun_id');
    }
}
