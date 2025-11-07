<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;

class Product extends Model
{
    protected $fillable = [
        'reference',
        'name',
        'description',
        'size',
        'brand_id',
        'category_id',
        'use_case',
        'characteristics',
        'price1',
        'price2',
        'stock',
        'discount',
        'is_featured',
        'is_new',

        'image1',
        'image2',
        'image3',
        'image4',
        'image5',
        'is_active'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_new' => 'boolean',
        'is_active' => 'boolean',
        'characteristics' => 'array',
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
    // /**
    //  * Get the full URL for an image field
    //  *
    //  * @param string|null $value
    //  * @retuxrn string|null
    //  */
    // protected function getImageUrl($value)
    // {
    //     return $value ? asset('storage/' . $value) : null;
    // }

    // /**
    //  * Accessors for image fields
    //  */
    // public function getImage1Attribute($value)
    // {
    //     return $this->getImageUrl($value);
    // }

    // public function getImage2Attribute($value)
    // {
    //     return $this->getImageUrl($value);
    // }

    // public function getImage3Attribute($value)
    // {
    //     return $this->getImageUrl($value);
    // }

    // public function getImage4Attribute($value)
    // {
    //     return $this->getImageUrl($value);
    // }

    // public function getImage5Attribute($value)
    // {
    //     return $this->getImageUrl($value);
    // }

    public function productVariants()
    {
        return $this->hasMany(ProductVariant::class);
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

    public function scopeFeatured(Builder $q): Builder
    {
        return $q->where('is_featured', true);
    }

    public function scopeNew(Builder $q): Builder
    {
        return $q->where('is_new', true);
    }

    public function scopeInStock(Builder $q): Builder
    {
        return $q->where('stock', '>', 0);
    }

    public function scopeHasVariant(Builder $q, string $variant): bool
    {
        if (in_array($variant, ['color', 'shape', 'size', 'taste'])) {
            return $q->whereHas('productVariants',
                    fn (Builder $q) => $q->whereNotNull($variant)->where('is_active', true))->count() > 0;
        }
        return false;
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
    public function getPriceAttribute()
    {
        if (auth()->check() && auth()->user()->type == 'gros') {
            return $this->price2;
        }
        return $this->price1;
    }

    public function getHasDiscountAttribute(): bool
    {
        return !is_null($this->discount) && $this->discount > 0;
    }

    public function getMainPriceAttribute()
    {
        if ($this->has_discount) {
            return $this->price * (1 + $this->discount / 100);
        }
        return $this->price;
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
                $images[] = asset('storage/' . $this->$imageField);
            }
        }

        // If no images found, add a default one
        if (empty($images)) {
            $images[] = asset('assets/img/product/default-product.jpg');
        }

        return $images;
    }

    // get images as asset storage
    // as here     // Accessor to add URL prefix to image
    // public function getImageAttribute($value)
    // {
    //     return $value ? asset('storage/' . $value) : null;
    // }

    // // but for image1 and image2 and ...etc
    // public function getImage1Attribute($value)
    // {
    //     return $value ? asset('storage/' . $value) : null;
    // }

    // public function getImage2Attribute($value)
    // {
    //     return $value ? asset('storage/' . $value) : null;
    // }

    // public function getImage3Attribute($value)
    // {
    //     return $value ? asset('storage/' . $value) : null;
    // }

    // public function getImage4Attribute($value)
    // {
    //     return $value ? asset('storage/' . $value) : null;
    // }

    // public function getImage5Attribute($value)
    // {
    //     return $value ? asset('storage/' . $value) : null;
    // }

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
            if (is_string($this->characteristics)) {
                $decoded = json_decode($this->characteristics, true);
                return is_array($decoded) ? $decoded : [];
            }

            if (is_array($this->characteristics)) {
                return $this->characteristics;
            }

            if (is_null($this->characteristics)) {
                return [];
            }

            // If it's any other type, try to convert it
            if (is_object($this->characteristics)) {
                return (array)$this->characteristics;
            }

            return [];
        } catch (\Exception $e) {
            // Log the error and return empty array
            Log::error('Error processing product characteristics: ' . $e->getMessage(), [
                'product_id' => $this->id,
                'characteristics' => $this->characteristics
            ]);
            return [];
        }
    }
}
