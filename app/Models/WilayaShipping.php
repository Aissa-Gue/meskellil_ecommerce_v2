<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kossa\AlgerianCities\Wilaya;

class WilayaShipping extends Model
{
    protected $fillable = [
        'wilaya_id',
        'shipping_price',
    ];

    public function wilaya()
    {
        return $this->belongsTo(Wilaya::class);
    }
}
