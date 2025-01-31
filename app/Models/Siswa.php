<?php

namespace App\Models;

use App\Models\Ortu;
use App\Models\Fisik;
use App\Models\Bendahara\Payment;
use App\Models\Bendahara\Tagihan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Siswa extends Model
{
    use SoftDeletes;
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
        'tahun_id',
        'guru_id',
        'keterangan',
    ];
    protected $append = ['total_pembayaran'];

    protected static function booted()
    {
        static::addGlobalScope('tahun_aktif', function (Builder $builder) {
            $builder->whereHas('tahun', function($query) {
                $query->where('is_active', true);
            });
        });
    }
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
    /**
     * Get the fisik associated with the Siswa
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function fisik(): HasOne
    {
        return $this->hasOne(Fisik::class,'siswa_id');
    }
}
