<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Brand extends Model
{
    protected $fillable = ['name', 'description', 'is_active'];

    public function products() {
        return $this->hasMany(Product::class);
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
