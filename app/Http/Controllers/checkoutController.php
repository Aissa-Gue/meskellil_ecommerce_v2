<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class checkoutController extends Controller
{
    public function index()
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
                    'name' => 'Cart',
                    'url' => route('cart.index')
                ],
                [
                    'name' => 'Checkout',
                    'url' => null
                ]
            ]
        ];

        return view('checkout.index', compact('breadcrumbData'));
    }
}
