<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Category extends Model
{
    protected $fillable = ['name', 'parent_id', 'is_active', 'image'];

    public function parent() {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children() {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function products() {
        return $this->hasMany(Product::class);
    }

    // Accessor to add URL prefix to image
    public function getImageAttribute($value)
    {
        return $value ? asset('storage/' . $value) : null;
    }

    /* Scopes */
    public function scopeActive(Builder $q): Builder {
        return $q->where('is_active', true);
    }

    public function scopeSearch(Builder $q, ?string $term): Builder {
        if ($term) $q->where('name', 'like', "%{$term}%");
        return $q;
    }
}
