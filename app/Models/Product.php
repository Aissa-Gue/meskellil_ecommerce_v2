<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;

class Product extends Model
{
    protected $fillable = [
        'name',
        'size',
        'brand_id',
        'category_id',
        'use_case',
        'description',
        'caracteristics',
        'reference',
        'price1',
        'price2',
        'stock',
        'discount',
        'is_new',
        'image1',
        'image2',
        'image3',
        'image4',
        'image5',
        'is_active'
    ];

    protected $casts = [
        'is_new' => 'boolean',
        'is_active' => 'boolean',
        'caracteristics' => 'array',
        'price1' => 'decimal:2',
        'price2' => 'decimal:2',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function orderLines()
    {
        return $this->hasMany(OrderProduct::class);
    }

    /* Scopes */
    public function scopeActive(Builder $q): Builder
    {
        return $q->where('is_active', true);
    }
    public function scopeNew(Builder $q): Builder
    {
        return $q->where('is_new', true);
    }
    public function scopeInStock(Builder $q): Builder
    {
        return $q->where('stock', '>', 0);
    }

    public function scopeSearch(Builder $q, ?string $term): Builder
    {
        if (!$term) return $q;
        return $q->where(function ($w) use ($term) {
            $w->where('name', 'like', "%{$term}%")
                ->orWhere('reference', 'like', "%{$term}%")
                ->orWhere('use_case', 'like', "%{$term}%");
        });
    }

    /* Helper Methods */
    public function getMainPriceAttribute()
    {
        return $this->price1 ?? 0;
    }

    public function getDiscountedPriceAttribute()
    {
        if ($this->discount && $this->discount > 0) {
            return $this->price1 * (1 - $this->discount / 100);
        }
        return $this->price1;
    }

    public function getHasDiscountAttribute()
    {
        return $this->discount && $this->discount > 0;
    }

    public function getDiscountAmountAttribute()
    {
        if ($this->has_discount) {
            return $this->price1 - $this->discounted_price;
        }
        return 0;
    }

    public function getMainImageAttribute()
    {
        return $this->image1 ?: 'assets/img/product/default-product.jpg';
    }

    public function getFirstImageAttribute()
    {
        for ($i = 1; $i <= 5; $i++) {
            $imageField = "image{$i}";
            if ($this->$imageField) {
                return $this->$imageField;
            }
        }
        return 'assets/img/product/default-product.jpg';
    }

    public function getImagesAttribute()
    {
        $images = [];
        for ($i = 1; $i <= 5; $i++) {
            $imageField = "image{$i}";
            if ($this->$imageField) {
                $images[] = $this->$imageField;
            }
        }

        // If no images found, add a default one
        if (empty($images)) {
            $images[] = 'assets/img/product/default-product.jpg';
        }

        return $images;
    }

    public function getStockStatusAttribute()
    {
        if ($this->stock > 0) {
            return 'In Stock';
        }
        return 'Out of Stock';
    }

    public function getStockStatusClassAttribute()
    {
        return $this->stock > 0 ? 'text-success' : 'text-danger';
    }

    public function getCharacteristicsArrayAttribute()
    {
        try {
            if (is_string($this->caracteristics)) {
                $decoded = json_decode($this->caracteristics, true);
                return is_array($decoded) ? $decoded : [];
            }

            if (is_array($this->caracteristics)) {
                return $this->caracteristics;
            }

            if (is_null($this->caracteristics)) {
                return [];
            }

            // If it's any other type, try to convert it
            if (is_object($this->caracteristics)) {
                return (array) $this->caracteristics;
            }

            return [];
        } catch (\Exception $e) {
            // Log the error and return empty array
            Log::error('Error processing product characteristics: ' . $e->getMessage(), [
                'product_id' => $this->id,
                'caracteristics' => $this->caracteristics
            ]);
            return [];
        }
    }
}
