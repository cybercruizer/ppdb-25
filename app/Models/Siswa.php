<?php

namespace App\Models;

use App\Models\Ortu;
use App\Models\Bendahara\Payment;
use App\Models\Bendahara\Tagihan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Siswa extends Model
{
    protected $fillable = [
        'no_pendaf',
        'nama',
        'nisn',
        'tempat_lahir',
        'tgl_lahir',
        'jenis kelamin',
        'agama',
        'anak_ke',
        'dari',
        'alamat',
        'asal_sekolah',
        'alamat_sekolah',
        'no_telp',
        'hobi',
        'jarak',
        'transport',
        'informasi',
        'jurusan',
        'alasan',
        'ortu_id',
    ];
    protected $append = ['total_pembayaran'];

    public function ortu() {
        return $this->hasOne(Ortu::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class,'siswa_id');
    }
    public function tagihan()
    {
        return $this->hasOne(Tagihan::class);
    }
    /**
     * Get the gugu that owns the Siswa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function guru(): BelongsTo
    {
        return $this->belongsTo(Guru::class);
    }
    /**
     * Get the desa associated with the Siswa
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function desa(): HasOne
    {
        return $this->hasOne(Desa::class);
    }
    protected function totalPembayaran(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->payments()->sum('nominal'),
        );
    }
    public function kekurangan()
    {
        $kekurangan= $this->tagihan->nominal - $this->totalPembayaran;
        if($kekurangan<=0){
            return "Lunas";
        } else {
            return  $kekurangan;
        }
    }
    /**
     * Get the tahun that owns the Siswa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tahun(): BelongsTo
    {
        return $this->belongsTo(Tahun::class,'tahun_id');
    }
}
