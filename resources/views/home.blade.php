@extends('layouts.app')

@section('content')

    @include('components.area.off-canvas-area')
    @include('components.area.mobile-menu-area')
    @include('components.search-area')
    @include('components.area.cart-mini-area')
    @include('components.area.home-header-area')


    <main>
        @include('components.slider_area')
        @include('components.area.product_category_area')
        @include('components.area.feature_area')
        @include('components.area.product_area')
        @include('components.area.banner_area')
        {{--
        @include('components.product_deal_area')
        @include('components.banners_with_products_area')
        --}}
        @include('components.area.product_banner_area')
        @include('components.area.product_new_arrival_area')

        {{--
        @include('components.product_sm_area')
        @include('components.blog_area')
        @include('components.instagram_area')
        @include('components.newsletter')
         --}}

        @include('components.product-quick-view-modal')
    </main>

@endsection
