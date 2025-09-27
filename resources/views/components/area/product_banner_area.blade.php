
         <!-- product banner area start -->
<div class="pb-40">
    <div class="container">
        <div class="tp-product-banner-slider tp-product-banner-slider-active swiper-container">
            <div class="swiper-wrapper">
                @if(isset($bannerProductImages) && $bannerProductImages->count() > 0)
                    @foreach($bannerProductImages as $banner)
                    <div class="swiper-slide">
                        <div class="tp-banner-item tp-banner-height p-relative z-index-1 fix rounded-2xl overflow-hidden"
                            style="min-height:400px;"
                            <a href="{{ $banner->link_url ?: '#' }}">
                                <div class="tp-banner-thumb include-bg transition-3" 
                                     data-background="{{ $banner->image_url }}" 
                                     style="width: 100%;"></div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                @else
                    <!-- Fallback static content -->
                    <div class="swiper-slide">
                        <div class="tp-banner-item tp-banner-height p-relative z-index-1 fix rounded-2xl overflow-hidden">
                            <a href="#">
                                <div class="tp-banner-thumb include-bg transition-3" 
                                     data-background="assets/img/banner/banner-slider-1.png" 
                                     style="width: 100%;"></div>
                            </a>
                        </div>
                    </div>
                @endif
            </div>
            <div class="tp-product-banner-slider-dot tp-swiper-dot"></div>
        </div>
    </div>
</div>
<!-- product banner area end -->