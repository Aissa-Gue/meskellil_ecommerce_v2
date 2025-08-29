<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use App\QueryFilters\CreatedAfterDateFilter;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\Enums\FilterOperator;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class OrderService
{
    public function getFilteredOrders(?Request $request)
    {
        return QueryBuilder::for(Order::with('client', 'items'), $request)
            ->allowedFilters([
                AllowedFilter::exact('client_id'),
                'client_name',
                'client_phone',
                AllowedFilter::exact('wilaya_id'),
                AllowedFilter::exact('payment_status'),
                AllowedFilter::exact('payment_method'),
                AllowedFilter::exact('is_verified'),
                AllowedFilter::exact('order_status'),
                'notes',

                AllowedFilter::exact('total_price'),
                AllowedFilter::callback('total_price_min', function ($query, $value) {
                    $query->where('total_price', '>=', $value);
                }),
                AllowedFilter::callback('total_price_max', function ($query, $value) {
                    $query->where('total_price', '<=', $value);
                }),


                AllowedFilter::exact('client_id'),
                AllowedFilter::exact('client.name'),

                AllowedFilter::custom('created_after_date', new CreatedAfterDateFilter(), 'created_at'),
            ])
            ->allowedSorts([
                'client_name',
                'wilaya_id',
                'total_price',
                'payment_status',
                'payment_method',
                'is_verified',
                'order_status',
                'created_at',
            ])
            ->allowedIncludes(['client', 'items']); // relationships
    }
}
