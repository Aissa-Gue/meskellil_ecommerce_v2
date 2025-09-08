<!-- pre loader area start -->
<div id="loading">
    <div id="loading-center">
        <div id="loading-center-absolute">
            <!-- loading content here -->
            <div class="tp-preloader-content">
                <div class="tp-preloader-logo">
                    <div class="tp-preloader-circle">
                        <svg width="190" height="190" viewBox="0 0 380 380" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <circle stroke="#D9D9D9" cx="190" cy="190" r="180" stroke-width="6"
                                    stroke-linecap="round"></circle>
                            <circle stroke="red" cx="190" cy="190" r="180" stroke-width="6"
                                    stroke-linecap="round"></circle>
                        </svg>
                    </div>
                    <!--<img src="{{asset('assets/img/logo/preloader/preloader-icon.svg')}}" alt="">-->
                    <img src="{{ global_info('brand.logo.png') }}" alt="" class="img-fluid" width="120px">
                </div>
                <h3 class="tp-preloader-title">{{ global_info('brand.name') }}</h3>
                <p class="tp-preloader-subtitle">Loading</p>
            </div>
        </div>
    </div>
</div>
<!-- pre loader area end -->