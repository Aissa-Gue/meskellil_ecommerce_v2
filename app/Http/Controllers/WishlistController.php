<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WishlistController extends Controller
{
     public function index()
    {
        $breadcrumbData = [
            'title' => 'Wishlist',
            'bgColor' => '#EFF1F5',
            'breadcrumbs' => [
                [
                    'name' => 'Home',
                    'url' => route('home')
                ],
                [
                    'name' => 'Wishlist',
                    'url' => null
                ]
            ]
        ];

        return view('wishlist.index', compact('breadcrumbData'));
    }
}
