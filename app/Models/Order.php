<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Order extends Model
{
    protected $fillable = [
        'client_id','client_name','client_phone','wilaya_id',
        'payment_status','payment_method','is_verified','order_status',
        'total_price','notes'
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'total_price' => 'decimal:2',
    ];

    public function client() { return $this->belongsTo(User::class, 'client_id'); }
    public function items() { return $this->hasMany(OrderProduct::class); }

    /* Scopes */
    public function scopeStatus(Builder $q, ?string $status): Builder {
        return $status ? $q->where('order_status', $status) : $q;
    }
    public function scopePaid(Builder $q, ?string $status): Builder {
        return $status ? $q->where('payment_status', $status) : $q;
    }
    public function scopeMethod(Builder $q, ?string $method): Builder {
        return $method ? $q->where('payment_method', $method) : $q;
    }
    public function scopeVerified(Builder $q, ?bool $bool): Builder {
        return is_null($bool) ? $q : $q->where('is_verified', $bool);
    }
}
