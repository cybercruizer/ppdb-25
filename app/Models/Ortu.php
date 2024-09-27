<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ortu extends Model
{
    protected $fillable = [
        'nama_ayah',
        'telp',
        'alamat_ortu',
        'kerjaayah_id',
        'gajiayah_id',
        'nama_ibu',
        'kerjaibu_id',
        'gajiibu_id',
        'nama_wali',
        'alamat_wali',
        'telp_wali'
    ];
    public function siswa() {
        return $this->belongsTo(Siswa::class);
    }
}
