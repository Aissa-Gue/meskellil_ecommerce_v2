<?php

namespace App\Http\Controllers;

use App\QueryFilters\OrderFilters;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class OrderController extends Controller
{
    public function index(Request $request, OrderService $orderService)
    {
        $orders = QueryBuilder::for(Order::with('client', 'items.product'))
            ->allowedFilters([
                AllowedFilter::exact('product_id'),
                AllowedFilter::exact('client_id'),
                'client_name',
                'client_phone',
                AllowedFilter::exact('wilaya_id'),
                'payment_status',
                'payment_method',
                'order_status',
                'notes',
                'is_verified',
            ])
            ->allowedSorts([
                'id',
                'client_name',
                'payment_status',
                'order_status',
                'created_at',
            ])
            ->allowedIncludes(['products', 'client'])
            ->paginate(25);

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['client', 'items.product']);
        return view('orders.show', compact('order'));
    }

    public function store(Request $request)
    {
        $payload = $request->validate([
            'client_id' => 'nullable|exists:users,id',
            'client_name' => 'nullable|string|max:255',
            'client_phone' => 'nullable|string|max:50',
            'wilaya_id' => 'nullable|integer|min:1|max:58',
            'payment_status' => 'required|in:full_paid,partial_paid,pending',
            'payment_method' => 'required|in:cash,ccp,bank_transfer',
            'is_verified' => 'boolean',
            'order_status' => 'in:pending,confirmed,processing,shipped,delivered,canceled',
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.qte' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        return DB::transaction(function () use ($payload) {
            $order = Order::create(collect($payload)->except('items')->toArray());

            $total = 0;
            foreach ($payload['items'] as $line) {
                $product = Product::find($line['product_id']);
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'qte' => $line['qte'],
                    'price' => $line['price'],
                ]);
                $total += $line['price'] * $line['qte'];

                // optional: decrease stock
                $product->decrement('stock', $line['qte']);
            }
            $order->update(['total_price' => $total]);

            return redirect()->route('orders.show', $order);
        });
    }

    public function update(Request $request, Order $order)
    {
        $payload = $request->validate([
            'payment_status' => 'in:full_paid,partial_paid,pending',
            'payment_method' => 'in:cash,ccp,bank_transfer',
            'is_verified' => 'boolean',
            'order_status' => 'in:pending,confirmed,processing,shipped,delivered,canceled',
            'notes' => 'nullable|string',
        ]);

        $order->update($payload);
        return back();
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return back();
    }
}
