<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');

Route::get('/cart', [App\Http\Controllers\OrderController::class, 'cart'])->name('cart');
Route::get('/wishlist', [App\Http\Controllers\OrderController::class, 'wishlist'])->name('wishlist');
Route::get('/checkout', [App\Http\Controllers\OrderController::class, 'checkout'])->name('checkout');
Route::get('/order-success', [App\Http\Controllers\OrderController::class, 'order-success'])->name('order-success');

Route::resource('products', ProductController::class)->only(['index', 'show']);
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/api/products/{product}/quick-view', [ProductController::class, 'quickView'])->name('products.quick-view');

// Category-based product routes
Route::get('/category/{category}/products', [ProductController::class, 'showByCategory'])->name('products.by-category');
Route::get('/api/category/{category}/products', [ProductController::class, 'getCategoryProducts'])->name('api.category.products');

// Auth routes
Route::get('login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [App\Http\Controllers\AuthController::class, 'login']);
Route::post('logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
Route::get('register', [App\Http\Controllers\AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [App\Http\Controllers\AuthController::class, 'register']);

// Password reset routes
Route::get('forgot-password', [App\Http\Controllers\PasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [App\Http\Controllers\PasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [App\Http\Controllers\PasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [App\Http\Controllers\PasswordController::class, 'reset'])->name('password.update');

//Route::resource('brands', BrandController::class)->only(['index','show','store','update','destroy']);
//Route::resource('categories', CategoryController::class)->only(['index','show','store','update','destroy']);
//Route::resource('orders', OrderController::class)->only(['index','show','store','update','destroy']);
// Route::resource('users', UserController::class)->only(['index','show']);

Route::get('profile', [UserController::class, 'profile'])->name('profile.show');

// route that catches any get request
Route::get('{any}', function () {
    return view('404');
})->where('any', '.*');