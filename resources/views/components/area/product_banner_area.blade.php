
         <!-- product banner area start -->
         <div class="tp-product-banner-area pb-90">
            <div class="container">
               <div class="tp-product-banner-slider fix">
                  <div class="tp-product-banner-slider-active swiper-container">
                     <div class="swiper-wrapper">
                        @if(isset($promotionalProducts) && $promotionalProducts->count() > 0)
                           @foreach($promotionalProducts as $index => $product)
                           <div class="tp-product-banner-inner theme-bg p-relative z-index-1 fix swiper-slide">
                              <h4 class="tp-product-banner-bg-text">{{ $product->category->name ?? 'product' }}</h4>
                              <div class="row align-items-center">
                                 <div class="col-xl-6 col-lg-6">
                                    <div class="tp-product-banner-content p-relative z-index-1">
                                       <span class="tp-product-banner-subtitle">{{ $product->brand->name ?? __('header.featured_collection') }} {{ date('Y') }}</span>
                                       <h3 class="tp-product-banner-title">{{ $product->name }}</h3>
                                       <div class="tp-product-banner-price mb-40">
                                          @if($product->has_discount)
                                             <span class="old-price">${{ number_format($product->price1, 2) }}</span>
                                             <p class="new-price">${{ number_format($product->discounted_price, 2) }}</p>
                                          @else
                                             <p class="new-price">${{ number_format($product->price1, 2) }}</p>
                                          @endif
                                       </div>
                                       <div class="tp-product-banner-btn">
                                          <a href="{{ route('products.show', $product->id) }}" class="tp-btn tp-btn-2">{{ __('header.shop_now') }}</a>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-xl-6 col-lg-6">
                                    <div class="tp-product-banner-thumb-wrapper p-relative">
                                       <div class="tp-product-banner-thumb-shape">
                                          <span class="tp-product-banner-thumb-gradient"></span>
                                          <img class="tp-offer-shape" src="assets/img/banner/banner-slider-offer.png" alt="">
                                       </div>
            
                                       <div class="tp-product-banner-thumb text-end p-relative z-index-1">
                                          <img src="{{ $product->first_image ? asset('storage/' . $product->first_image) : 'assets/img/banner/banner-slider-' . ($index + 1) . '.png' }}" alt="{{ $product->name }}" height="400" width="400" class="img-fluid rounded-corner" style="object-fit: cover;">
                                       </div>
                                       <style>
                                          .rounded-corner {
                                             border-radius: 20px;
                                          }
                                       </style>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           @endforeach
                        @else
                           <!-- Fallback static content if no promotional products -->
                           <div class="tp-product-banner-inner theme-bg p-relative z-index-1 fix swiper-slide">
                              <h4 class="tp-product-banner-bg-text">product</h4>
                              <div class="row align-items-center">
                                 <div class="col-xl-6 col-lg-6">
                                    <div class="tp-product-banner-content p-relative z-index-1">
                                       <span class="tp-product-banner-subtitle">{{ __('header.featured_collection') }} {{ date('Y') }}</span>
                                       <h3 class="tp-product-banner-title">{{ __('header.featured_product') }}</h3>
                                       <div class="tp-product-banner-price mb-40">
                                          <span class="old-price">$1240.00</span>
                                          <p class="new-price">$975.00</p>
                                       </div>
                                       <div class="tp-product-banner-btn">
                                          <a href="#" class="tp-btn tp-btn-2">{{ __('header.shop_now') }}</a>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-xl-6 col-lg-6">
                                    <div class="tp-product-banner-thumb-wrapper p-relative">
                                       <div class="tp-product-banner-thumb-shape">
                                          <span class="tp-product-banner-thumb-gradient"></span>
                                          <img class="tp-offer-shape" src="assets/img/banner/banner-slider-offer.png" alt="">
                                       </div>
            
                                       <div class="tp-product-banner-thumb text-end p-relative z-index-1">
                                          <img src="assets/img/banner/banner-slider-1.png" alt="">
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        @endif                      
                     </div>
                     <div class="tp-product-banner-slider-dot tp-swiper-dot"></div>
                  </div>
               </div>
            </div>
         </div>
         <!-- product banner area end -->