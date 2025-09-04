@extends('layouts.app')

@section('content')

    {{-- @include('components.area.off-canvas-area')
    @include('components.area.mobile-menu-area')
    @include('components.search-area')
    @include('components.area.cart-mini-area')
    @include('components.area.general-header-area') --}}


     <main>
          <!-- error area start -->
          <section class="tp-error-area pt-110 pb-110">
               <div class="container">
                    <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-8 col-md-10">
                         <div class="tp-error-content text-center">
                         <div class="tp-error-thumb">
                              <img src="/assets/img/error/error.png" 
                              width="400"
                              alt="">
                         </div>

                         <h3 class="tp-error-title">{{ __('header.oops_page_not_found') }}</h3>
                         <p>{{ __('header.page_not_found_message') }}</p>

                         <a href="/" class="tp-error-btn">{{ __('header.back_to_home') }}</a>
                         </div>
                    </div>
                    </div>
               </div>
          </section>
          <!-- error area end -->

     </main>

    {{-- @include('components.footer') --}}
@endsection
