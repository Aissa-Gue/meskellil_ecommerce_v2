<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');

Route::get('/cart', [App\Http\Controllers\OrderController::class, 'cart'])->name('cart');
Route::get('/wishlist', [App\Http\Controllers\OrderController::class, 'wishlist'])->name('wishlist');
Route::get('/checkout', [App\Http\Controllers\OrderController::class, 'checkout'])->name('checkout');
Route::get('/order-success', [App\Http\Controllers\OrderController::class, 'order-success'])->name('order-success');

Route::resource('products', ProductController::class)->only(['index','show']);

//Route::resource('brands', BrandController::class)->only(['index','show','store','update','destroy']);
//Route::resource('categories', CategoryController::class)->only(['index','show','store','update','destroy']);
//Route::resource('orders', OrderController::class)->only(['index','show','store','update','destroy']);
//Route::resource('users', UserController::class)->only(['index','show']);
