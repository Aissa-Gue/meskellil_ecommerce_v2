<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Carbon\Carbon;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index(ProductService $productService)
    {
        // Fake a request with filters
        $newestProductsFilter = new Request([
            'filter' => [
                'is_active' => true,
                'created_after_date' => Carbon::now()->subMonth()->toDateString()
            ]
        ]);
        $bestSellingProductsFilter = new Request([
            'filter' => [
                'is_active' => true
            ]
        ]);
        $discountedProductsFilter = new Request([
            'filter' => [
                'is_active' => true,
                'discount_greater_than' => 0
            ]
        ]);

        $newestProducts = $productService->getFilteredProducts($newestProductsFilter)
            ->orderByDesc('id')
            ->limit(8)
            ->get();

        $bestSellingProducts = $productService->getFilteredProducts($bestSellingProductsFilter)
            ->join('order_products', 'products.id', '=', 'order_products.product_id')
            ->selectRaw('products.*, SUM(order_products.qte) as total_sold')
            ->groupBy('products.id')
            ->orderByDesc('total_sold')
            ->limit(8)
            ->get();

        $discountedProducts = $productService->getFilteredProducts($discountedProductsFilter)
            ->orderByDesc('discount')
            ->limit(8)
            ->get();

        $categories = \App\Models\Category::all();
        $products=$newestProducts;

        return view('home', compact(['newestProducts', 'bestSellingProducts', 'discountedProducts', 'products', 'categories']));
    }

    public function contact()
    {
        $breadcrumbData = [
            'title' => 'Checkout',
            'bgColor' => '#EFF1F5',
            'breadcrumbs' => [
                [
                    'name' => 'Home',
                    'url' => route('home')
                ],
                [
                    'name' => 'Shop',
                    'url' => route('products.index')
                ],
                [
                    'name' => 'Checkout',
                    'url' => null // Current page, no URL needed
                ]
            ]
        ];

        return view('contact')->with(compact('breadcrumbData'));
    }

}
