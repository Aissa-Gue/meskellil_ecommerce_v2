     <!-- banner area start -->
        <section class="tp-banner-area pb-70">
           <div class="container">
              <div class="row">
                 @if(isset($bannerProducts) && $bannerProducts->count() >= 2)
                 <div class="col-xl-8 col-lg-7">
                    <div class="tp-banner-item tp-banner-height p-relative mb-30 z-index-1 fix">
                       <div class="tp-banner-thumb include-bg transition-3" data-background="{{ $bannerProducts[0]->first_image ? asset('storage/' . $bannerProducts[0]->first_image) : 'assets/img/product/banner/product-banner-1.jpg' }}"></div>
                       <div class="tp-banner-content">
                          <span>{{ __('header.sale') }} {{ $bannerProducts[0]->discount }}% {{ __('header.off_all_store') }}</span>
                          <h3 class="tp-banner-title">
                             <a href="{{ route('products.show', $bannerProducts[0]->id) }}">{{ $bannerProducts[0]->name }}</a>
                          </h3>
                          <div class="tp-banner-btn">
                             <a href="{{ route('products.show', $bannerProducts[0]->id) }}" class="tp-link-btn">{{ __('header.shop_now') }}
                                <svg width="15" height="13" viewBox="0 0 15 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                   <path d="M13.9998 6.19656L1 6.19656" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                   <path d="M8.75674 0.975394L14 6.19613L8.75674 11.4177" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                             </a>
                          </div>
                       </div>
                    </div>
                 </div>
                 <div class="col-xl-4 col-lg-5">
                    <div class="tp-banner-item tp-banner-item-sm tp-banner-height p-relative mb-30 z-index-1 fix">
                       <div class="tp-banner-thumb include-bg transition-3" data-background="{{ $bannerProducts[1]->first_image ? asset('storage/' . $bannerProducts[1]->first_image) : 'assets/img/product/banner/product-banner-2.jpg' }}"></div>
                       <div class="tp-banner-content">
                          <h3 class="tp-banner-title">
                             <a href="{{ route('products.show', $bannerProducts[1]->id) }}">{{ $bannerProducts[1]->name }}</a>
                          </h3>
                          <p>{{ __('header.sale') }} {{ $bannerProducts[1]->discount }}% {{ __('header.off') }}</p>
                          <div class="tp-banner-btn">
                             <a href="{{ route('products.show', $bannerProducts[1]->id) }}" class="tp-link-btn">{{ __('header.shop_now') }}
                                <svg width="15" height="13" viewBox="0 0 15 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                   <path d="M13.9998 6.19656L1 6.19656" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                   <path d="M8.75674 0.975394L14 6.19613L8.75674 11.4177" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                             </a>
                          </div>
                       </div>
                    </div>
                 </div>
                 @else
                 <!-- Fallback static content if no banner products -->
                 <div class="col-xl-8 col-lg-7">
                    <div class="tp-banner-item tp-banner-height p-relative mb-30 z-index-1 fix">
                       <div class="tp-banner-thumb include-bg transition-3" data-background="assets/img/product/banner/product-banner-1.jpg"></div>
                       <div class="tp-banner-content">
                          <span>{{ __('header.sale') }} 20% {{ __('header.off_all_store') }}</span>
                          <h3 class="tp-banner-title">
                             <a href="#">{{ __('header.featured_product') }}</a>
                          </h3>
                          <div class="tp-banner-btn">
                             <a href="#" class="tp-link-btn">{{ __('header.shop_now') }}
                                <svg width="15" height="13" viewBox="0 0 15 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                   <path d="M13.9998 6.19656L1 6.19656" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                   <path d="M8.75674 0.975394L14 6.19613L8.75674 11.4177" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                             </a>
                          </div>
                       </div>
                    </div>
                 </div>
                 <div class="col-xl-4 col-lg-5">
                    <div class="tp-banner-item tp-banner-item-sm tp-banner-height p-relative mb-30 z-index-1 fix">
                       <div class="tp-banner-thumb include-bg transition-3" data-background="assets/img/product/banner/product-banner-2.jpg"></div>
                       <div class="tp-banner-content">
                          <h3 class="tp-banner-title">
                             <a href="#">{{ __('header.featured_product') }}</a>
                          </h3>
                          <p>{{ __('header.sale') }} 35% {{ __('header.off') }}</p>
                          <div class="tp-banner-btn">
                             <a href="#" class="tp-link-btn">{{ __('header.shop_now') }}
                                <svg width="15" height="13" viewBox="0 0 15 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                   <path d="M13.9998 6.19656L1 6.19656" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                   <path d="M8.75674 0.975394L14 6.19613L8.75674 11.4177" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                             </a>
                          </div>
                       </div>
                    </div>
                 </div>
                 @endif
              </div>
           </div>
        </section>
        <!-- banner area end -->