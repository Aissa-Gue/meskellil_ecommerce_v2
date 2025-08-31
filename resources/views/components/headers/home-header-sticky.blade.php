  <div id="header-sticky-2" class="tp-header-sticky-area">
         <div class="container">
            <div class="tp-mega-menu-wrapper p-relative">
               <div class="row align-items-center">
                  <div class="col-xl-3 col-lg-3 col-md-3 col-6">
                     <div class="logo">
                        <a href="/">
                           <!--<img src="assets/img/logo/logo.svg" alt="logo">-->
                           <img src="{{ global_info('brand.logo.png') }}" class="img-fluid" width="80px" alt="logo">
                        </a>
                     </div>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-6 d-none d-md-block">
                     <div class="tp-header-sticky-menu main-menu menu-style-1">
                        <nav id="mobile-menu"> 
                           <ul>
                              <li class="has-mega-menu">
                                 <a href="/">Home</a>
                              </li>
                              
                              <li class="has-dropdown has-mega-menu ">
                                 
                                 <a href="shop.html">Products</a>
                                 <ul class="tp-submenu tp-mega-menu mega-menu-style-2">
                                    <!-- first col -->
                                    <li class="has-dropdown">
                                       <a href="shop.html" class="mega-menu-title">Shop Page</a>
                                       <ul class="tp-submenu">
                                          <li><a href="shop-category.html">Only Categories</a></li>
                                          <li><a href="shop-filter-offcanvas.html">Shop Grid</a></li>
                                          <li><a href="shop.html">Shop Grid with Sideber</a></li>
                                          <li><a href="shop-list.html">Shop List</a></li>
                                          <li><a href="shop-category.html">Categories</a></li>
                                          <li><a href="product-details.html">Product Details</a></li>
                                          <li><a href="product-details-progress.html">Product Details Progress</a></li>
                                       </ul>
                                    </li>
                                    <!-- third col -->
                                    <li  class="has-dropdown">
                                       <a href="product-details.html" class="mega-menu-title">Products</a>
                                       <ul class="tp-submenu">
                                          
                                          <li><a href="product-details.html">Product Simple</a></li>
                                          <li><a href="product-details-video.html">With Video</a></li>
                                          <li><a href="product-details-countdown.html">With Countdown Timer</a></li>
                                          <li><a href="product-details-presentation.html">Product Presentation</a></li>
                                          <li><a href="product-details-swatches.html">Variations Swatches</a></li>
                                          <li><a href="product-details-list.html">List View</a></li>
                                          <li><a href="product-details-gallery.html">Details Gallery</a></li>
                                          <li><a href="product-details-slider.html">With Slider</a></li>
                                       </ul>
                                    </li>
                                    <!-- third col -->
                                    <li  class="has-dropdown">
                                       <a href="shop.html" class="mega-menu-title">eCommerce</a>
                                       <ul class="tp-submenu">
                                          <li><a href="/cart">Shopping Cart</a></li>
                                          <li><a href="order.html">Track Your Order</a></li>
                                          {{-- <li><a href="compare.html">Compare</a></li> --}}
                                          <li><a href="/wishlist">Wishlist</a></li>
                                          <li><a href="/checkout">Checkout</a></li>
                                          <li><a href="/profile">My account</a></li>
                                       </ul>
                                    </li>

                                    <!-- second col -->
                                    <li  class="has-dropdown">
                                       <a href="shop.html" class="mega-menu-title">More Pages</a>
                                       <ul class="tp-submenu">
                                          
                                         
                                          <li><a href="about.html">About</a></li>
                                          <li><a href="login.html">Login</a></li>
                                          <li><a href="register.html">Register</a></li>
                                          <li><a href="forgot.html">Forgot Password</a></li>
                                          <li><a href="404.html">404 Error</a></li>
                                       </ul>
                                    </li>

                                 </ul>
                              </li>
                              <!--
                              <li><a href="coupon.html">Coupons</a></li>
                              <li class="has-dropdown">
                                 <a href="blog.html">Blog</a>
                                 <ul class="tp-submenu">
                                    <li><a href="blog.html">Blog Standard</a></li>
                                    <li><a href="blog-grid.html">Blog Grid</a></li>
                                    <li><a href="blog-list.html">Blog List</a></li>
                                    <li><a href="blog-details-2.html">Blog Details Full Width</a></li>
                                    <li><a href="blog-details.html">Blog Details</a></li>
                                 </ul>
                              </li>
                           -->
                              <li><a href="/contact">Contact</a></li>
                           </ul>
                        </nav>
                     </div>
                  </div>
                  <div class="col-xl-3 col-lg-3 col-md-3 col-6">
                     <div class="tp-header-action d-flex align-items-center justify-content-end ml-50">
                        {{-- <div class="tp-header-action-item d-none d-lg-block">
                           <a href="compare.html"  class="tp-header-action-btn">
                              <svg width="20" height="19" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path d="M14.8396 17.3319V3.71411" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M19.1556 13L15.0778 17.0967L11 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M4.91115 1.00056V14.6183" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M0.833496 5.09667L4.91127 1L8.98905 5.09667" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                              </svg>                                       
                           </a>
                        </div> --}}
                        <div class="tp-header-action-item d-none d-lg-block">
                           <a href="/wishlist" class="tp-header-action-btn">
                              <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path fill-rule="evenodd" clip-rule="evenodd" d="M11.239 18.8538C13.4096 17.5179 15.4289 15.9456 17.2607 14.1652C18.5486 12.8829 19.529 11.3198 20.1269 9.59539C21.2029 6.25031 19.9461 2.42083 16.4289 1.28752C14.5804 0.692435 12.5616 1.03255 11.0039 2.20148C9.44567 1.03398 7.42754 0.693978 5.57894 1.28752C2.06175 2.42083 0.795919 6.25031 1.87187 9.59539C2.46978 11.3198 3.45021 12.8829 4.73806 14.1652C6.56988 15.9456 8.58917 17.5179 10.7598 18.8538L10.9949 19L11.239 18.8538Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M7.26062 5.05302C6.19531 5.39332 5.43839 6.34973 5.3438 7.47501" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                              </svg> 
                              <span class="tp-header-action-badge">4</span>                          
                           </a>
                        </div>
                        <div class="tp-header-action-item">
                           <button type="button" class="tp-header-action-btn cartmini-open-btn">
                              <svg width="21" height="22" viewBox="0 0 21 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path fill-rule="evenodd" clip-rule="evenodd" d="M6.48626 20.5H14.8341C17.9004 20.5 20.2528 19.3924 19.5847 14.9348L18.8066 8.89359C18.3947 6.66934 16.976 5.81808 15.7311 5.81808H5.55262C4.28946 5.81808 2.95308 6.73341 2.4771 8.89359L1.69907 14.9348C1.13157 18.889 3.4199 20.5 6.48626 20.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M6.34902 5.5984C6.34902 3.21232 8.28331 1.27803 10.6694 1.27803V1.27803C11.8184 1.27316 12.922 1.72619 13.7362 2.53695C14.5504 3.3477 15.0081 4.44939 15.0081 5.5984V5.5984" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M7.70365 10.1018H7.74942" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M13.5343 10.1018H13.5801" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                              </svg>    
                              <span class="tp-header-action-badge">13</span>                                                                          
                           </button>
                        </div>
                        <div class="tp-header-action-item d-lg-none">
                           <button type="button" class="tp-header-action-btn tp-offcanvas-open-btn">
                              <svg xmlns="http://www.w3.org/2000/svg" width="30" height="16" viewBox="0 0 30 16">
                                 <rect x="10" width="20" height="2" fill="currentColor"/>
                                 <rect x="5" y="7" width="25" height="2" fill="currentColor"/>
                                 <rect x="10" y="14" width="20" height="2" fill="currentColor"/>
                              </svg>
                           </button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>