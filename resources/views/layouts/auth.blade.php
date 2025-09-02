@extends('layouts.app')

@section('content')
    {{-- @include('components.area.off-canvas-area')
    @include('components.area.mobile-menu-area')
    @include('components.search-area')
    @include('components.area.cart-mini-area')
    @include('components.area.general-header-area') --}}
    
    <main>
        <!-- breadcrumb area start -->
        @if(isset($breadcrumbData))
            @include('components.breadcrumb-auth', ['breadcrumbData' => $breadcrumbData])
        @else
            <section class="breadcrumb__area include-bg text-center pt-95 pb-50">
                <div class="container">
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="breadcrumb__content p-relative z-index-1">
                                  @yield('auth-header')
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        <!-- breadcrumb area end -->

        <!-- login area start -->
        <section class="tp-login-area pb-140 p-relative z-index-1 fix">
            <div class="tp-login-shape">
                <img class="tp-login-shape-1" src="{{ asset('assets/img/login/login-shape-1.png') }}" alt="">
                <img class="tp-login-shape-2" src="{{ asset('assets/img/login/login-shape-2.png') }}" alt="">
                <img class="tp-login-shape-3" src="{{ asset('assets/img/login/login-shape-3.png') }}" alt="">
                <img class="tp-login-shape-4" src="{{ asset('assets/img/login/login-shape-4.png') }}" alt="">
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-8">
                         
                         
                        <div class="tp-login-wrapper">
                              @yield('auth-wrapper')
                              
                              @if (session('status'))
                                   <div class="alert alert-success mt-3">
                                        {{ session('status') }}
                                   </div>
                              @endif
                              
                              @if ($errors->any())
                                   <div class="alert alert-danger mt-3">
                                        @foreach ($errors->all() as $error)
                                             <p class="mb-0">{{ $error }}</p>
                                        @endforeach
                                   </div>
                              @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- login area end -->
    </main>

    {{-- @include('components.footer') --}}
@endsection
