<!-- cart mini area start -->
<div class="cartmini__area tp-all-font-roboto">
    <div class="cartmini__wrapper d-flex justify-content-between flex-column">
        <div class="cartmini__top-wrapper">
            <div class="cartmini__top p-relative">
                <div class="cartmini__top-title">
                    <h4>{{ __('header.shopping_cart') }}</h4>
                </div>
                <div class="cartmini__close">
                    <button type="button" class="cartmini__close-btn cartmini-close-btn"><i class="fal fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="cartmini__widget">
                <div class="cartmini__widget-item">
                    <div class="cartmini__thumb">
                        <a href="product-details.html">
                            <img src="assets/img/product/product-1.jpg" alt="">
                        </a>
                    </div>
                    <div class="cartmini__content">
                        <h5 class="cartmini__title"><a href="product-details.html">Level Bolt Smart Lock</a></h5>
                        <div class="cartmini__price-wrapper">
                            <span class="cartmini__price">$46.00</span>
                            <span class="cartmini__quantity">x2</span>
                        </div>
                    </div>
                    <a href="#" class="cartmini__del"><i class="fa-regular fa-xmark"></i></a>
                </div>
            </div>

            <!-- for wp -->
            <!-- if no item in cart -->
            <div class="cartmini__empty text-center d-none">
                <img src="assets/img/product/cartmini/empty-cart.png" width="150" alt="">
                <p>{{ __('header.your_cart_is_empty') }}</p>
                <a href="/" class="tp-btn">{{ __('header.go_to_shop') }}</a>
            </div>

        </div>
        <div class="cartmini__checkout">
            <div class="cartmini__checkout-title mb-30">
                <h4>{{ __('header.subtotal') }}:</h4>
                <span>$113.00</span>
            </div>
            <div class="cartmini__checkout-btn">
                <a href="/cart" class="tp-btn mb-10 w-100"> {{ __('header.view_cart') }}</a>
                <!--<a href="/checkout" class="tp-btn tp-btn-border w-100"> {{ __('header.checkout') }}</a>-->
            </div>
        </div>
    </div>
</div>
<!-- cart mini area end -->
