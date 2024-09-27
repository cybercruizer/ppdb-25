<?php

namespace App\Models\Bendahara;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tagihan extends Model
{
    protected $guarded= [];
    /**
     * Get all of the payment for the Tagihan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments(): HasMany
    {
        return $this->hasMany(payment::class);
    }
    protected function totalPembayaran(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->payments()->sum('nominal'),
        );
    }
}
