     <!-- banner area start -->
        <section class="tp-banner-area pb-20">
           <div class="container">
              <div class="row">
                 @if(isset($bannerSmallImages) && $bannerSmallImages->count() >= 2)
                 <div class="col-xl-8 col-lg-7">
                    <div class="tp-banner-item tp-banner-height p-relative mb-30 z-index-1 fix">
                       <a href="{{ $bannerSmallImages[0]->link_url ?: '#' }}">
                          <div class="tp-banner-thumb include-bg transition-3" data-background="{{ $bannerSmallImages[0]->image_url }}" style="height: 280px; width: 100%;"></div>
                       </a>
                    </div>
                 </div>
                 <div class="col-xl-4 col-lg-5">
                    <div class="tp-banner-item tp-banner-item-sm tp-banner-height p-relative mb-30 z-index-1 fix">
                       <a href="{{ $bannerSmallImages[1]->link_url ?: '#' }}">
                          <div class="tp-banner-thumb include-bg transition-3" data-background="{{ $bannerSmallImages[1]->image_url }}" style="height: 280px; width: 100%;"></div>
                       </a>
                    </div>
                 </div>
                 @elseif(isset($bannerMediumImages) && $bannerMediumImages->count() >= 1)
                 <!-- Fallback to medium banner if no small banners -->
                 <div class="col-xl-8 col-lg-7">
                    <div class="tp-banner-item tp-banner-height p-relative mb-30 z-index-1 fix">
                       <a href="{{ $bannerMediumImages[0]->link_url ?: '#' }}">
                          <div class="tp-banner-thumb include-bg transition-3" data-background="{{ $bannerMediumImages[0]->image_url }}" style="height: 280px; width: 100%;"></div>
                       </a>
                    </div>
                 </div>
                 <div class="col-xl-4 col-lg-5">
                    <div class="tp-banner-item tp-banner-item-sm tp-banner-height p-relative mb-30 z-index-1 fix">
                       <div class="tp-banner-thumb include-bg transition-3" data-background="assets/img/product/banner/product-banner-2.jpg" style="height: 280px; width: 100%;"></div>
                    </div>
                 </div>
                 @else
                 <!-- Fallback static content if no banner images -->
                 <div class="col-xl-8 col-lg-7">
                    <div class="tp-banner-item tp-banner-height p-relative mb-30 z-index-1 fix">
                       <div class="tp-banner-thumb include-bg transition-3" data-background="assets/img/product/banner/product-banner-1.jpg" style="height: 280px; width: 100%;"></div>
                    </div>
                 </div>
                 <div class="col-xl-4 col-lg-5">
                    <div class="tp-banner-item tp-banner-item-sm tp-banner-height p-relative mb-30 z-index-1 fix">
                       <div class="tp-banner-thumb include-bg transition-3" data-background="assets/img/product/banner/product-banner-2.jpg" style="height: 280px; width: 100%;"></div>
                    </div>
                 </div>
                 @endif
              </div>
           </div>
        </section>
        <!-- banner area end -->
