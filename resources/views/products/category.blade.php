@extends('layouts.app')

@section('title', $category->name . ' - Products')

@section('content')
    <!-- breadcrumb area start -->
    @include('components.breadcrumb2', ['breadcrumbData' => $breadcrumbData])
    <!-- breadcrumb area end -->

    <!-- category products area start -->
    @include('components.category-products', [
        'products' => $products,
        'category' => $category,
        'title' => $category->name . ' Products',
        'subtitle' => 'Shop by Category'
    ])
    <!-- category products area end -->

    <!-- pagination area start -->
    @if($products->hasPages())
    <div class="tp-pagination-area">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="tp-pagination-wrapper text-center">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- pagination area end -->



    @include('components.footer')
@endsection
