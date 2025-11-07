<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/test-sheet', [App\Http\Controllers\ProductController::class, 'indexSheet'])->name('test-sheet');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');

// Static pages
Route::get('/our-story', [PageController::class, 'ourStory'])->name('pages.our-story');
Route::get('/privacy-policy', [PageController::class, 'privacyPolicy'])->name('pages.privacy-policy');
Route::get('/terms-conditions', [PageController::class, 'termsConditions'])->name('pages.terms-conditions');

// Language switching route
Route::post('/language/switch', [LanguageController::class, 'switch'])->name('language.switch');

Route::get('/cart', [App\Http\Controllers\OrderController::class, 'cart'])->name('cart');
Route::get('/wishlist', [App\Http\Controllers\OrderController::class, 'wishlist'])->name('wishlist');
Route::get('/checkout', [App\Http\Controllers\OrderController::class, 'checkout'])->name('checkout');

Route::resource('products', ProductController::class)->only(['index', 'show']);
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/api/products/{product}/quick-view', [ProductController::class, 'quickView'])->name('products.quick-view');

// Category-based product routes
Route::get('/category/{category}/products', [ProductController::class, 'showByCategory'])->name('products.by-category');
Route::get('/api/category/{category}/products', [ProductController::class, 'getCategoryProducts'])->name('api.category.products');

// Auth routes - protected by guest middleware to redirect logged-in users
Route::middleware('guest')->group(function () {
    Route::get('login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [App\Http\Controllers\AuthController::class, 'login']);
    Route::get('register', [App\Http\Controllers\AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [App\Http\Controllers\AuthController::class, 'register']);

    // Password reset routes
    Route::get('forgot-password', [App\Http\Controllers\PasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('forgot-password', [App\Http\Controllers\PasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('reset-password/{token}', [App\Http\Controllers\PasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('reset-password', [App\Http\Controllers\PasswordController::class, 'reset'])->name('password.update');


    Route::get('auth/google', [App\Http\Controllers\GoogleController::class, 'redirect'])->name('google.login');
    Route::get('auth/google/callback', [App\Http\Controllers\GoogleController::class, 'callback']);
});

// Logout route - only accessible by authenticated users
Route::post('logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout')->middleware('auth');

//Route::resource('brands', BrandController::class)->only(['index','show','store','update','destroy']);
//Route::resource('categories', CategoryController::class)->only(['index','show','store','update','destroy']);
//Route::resource('orders', OrderController::class)->only(['index','show','store','update','destroy']);
// Route::resource('users', UserController::class)->only(['index','show']);

Route::middleware('auth')->group(function () {
    Route::get('profile', [UserController::class, 'profile'])->name('profile.show');
    Route::post('profile', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::post('profile/password', [UserController::class, 'updatePassword'])->name('profile.password.update');
});

// Orders: store and show (store used by frontend checkout form)
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
Route::get('/order-success/{order}', [OrderController::class, 'orderSuccess'])->name('orders.success');

Route::get('/api/wilayas', fn() => \Kossa\AlgerianCities\Wilaya::select('id', 'name', 'arabic_name')->get());
Route::get('/api/wilayas/{wilaya}/communes', fn(\Kossa\AlgerianCities\Wilaya $wilaya) => $wilaya->communes()->select('id', 'name', 'arabic_name')->get());
Route::get('/api/wilayas/{wilaya_id}/shipping', function($wilaya_id) {
    $price = \App\Models\WilayaShipping::where('wilaya_id', $wilaya_id)->value('shipping_price');
    return response()->json(['shipping_price' => $price]);
});

// route that catches any get request
Route::get('{any}', function () {
    return view('404');
})->where('any', '.*');
