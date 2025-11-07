<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = [
        'product_id',
        'color','shape','size','taste',
        'price1','price2',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function product() { return $this->belongsTo(Product::class); }

    /* Scopes */
    public function scopeActive(Builder $q): Builder
    {
        return $q->where('is_active', true);
    }

    /* Helper Methods */
    public function getPriceAttribute()
    {
        if (auth()->check() && auth()->user()->type == 'gros') {
            return $this->price2;
        }
        return $this->price1;
    }
}
