<!-- slider area start -->
<style>
    .slider-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, rgba(0,0,0,0.4) 0%, rgba(0,0,0,0.2) 100%);
        z-index: 1;
    }
    .tp-slider-item {
        position: relative;
        min-height: 600px;
        display: flex;
        align-items: center;
    }
    .tp-slider-content {
        position: relative;
        z-index: 2;
    }
    .tp-slider-title {
        color: white;
        font-size: 3rem;
        font-weight: bold;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        margin-bottom: 1rem;
    }
    .tp-slider-subtitle {
        color: white;
        font-size: 1.5rem;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
        margin-bottom: 1.5rem;
    }
</style>

<section class="tp-slider-area p-relative z-index-1">
    <div class="tp-slider-active tp-slider-variation swiper-container">
        <div class="swiper-wrapper">
            @if(isset($sliderImages) && count($sliderImages) > 0)
                @foreach($sliderImages as $slide)
                    <div class="tp-slider-item tp-slider-height swiper-slide" style="background-image: url('{{ $slide->image_url }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                        {{-- <div class="slider-overlay"></div>
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-xl-12">
                                    <div class="tp-slider-content p-relative z-index-1 text-center">
                                        @if($slide->title)
                                            <h1 class="tp-slider-title">{{ $slide->title }}</h1>
                                        @endif
                                        @if($slide->subtitle)
                                            <p class="tp-slider-subtitle">{{ $slide->subtitle }}</p>
                                        @endif
                                        @if($slide->link_url)
                                            <div class="tp-slider-btn mt-4">
                                                <a href="{{ $slide->link_url }}" class="tp-btn tp-btn-2 tp-btn-white">{{ __('header.shop_now') }}
                                                    <svg width="17" height="14" viewBox="0 0 17 14" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M16 6.99976L1 6.99976" stroke="currentColor" stroke-width="1.5"
                                                              stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path d="M9.9502 0.975414L16.0002 6.99941L9.9502 13.0244"
                                                              stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                              stroke-linejoin="round"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                @endforeach
            @else
                <!-- Fallback slide if no data is available -->
                <div class="tp-slider-item tp-slider-height swiper-slide" style="background-image: url('https://images.unsplash.com/photo-1556910103-1c02745aae4d?w=1920&h=600&fit=crop&crop=center'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                    <div class="slider-overlay"></div>
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-xl-12">
                                <div class="tp-slider-content p-relative z-index-1 text-center">
                                    <h1 class="tp-slider-title">{{ __('header.default_slider_title', ['default' => 'Welcome to Our Store']) }}</h1>
                                    <p class="tp-slider-subtitle">{{ __('header.exclusive_offer') }} -25% off this week</p>
                                    <div class="tp-slider-btn mt-4">
                                        <a href="/shop" class="tp-btn tp-btn-2 tp-btn-white">{{ __('header.shop_now') }}
                                            <svg width="17" height="14" viewBox="0 0 17 14" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M16 6.99976L1 6.99976" stroke="currentColor" stroke-width="1.5"
                                                      stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M9.9502 0.975414L16.0002 6.99941L9.9502 13.0244"
                                                      stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                      stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="tp-slider-arrow tp-swiper-arrow d-none d-lg-block">
            <button type="button" class="tp-slider-button-prev">
                <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7 13L1 7L7 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                          stroke-linejoin="round"/>
                </svg>
            </button>
            <button type="button" class="tp-slider-button-next">
                <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 13L7 7L1 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                          stroke-linejoin="round"/>
                </svg>
            </button>
        </div>
        <div class="tp-slider-dot tp-swiper-dot"></div>
    </div>
</section>
<!-- slider area end -->
