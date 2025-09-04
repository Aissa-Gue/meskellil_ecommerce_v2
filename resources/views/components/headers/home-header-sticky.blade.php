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
                                 <a href="/">{{ __('header.home') }}</a>
                              </li>

                              <li class="has-dropdown has-mega-menu">
                                 <a href="{{ route('products.index') }}">{{ __('header.categories') }}</a>
                                 <ul class="tp-submenu tp-mega-menu mega-menu-style-2">
                                    @if(!empty($categories))
                                       @php
                                          $parentCategories = collect($categories)->where('parent_id', null);
                                          $chunks = $parentCategories->chunk(ceil($parentCategories->count() / 5));
                                       @endphp
                                       
                                       @foreach($chunks as $chunk)
                                          <li class="has-dropdown">
                                             @foreach($chunk as $category)
                                                <div class="tp-mega-menu-category-item">
                                                   <a href="{{ route('products.index', ['category' => $category->id]) }}" class="mega-menu-title d-flex align-items-center">
                                                      <!-- @if($category->image)
                                                         <img src="{{ $category->image }}" alt="{{ $category->name }}" style="width:24px;height:24px;object-fit:cover;margin-right:8px;border-radius:4px;">
                                                      @endif -->
                                                      {{ $category->name }}
                                                   </a>
                                                   @if($category->children && $category->children->count() > 0)
                                                      <ul class="tp-submenu">
                                                         @foreach($category->children->take(6) as $child)
                                                            <li>
                                                               <a href="{{ route('products.index', ['category' => $child->id]) }}" class="d-flex align-items-center">
                                                                  @if($child->image)
                                                                     <img src="{{ $child->image }}" alt="{{ $child->name }}" style="width:16px;height:16px;object-fit:cover;margin-right:6px;border-radius:2px;">
                                                                  @endif
                                                                  {{ $child->name }}
                                                               </a>
                                                            </li>
                                                         @endforeach
                                                         @if($category->children->count() > 6)
                                                            <li><a href="{{ route('products.index', ['category' => $category->id]) }}" class="text-primary">View All {{ $category->name }}</a></li>
                                                         @endif
                                                      </ul>
                                                   @endif
                                                </div>
                                             @endforeach
                                          </li>
                                       @endforeach
                                    @else
                                       <li class="has-dropdown">
                                          <a href="{{ route('products.index') }}" class="mega-menu-title">All Products</a>
                                          <ul class="tp-submenu">
                                             <li><a href="{{ route('products.index') }}">Browse All Products</a></li>
                                          </ul>
                                       </li>
                                    @endif
                                    
                                 </ul>
                              </li>

                              <li><a href="/contact">{{ __('header.contact') }}</a></li>
                           </ul>
                        </nav>
                     </div>
                  </div>
                  <div class="col-xl-3 col-lg-3 col-md-3 col-6">
                     <div class="tp-header-action d-flex align-items-center justify-content-end ml-50">
                        <div class="tp-header-action-item d-none d-lg-block">
                           @auth
                              <a href="{{ route('wishlist') }}" class="tp-header-action-btn">
                              <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path fill-rule="evenodd" clip-rule="evenodd" d="M11.239 18.8538C13.4096 17.5179 15.4289 15.9456 17.2607 14.1652C18.5486 12.8829 19.529 11.3198 20.1269 9.59539C21.2029 6.25031 19.9461 2.42083 16.4289 1.28752C14.5804 0.692435 12.5616 1.03255 11.0039 2.20148C9.44567 1.03398 7.42754 0.693978 5.57894 1.28752C2.06175 2.42083 0.795919 6.25031 1.87187 9.59539C2.46978 11.3198 3.45021 12.8829 4.73806 14.1652C6.56988 15.9456 8.58917 17.5179 10.7598 18.8538L10.9949 19L11.239 18.8538Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M7.26062 5.05302C6.19531 5.39332 5.43839 6.34973 5.3438 7.47501" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                              </svg> 
                              <span class="tp-header-action-badge">4</span>                          
                           </a>
                           @else
                              <a href="{{ route('login') }}" class="tp-header-action-btn">
                                 <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.239 18.8538C13.4096 17.5179 15.4289 15.9456 17.2607 14.1652C18.5486 12.8829 19.529 11.3198 20.1269 9.59539C21.2029 6.25031 19.9461 2.42083 16.4289 1.28752C14.5804 0.692435 12.5616 1.03255 11.0039 2.20148C9.44567 1.03398 7.42754 0.693978 5.57894 1.28752C2.06175 2.42083 0.795919 6.25031 1.87187 9.59539C2.46978 11.3198 3.45021 12.8829 4.73806 14.1652C6.56988 15.9456 8.58917 17.5179 10.7598 18.8538L10.9949 19L11.239 18.8538Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M7.26062 5.05302C6.19531 5.39332 5.43839 6.34973 5.3438 7.47501" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                 </svg>
                              </a>
                           @endauth
                        </div>
                        <div class="tp-header-action-item">
                           @auth
                              <a href="{{ route('profile.show') }}" class="tp-header-action-btn d-none d-lg-block"> 
                                 <span>{{ Auth::user()->name }}</span>
                              </a>
                              <form method="POST" action="{{ route('logout') }}" class="d-inline-block">
                                 @csrf
                                 <button type="submit" class="tp-header-action-btn" style="background:none;border:none;padding:0;color:inherit;cursor:pointer;">{{ __('header.logout') }}</button>
                              </form>
                           @else
                              <button type="button" class="tp-header-action-btn cartmini-open-btn">
                              <svg width="21" height="22" viewBox="0 0 21 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                 <path fill-rule="evenodd" clip-rule="evenodd" d="M6.48626 20.5H14.8341C17.9004 20.5 20.2528 19.3924 19.5847 14.9348L18.8066 8.89359C18.3947 6.66934 16.976 5.81808 15.7311 5.81808H5.55262C4.28946 5.81808 2.95308 6.73341 2.4771 8.89359L1.69907 14.9348C1.13157 18.889 3.4199 20.5 6.48626 20.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M6.34902 5.5984C6.34902 3.21232 8.28331 1.27803 10.6694 1.27803V1.27803C11.8184 1.27316 12.922 1.72619 13.7362 2.53695C14.5504 3.3477 15.0081 4.44939 15.0081 5.5984V5.5984" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M7.70365 10.1018H7.74942" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                 <path d="M13.5343 10.1018H13.5801" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                              </svg>    
                              <span class="tp-header-action-badge">13</span>                                                                          
                           </button>
                           @endauth
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