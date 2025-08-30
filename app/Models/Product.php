<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    protected $fillable = [
        'name', 'size', 'brand_id', 'category_id', 'use_case', 'description',
        'caracteristics', 'reference',
        'price1', 'price2', 'stock', 'discount', 'is_new',
        'image1','image2','image3','image4','image5',
        'is_active'
    ];

    protected $casts = [
        'is_new' => 'boolean',
        'is_active' => 'boolean',
        'caracteristics' => 'array',
        'price1' => 'decimal:2',
        'price2' => 'decimal:2',
    ];

    public function brand() { return $this->belongsTo(Brand::class); }
    public function category() { return $this->belongsTo(Category::class); }
    public function orderLines() { return $this->hasMany(OrderProduct::class); }

    /* Scopes */
    public function scopeActive(Builder $q): Builder { return $q->where('is_active', true); }
    public function scopeNew(Builder $q): Builder { return $q->where('is_new', true); }
    public function scopeInStock(Builder $q): Builder { return $q->where('stock', '>', 0); }

    public function scopeSearch(Builder $q, ?string $term): Builder {
        if (!$term) return $q;
        return $q->where(function ($w) use ($term) {
            $w->where('name', 'like', "%{$term}%")
              ->orWhere('reference', 'like', "%{$term}%")
              ->orWhere('use_case', 'like', "%{$term}%");
        });
    }
}
