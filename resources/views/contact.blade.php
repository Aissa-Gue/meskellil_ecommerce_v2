@extends('layouts.app')

@section('content')

    @include('components.area.off-canvas-area')
    @include('components.area.mobile-menu-area')
    @include('components.search-area')
    @include('components.area.cart-mini-area')
    @include('components.area.general-header-area')


    <main>
        @include('components.breadcrumb2', $breadcrumbData)



        <!-- contact area start -->
        <section class="tp-contact-area pb-100">
            <div class="container">
                <div class="tp-contact-inner">
                    <div class="row">
                        <div class="col-xl-9 col-lg-8">
                            <div class="tp-contact-wrapper">
                                <h3 class="tp-contact-title">Sent A Message</h3>

                                <div class="tp-contact-form">
                                    <form id="contact-form" action="assets/mail.php" method="POST">
                                        <div class="tp-contact-input-wrapper">
                                            <div class="tp-contact-input-box">
                                                <div class="tp-contact-input">
                                                    <input name="name" id="name" type="text"
                                                           placeholder="Shahnewaz Sakil">
                                                </div>
                                                <div class="tp-contact-input-title">
                                                    <label for="name">Your Name</label>
                                                </div>
                                            </div>
                                            <div class="tp-contact-input-box">
                                                <div class="tp-contact-input">
                                                    <input name="email" id="email" type="email"
                                                    placeholder="{{ global_info('brand.name') . '@mail.com' }}">
                                                </div>
                                                <div class="tp-contact-input-title">
                                                    <label for="email">Your Email</label>
                                                </div>
                                            </div>
                                            <div class="tp-contact-input-box">
                                                <div class="tp-contact-input">
                                                    <input name="subject" id="subject" type="text"
                                                           placeholder="Write your subject">
                                                </div>
                                                <div class="tp-contact-input-title">
                                                    <label for="subject">Subject</label>
                                                </div>
                                            </div>
                                            <div class="tp-contact-input-box">
                                                <div class="tp-contact-input">
                                                    <textarea id="message" name="message"
                                                              placeholder="Write your message here..."></textarea>
                                                </div>
                                                <div class="tp-contact-input-title">
                                                    <label for="message">Your Message</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tp-contact-suggetions mb-20">
                                            <div class="tp-contact-remeber">
                                                <input id="remeber" type="checkbox">
                                                <label for="remeber">Save my name, email, and website in this browser
                                                    for the next time I comment.</label>
                                            </div>
                                        </div>
                                        <div class="tp-contact-btn">
                                            <button type="submit">Send Message</button>
                                        </div>
                                    </form>
                                    <p class="ajax-response"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4">
                            <div class="tp-contact-info-wrapper">
                                <div class="tp-contact-info-item">
                                    <div class="tp-contact-info-icon">
                                 <span>
                                    <img src="assets/img/contact/contact-icon-1.png" alt="">
                                 </span>
                                    </div>
                                    <div class="tp-contact-info-content">
                                        <p data-info="mail"><a href="mailto:{{ global_info('contact.email') }}">{{ global_info('contact.email') }}</a></p>
                                        <p data-info="phone"><a href="tel:{{ global_info('contact.phone_primary') }}">{{ global_info('contact.phone_primary') }}</a></p>
                                    </div>
                                </div>
                                <div class="tp-contact-info-item">
                                    <div class="tp-contact-info-icon">
                                 <span>
                                    <img src="assets/img/contact/contact-icon-2.png" alt="">
                                 </span>
                                    </div>
                                    <div class="tp-contact-info-content">
                                        <p>
                                            <a href="{{ global_info('addresses.location_1.maps_url') }}"
                                               target="_blank">
                                                {{ global_info('addresses.location_1.address') }}
                                            </a>
                                        </p>

                                        <p>
                                            <a href="{{ global_info('addresses.location_2.maps_url') }}"
                                               target="_blank">
                                                {{ global_info('addresses.location_2.address') }}
                                            </a>
                                        </p>
                                    </div>
                                </div>
                                <div class="tp-contact-info-item">
                                    <div class="tp-contact-info-icon">
                                 <span>
                                    <img src="assets/img/contact/contact-icon-3.png" alt="">
                                 </span>
                                    </div>
                                    <div class="tp-contact-info-content">
                                        <div class="tp-contact-social-wrapper mt-5">
                                            <h4 class="tp-contact-social-title">Find on social media</h4>

                                            <div class="tp-contact-social-icon">
                                                <a href="{{ global_info('social_media.facebook.url') }}"><i class="fa-brands fa-facebook-f"></i></a>
                                                <a href="{{ global_info('social_media.instagram.url') }}"><i class="fa-brands fa-instagram"></i></a>
                                                <a href="{{ global_info('social_media.youtube.url') }}"><i class="fa-brands fa-youtube"></i></a>
                                                <a href="{{ global_info('social_media.tiktok.url') }}"><i class="fa-brands fa-tiktok"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- contact area end -->

        <!-- map area start -->
        <section class="tp-map-area pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="tp-map-wrapper">
                            {{-- <div class="tp-map-hotspot">
                           <span class="tp-hotspot tp-pulse-border">
                              <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                   xmlns="http://www.w3.org/2000/svg">
                                 <circle cx="6" cy="6" r="6" fill="#821F40"/>
                              </svg>
                           </span>
                            </div> --}}
                            <div class="tp-map-iframe mb-30">
                                <iframe src="{{ global_info('addresses.location_1.maps_embed_url') }}"></iframe>
                            </div>
                            <div class="tp-map-iframe">
                                <iframe src="{{ global_info('addresses.location_2.maps_embed_url') }}"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- map area end -->

    </main>

@endsection
