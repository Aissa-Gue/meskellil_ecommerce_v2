<?php

namespace App\Services;

use App\Models\Product;
use App\QueryFilters\CreatedAfterDateFilter;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class ProductService
{
    public function getFilteredProducts(?Request $request)
    {
        return QueryBuilder::for(Product::with('category', 'brand'), $request)
            ->allowedFilters([
                'name',
                AllowedFilter::exact('size'),
                'use_case',
                'description',
                'characteristics',

                AllowedFilter::exact('reference'),
                AllowedFilter::exact('stock'),
                AllowedFilter::exact('is_new'),
                AllowedFilter::exact('is_active'),

                AllowedFilter::exact('discount'),

                AllowedFilter::exact('price1'),
                AllowedFilter::callback('price1_min', function ($query, $value) {
                    $query->where('price1', '>=', $value);
                }),
                AllowedFilter::callback('price1_max', function ($query, $value) {
                    $query->where('price1', '<=', $value);
                }),

                AllowedFilter::exact('price2'),
                AllowedFilter::callback('price2_min', function ($query, $value) {
                    $query->where('price2', '>=', $value);
                }),
                AllowedFilter::callback('price2_max', function ($query, $value) {
                    $query->where('price2', '<=', $value);
                }),

                AllowedFilter::exact('category_id'),
                AllowedFilter::exact('category.name'),

                AllowedFilter::exact('brand_id'),
                AllowedFilter::exact('brand.name'),

                AllowedFilter::callback('instock', function ($query, $value) {
                    if (filter_var($value, FILTER_VALIDATE_BOOLEAN)) {
                        $query->where('stock', '>', 0);
                    }
                }),
                AllowedFilter::callback('discount_greater_than', function ($query, $value) {
                        $query->where('discount', '>', $value);
                }),
                AllowedFilter::custom('created_after_date', new CreatedAfterDateFilter(), 'created_at'),
            ])
            ->allowedSorts([
                'name',
                'reference',
                'is_new',
                'price1',
                'price2',
                'stock',
                'discount',
                'category_id',
                'brand_id',
                'created_at',
            ])
            ->allowedIncludes(['brand', 'category']); // relationships
    }
}
