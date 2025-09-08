<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Carbon\Carbon;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index(ProductService $productService)
    {
        // Load slider data from JSON file
        $sliderDataPath = public_path('data/slider-data.json');
        $sliderData = [];
        if (file_exists($sliderDataPath)) {
            $sliderData = json_decode(file_get_contents($sliderDataPath), true);
        }

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

        // Get featured products (products with higher prices or specific characteristics)
        $featuredProductsFilter = new Request([
            'filter' => [
                'is_active' => true,
                'price1_min' => 100 // Featured products are higher-priced items
            ]
        ]);
        
        $featuredProducts = $productService->getFilteredProducts($featuredProductsFilter)
            ->orderByDesc('price1')
            ->limit(8)
            ->get();
            
        // If no featured products, get products with stock > 10 (popular items)
        if ($featuredProducts->isEmpty()) {
            $featuredProductsFilter = new Request([
                'filter' => [
                    'is_active' => true,
                    'instock' => true
                ]
            ]);
            $featuredProducts = $productService->getFilteredProducts($featuredProductsFilter)
                ->where('stock', '>', 10)
                ->orderByDesc('stock')
                ->limit(8)
                ->get();
        }

        $discountedProducts = $productService->getFilteredProducts($discountedProductsFilter)
            ->orderByDesc('discount')
            ->limit(8)
            ->get();

        // Fetch top-level categories and eager load children recursively (2 levels by default)
        // We'll eager load multiple levels by using nested with: children, children.children, etc.
        $categories = \App\Models\Category::whereNull('parent_id')
            ->with(['children', 'children.children'])
            ->orderBy('name')
            ->get();
        $products = $newestProducts;

        // Get products by category for featured categories
        $featuredCategories = $categories->take(3); // Show first 3 categories
        $categoryProducts = [];

        foreach ($featuredCategories as $category) {
            $categoryProducts[$category->id] = \App\Models\Product::where('category_id', $category->id)
                ->where('is_active', true)
                ->limit(4)
                ->get();
        }

        // Get banner products for banner_area (2 featured products with high discounts)
        $bannerProducts = \App\Models\Product::where('is_active', true)
            ->where('discount', '>', 15) // Products with more than 15% discount
            ->with(['brand', 'category'])
            ->orderByDesc('discount')
            ->limit(2)
            ->get();

        // If no discounted products, get featured products instead
        if ($bannerProducts->count() < 2) {
            $bannerProducts = $featuredProducts->take(2);
        }

        // Get promotional banner products for product_banner_area (3 products for slider)
        $promotionalProducts = \App\Models\Product::where('is_active', true)
            ->where('discount', '>', 0)
            ->with(['brand', 'category'])
            ->orderByDesc('discount')
            ->limit(3)
            ->get();

        // If no promotional products, get newest products instead
        if ($promotionalProducts->count() < 3) {
            $promotionalProducts = $newestProducts->take(3);
        }

        return view('home', compact(['newestProducts', 'featuredProducts', 'bestSellingProducts', 'discountedProducts', 'products', 'categories', 'categoryProducts', 'sliderData', 'bannerProducts', 'promotionalProducts']));
    }

    public function contact()
    {
        $breadcrumbData = [
            'title' => 'Contact Us',
            'bgColor' => '#EFF1F5',
            'breadcrumbs' => [
                [
                    'name' => 'Home',
                    'url' => route('home')
                ],
                [
                    'name' => 'Contact',
                    'url' => null // Current page, no URL needed
                ]
            ]
        ];

        return view('contact')->with(compact('breadcrumbData'));
    }
}