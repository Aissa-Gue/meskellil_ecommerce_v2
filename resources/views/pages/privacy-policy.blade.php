@extends('layouts.app')

@section('content')

    @include('components.area.off-canvas-area')
    @include('components.area.mobile-menu-area')
    @include('components.search-area')
    @include('components.area.cart-mini-area')
    @include('components.area.general-header-area')


    <main>
        @include('components.breadcrumb2', $breadcrumbData)

        <section class="tp-contact-area pb-100">
            <div class="container">
                <div class="tp-contact-inner">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="tp-contact-wrapper">
                                <h3 class="tp-contact-title">{{ __('header.privacy_policy') }}</h3>
                                <div class="tp-contact-form">
                                    <p>This is the Privacy Policy page. You can add your content here.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    @include('components.footer')
@endsection
