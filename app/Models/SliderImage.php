<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderImage extends Model
{
    const TYPE_SLIDER = 'slider';
    const TYPE_BANNER_TOP = 'banner_top';
    const TYPE_BANNER_SMALL = 'banner_small';
    const TYPE_BANNER_MEDIUM = 'banner_medium';
    const TYPE_BANNER_PRODUCT = 'banner_product';

    protected $fillable = [
        'type',
        'image_url',
        'resolution_width',
        'resolution_height',
        'link_url',
        'sort_order',
        'is_active',
        'max_items',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'resolution_width' => 'integer',
        'resolution_height' => 'integer',
        'max_items' => 'integer',
    ];

    /**
     * Scope a query to only include active slider images.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to order by sort order.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    /**
     * Scope a query to get images by type.
     */
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Get the available types.
     */
    public static function getTypes()
    {
        return [
            self::TYPE_SLIDER => 'Main Slider',
            self::TYPE_BANNER_TOP => 'Top Banner',
            self::TYPE_BANNER_SMALL => 'Small Banner',
            self::TYPE_BANNER_MEDIUM => 'Medium Banner',
            self::TYPE_BANNER_PRODUCT => 'Product Banner',
        ];
    }
}
