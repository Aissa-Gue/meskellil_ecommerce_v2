<!-- product area start -->
<section class="tp-product-area pb-55">
   <div class="container">
      <div class="row align-items-end">
         <div class="col-xl-5 col-lg-6 col-md-5">
            <div class="tp-section-title-wrapper mb-40">
               <h3 class="tp-section-title">
                  {{ __('header.trending_products') }}
                  <svg width="114" height="35" viewBox="0 0 114 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <path d="M112 23.275C1.84952 -10.6834 -7.36586 1.48086 7.50443 32.9053" stroke="currentColor" stroke-width="4" stroke-miterlimit="3.8637" stroke-linecap="round"/>
                  </svg>
               </h3>
            </div>
         </div>
         <div class="col-xl-7 col-lg-6 col-md-7">
            <div class="tp-product-tab tp-product-tab-border mb-45 tp-tab d-flex justify-content-md-end">
               <ul class="nav nav-tabs justify-content-sm-end" id="productTab" role="tablist">
                  <li class="nav-item" role="presentation">
                     <button class="nav-link active" id="new-tab" data-bs-toggle="tab" data-bs-target="#new-tab-pane" type="button" role="tab" aria-controls="new-tab-pane" aria-selected="true">
                        {{ __('header.new') }}
                        <span class="tp-product-tab-line">
                           <svg width="52" height="13" viewBox="0 0 52 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M1 8.97127C11.6061 -5.48521 33 3.99996 51 11.4635" stroke="currentColor" stroke-width="2" stroke-miterlimit="3.8637" stroke-linecap="round"/>
                           </svg>
                        </span>
                     </button>
                  </li>
                  <li class="nav-item" role="presentation">
                     <button class="nav-link" id="featured-tab" data-bs-toggle="tab" data-bs-target="#featured-tab-pane" type="button" role="tab" aria-controls="featured-tab-pane" aria-selected="false">
                        {{ __('header.featured') }}
                        <span class="tp-product-tab-line">
                           <svg width="52" height="13" viewBox="0 0 52 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M1 8.97127C11.6061 -5.48521 33 3.99996 51 11.4635" stroke="currentColor" stroke-width="2" stroke-miterlimit="3.8637" stroke-linecap="round"/>
                           </svg>
                        </span>
                     </button>
                  </li>
                  <li class="nav-item" role="presentation">
                     <button class="nav-link" id="topsell-tab" data-bs-toggle="tab" data-bs-target="#topsell-tab-pane" type="button" role="tab" aria-controls="topsell-tab-pane" aria-selected="false">
                        {{ __('header.best_selling') }}
                        <span class="tp-product-tab-line">
                           <svg width="52" height="13" viewBox="0 0 52 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M1 8.97127C11.6061 -5.48521 33 3.99996 51 11.4635" stroke="currentColor" stroke-width="2" stroke-miterlimit="3.8637" stroke-linecap="round"/>
                           </svg>
                        </span>
                     </button>
                  </li>
                  <li class="nav-item" role="presentation">
                     <button class="nav-link" id="discounted-tab" data-bs-toggle="tab" data-bs-target="#discounted-tab-pane" type="button" role="tab" aria-controls="discounted-tab-pane" aria-selected="false">
                        {{ __('header.discounted') }}
                        <span class="tp-product-tab-line">
                           <svg width="52" height="13" viewBox="0 0 52 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M1 8.97127C11.6061 -5.48521 33 3.99996 51 11.4635" stroke="currentColor" stroke-width="2" stroke-miterlimit="3.8637" stroke-linecap="round"/>
                           </svg>
                        </span>
                     </button>
                  </li>
               </ul>
            </div>
         </div>
      </div>
      
      <div class="row">
         <div class="col-xl-12">
            <div class="tp-product-tab-content">
               <div class="tab-content" id="myTabContent">
                  <!-- New Products Tab -->
                  <div class="tab-pane fade show active" id="new-tab-pane" role="tabpanel" aria-labelledby="new-tab" tabindex="0">
                     <div class="row">
                        @foreach($products as $product)
                           <div class="col-xl-3 col-lg-3 col-sm-6">
                              @include('components.product.product_card', ['product' => $product])
                           </div>
                        @endforeach
                        </div>
                     </div>

                     <!-- Featured Products Tab -->
                     <div class="tab-pane fade" id="featured-tab-pane" role="tabpanel" aria-labelledby="featured-tab" tabindex="0">
                        <div class="row">
                           @foreach($featuredProducts as $product)
                              <div class="col-xl-3 col-lg-3 col-sm-6">
                                 @include('components.product.product_card', ['product' => $product])
                              </div>
                           @endforeach
                        </div>
                     </div>

                     <!-- Best Selling Products Tab -->
                     <div class="tab-pane fade" id="topsell-tab-pane" role="tabpanel" aria-labelledby="topsell-tab" tabindex="0">
                        <div class="row">
                           @foreach($bestSellingProducts as $product)
                              <div class="col-xl-3 col-lg-3 col-sm-6">
                                 @include('components.product.product_card', ['product' => $product])
                              </div>
                           @endforeach
                        </div>
                     </div>

                     <!-- Discounted Products Tab -->
                     <div class="tab-pane fade" id="discounted-tab-pane" role="tabpanel" aria-labelledby="discount-tab" tabindex="0">
                        <div class="row">
                           @foreach($discountedProducts as $product)
                              <div class="col-xl-3 col-lg-3 col-sm-6">
                                 @include('components.product.product_card', ['product' => $product])
                              </div>
                           @endforeach
                        </div>
                     </div>
                  </div><!-- End of tab-content -->
               </div><!-- End of tp-product-tab-content -->
            </div><!-- End of col-xl-12 -->
         </div><!-- End of row -->
      </div><!-- End of container -->
   </div><!-- End of tp-product-area -->
</section>