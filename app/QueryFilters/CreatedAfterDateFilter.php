<?php

namespace App\QueryFilters;

use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class CreatedAfterDateFilter implements Filter
{
    public function __invoke(Builder $query, $value, ?string $property): void
    {
        if (!empty($value)) {
            $query->whereDate($property, '>=', $value);
        }
    }
}
