<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class cartController extends Controller
{
    public function index()
    {
        $breadcrumbData = [
            'title' => 'Shopping Cart',
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
                    'url' => null
                ]
            ]
        ];

        return view('cart.index', compact('breadcrumbData'));
    }
}
