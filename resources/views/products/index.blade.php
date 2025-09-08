@extends('layouts.app')

@section('content')

    <!-- offcanvas area start -->
    <div class="offcanvas__area offcanvas__radius">
        <div class="offcanvas__wrapper">
            <div class="offcanvas__close">
                <button class="offcanvas__close-btn offcanvas-close-btn">
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11 1L1 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M1 1L11 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
            <div class="offcanvas__content">
                <div class="offcanvas__top mb-70 d-flex justify-content-between align-items-center">
                    <div class="offcanvas__logo logo">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('public/assets/img/logo/logo.svg') }}" alt="logo">
                        </a>
                    </div>
                </div>
                <div class="tp-main-menu-mobile fix d-lg-none mb-40"></div>

                <div class="offcanvas__category pb-40">
                    <button class="tp-offcanvas-category-toggle">
                        <i class="fa-solid fa-bars"></i>
                        {{ __('header.all_categories') }}
                    </button>
                    <div class="tp-category-mobile-menu">
                        <nav class="tp-category-menu-content">
                            <ul>
                                @foreach($categories as $category)
                                    <li><a href="{{ route('products.index', ['filter[category_id]' => $category->id]) }}">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                        </nav>
                    </div>
                </div>

                <!-- Filter Form for Offcanvas -->
                <form id="offcanvas-filters-form">
                    @csrf
                    @include('components.filters.price-filter', ['priceRange' => $priceRange])
                    @include('components.filters.status-filter', ['statusCounts' => $statusCounts])
                    @include('components.filters.category-filter', ['categories' => $categories])
                    @if(isset($brands) && $brands->count() > 0)
                        @include('components.filters.brand-filter', ['brands' => $brands])
                    @endif
                </form>
            </div>
        </div>
    </div>
    <div class="body-overlay"></div>
    <!-- offcanvas area end -->

    @include('components.search-area')
    @include('components.area.cart-mini-area')
    @include('components.area.general-header-area')


    <!-- filter offcanvas area start -->
    <div class="tp-filter-offcanvas-area">
        <div class="tp-filter-offcanvas-wrapper">
            <div class="tp-filter-offcanvas-close">
                <button type="button" class="tp-filter-offcanvas-close-btn filter-close-btn">
                    <i class="fa-solid fa-xmark"></i>
                    {{ __('header.close') }}
                </button>
            </div>
            <div class="tp-shop-sidebar">
                <form id="product-filters-form-offcanvas">
                    @csrf
                    @include('components.filters.price-filter', ['suffix' => '-offcanvas', 'priceRange' => $priceRange])
                    @include('components.filters.status-filter', ['suffix' => '2', 'statusCounts' => $statusCounts])
                    @include('components.filters.category-filter', ['categories' => $categories])
                    @if(isset($brands) && $brands->count() > 0)
                        @include('components.filters.brand-filter', ['suffix' => '2', 'brands' => $brands])
                    @endif
                </form>
            </div>
        </div>
    </div>
    <!-- filter offcanvas area end -->

    <main>
        @include('components.breadcrumb2', $breadcrumbData)

        <!-- shop area start -->
        <section class="tp-shop-area pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-4">
                        <div class="tp-shop-sidebar mr-10">
                            <form id="product-filters-form">
                                @csrf
                                @include('components.filters.price-filter', ['priceRange' => $priceRange])
                                @include('components.filters.status-filter', ['statusCounts' => $statusCounts])
                                @include('components.filters.category-filter', ['categories' => $categories])
                                @if(isset($brands) && $brands->count() > 0)
                                    @include('components.filters.brand-filter', ['brands' => $brands])
                                @endif
                            </form>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-8">
                        <div class="tp-shop-main-wrapper">

                            <div class="tp-shop-top mb-45">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="tp-shop-top-left d-flex align-items-center ">
                                            <div class="tp-shop-top-tab tp-tab">
                                                <ul class="nav nav-tabs" id="productTab" role="tablist">
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link active" id="grid-tab"
                                                                data-bs-toggle="tab" data-bs-target="#grid-tab-pane"
                                                                type="button" role="tab" aria-controls="grid-tab-pane"
                                                                aria-selected="true">
                                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                                 xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M16.3327 6.01341V2.98675C16.3327 2.04675 15.906 1.66675 14.846 1.66675H12.1527C11.0927 1.66675 10.666 2.04675 10.666 2.98675V6.00675C10.666 6.95341 11.0927 7.32675 12.1527 7.32675H14.846C15.906 7.33341 16.3327 6.95341 16.3327 6.01341Z"
                                                                      stroke="currentColor" stroke-width="1.5"
                                                                      stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M16.3327 15.18V12.4867C16.3327 11.4267 15.906 11 14.846 11H12.1527C11.0927 11 10.666 11.4267 10.666 12.4867V15.18C10.666 16.24 11.0927 16.6667 12.1527 16.6667H14.846C15.906 16.6667 16.3327 16.24 16.3327 15.18Z"
                                                                      stroke="currentColor" stroke-width="1.5"
                                                                      stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M7.33268 6.01341V2.98675C7.33268 2.04675 6.90602 1.66675 5.84602 1.66675H3.15268C2.09268 1.66675 1.66602 2.04675 1.66602 2.98675V6.00675C1.66602 6.95341 2.09268 7.32675 3.15268 7.32675H5.84602C6.90602 7.33341 7.33268 6.95341 7.33268 6.01341Z"
                                                                      stroke="currentColor" stroke-width="1.5"
                                                                      stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M7.33268 15.18V12.4867C7.33268 11.4267 6.90602 11 5.84602 11H3.15268C2.09268 11 1.66602 11.4267 1.66602 12.4867V15.18C1.66602 16.24 2.09268 16.6667 3.15268 16.6667H5.84602C6.90602 16.6667 7.33268 16.24 7.33268 15.18Z"
                                                                      stroke="currentColor" stroke-width="1.5"
                                                                      stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                        </button>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link" id="list-tab" data-bs-toggle="tab"
                                                                data-bs-target="#list-tab-pane" type="button" role="tab"
                                                                aria-controls="list-tab-pane" aria-selected="false">
                                                            <svg width="16" height="15" viewBox="0 0 16 15" fill="none"
                                                                 xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M15 7.11108H1" stroke="currentColor"
                                                                      stroke-width="2" stroke-linecap="round"
                                                                      stroke-linejoin="round"/>
                                                                <path d="M15 1H1" stroke="currentColor" stroke-width="2"
                                                                      stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M15 13.2222H1" stroke="currentColor"
                                                                      stroke-width="2" stroke-linecap="round"
                                                                      stroke-linejoin="round"/>
                                                            </svg>
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="tp-shop-top-result">
                                                <p>Showing {{ $products->firstItem() ?? 0 }}–{{ $products->lastItem() ?? 0 }} of {{ $products->total() }} results</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="tp-shop-top-right d-sm-flex align-items-center justify-content-xl-end">
                                            <div class="tp-shop-top-select">
                                                <select id="sortSelect" onchange="handleSortChange(this.value)">
                                                    <option value="" {{ request('sort') == '' ? 'selected' : '' }}>{{ __('header.default_sorting') }}</option>
                                                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>{{ __('header.price_low_to_high') }}</option>
                                                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>{{ __('header.price_high_to_low') }}</option>
                                                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>{{ __('header.newest_first') }}</option>
                                                    <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>{{ __('header.name_a_to_z') }}</option>
                                                    <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>{{ __('header.name_z_to_a') }}</option>
                                                </select>
                                            </div>
                                            <div class="tp-shop-top-filter">
                                                <button type="button" class="tp-filter-btn filter-open-btn">
                                          <span>
                                             <svg width="16" height="15" viewBox="0 0 16 15" fill="none"
                                                  xmlns="http://www.w3.org/2000/svg">
                                                <path d="M14.9998 3.45001H10.7998" stroke="currentColor"
                                                      stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                                      stroke-linejoin="round"/>
                                                <path d="M3.8 3.45001H1" stroke="currentColor" stroke-width="1.5"
                                                      stroke-miterlimit="10" stroke-linecap="round"
                                                      stroke-linejoin="round"/>
                                                <path d="M6.5999 5.9C7.953 5.9 9.0499 4.8031 9.0499 3.45C9.0499 2.0969 7.953 1 6.5999 1C5.2468 1 4.1499 2.0969 4.1499 3.45C4.1499 4.8031 5.2468 5.9 6.5999 5.9Z"
                                                      stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10"
                                                      stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M15.0002 11.15H12.2002" stroke="currentColor"
                                                      stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"
                                                      stroke-linejoin="round"/>
                                                <path d="M5.2 11.15H1" stroke="currentColor" stroke-width="1.5"
                                                      stroke-miterlimit="10" stroke-linecap="round"
                                                      stroke-linejoin="round"/>
                                                <path d="M9.4002 13.6C10.7533 13.6 11.8502 12.5031 11.8502 11.15C11.8502 9.79691 10.7533 8.70001 9.4002 8.70001C8.0471 8.70001 6.9502 9.79691 6.9502 11.15C6.9502 12.5031 8.0471 13.6 9.4002 13.6Z"
                                                      stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10"
                                                      stroke-linecap="round" stroke-linejoin="round"/>
                                             </svg>
                                          </span>
                                                    Filter
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tp-shop-items-wrapper tp-shop-item-primary">
                                <div class="tab-content" id="productTabContent">
                                    <div class="tab-pane fade show active" id="grid-tab-pane" role="tabpanel"
                                         aria-labelledby="grid-tab" tabindex="0">
                                        <div id="products-container">
                                            @include('products.partials.product-grid', ['products' => $products])
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="list-tab-pane" role="tabpanel"
                                         aria-labelledby="list-tab" tabindex="0">
                                        <div id="products-list-container">
                                            @include('products.partials.product-list', ['products' => $products])
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Pagination -->
                                <div id="pagination-container">
                                    @include('components.pagination', ['paginator' => $products])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- shop area end -->
    </main>

    @include('components.footer')

    <!-- JavaScript includes -->
    <script src="{{ asset('public/assets/js/product-filters-fixed.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new ProductFilters();
        });

        function handleSortChange(sortValue) {
            // Get the active tab container
            const activeTab = document.querySelector('.tab-pane.active');
            if (!activeTab) return;
            
            const productContainer = activeTab.querySelector('.row');
            if (!productContainer) return;

            const products = Array.from(productContainer.children);
            
            // Sort products based on selected value
            products.sort((a, b) => {
                switch(sortValue) {
                    case 'price_asc':
                        return getProductPrice(a) - getProductPrice(b);
                    case 'price_desc':
                        return getProductPrice(b) - getProductPrice(a);
                    case 'name_asc':
                        return getProductName(a).localeCompare(getProductName(b));
                    case 'name_desc':
                        return getProductName(b).localeCompare(getProductName(a));
                    case 'newest':
                        return getProductDate(b) - getProductDate(a);
                    default:
                        return 0; // Keep original order
                }
            });
            
            // Clear container and re-append sorted products
            productContainer.innerHTML = '';
            products.forEach(product => productContainer.appendChild(product));
        }

        function getProductPrice(productElement) {
            // Look for price in both grid and list item formats
            const priceElement = productElement.querySelector(
                '.tp-product-price-2.new-price, .tp-product-price.new-price, .tp-product-price-wrapper span:first-child, .tp-product-price-wrapper-2 .new-price'
            );
            if (!priceElement) return 0;
            
            const priceText = priceElement.textContent.replace(/[^0-9.]/g, '');
            return parseFloat(priceText) || 0;
        }

        function getProductName(productElement) {
            // Look for product name in both grid and list formats
            const nameElement = productElement.querySelector(
                '.tp-product-title-2 a, .tp-product-title a, h3 a'
            );
            return nameElement ? nameElement.textContent.trim() : '';
        }

        function getProductDate(productElement) {
            // Use DOM order as proxy for date since we don't have actual dates
            return Array.from(productElement.parentNode.children).indexOf(productElement);
        }
    </script>
@endsection
