<!-- slider area start -->
<div class="py-8">
    {{-- background gris --}}
    <div class="w-full max-w-none mx-auto px-4" style=" background-color: #f3f4f6; padding: 1rem;">
        <div class="tp-slider-active tp-slider-variation swiper-container mx-auto" style="max-width: 1300px;">
            <div class="swiper-wrapper">
                @if(isset($sliderImages) && count($sliderImages) > 0)
                    @foreach($sliderImages as $index => $slide)
                        <div class="relative swiper-slide">
                            <div class="relative w-full h-[400px] md:h-[450px] lg:h-[500px] rounded-xl overflow-hidden bg-gray-400 shadow-xl" style="border-radius: 0.9rem;">
                                <!-- Background Image -->
                                <img src="{{ $slide->image_url }}" 
                                     alt="Slider Image {{ $index + 1 }}"
                                     class="w-full h-full object-cover"
                                >
                                
                                <!-- Professional Overlay -->
                                <div class="absolute inset-0 bg-gradient-to-r from-black/75 via-black/50 to-black/20"></div>
                                
                               
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- Fallback slide if no data is available -->
                    <div class="relative swiper-slide">
                        <div class="relative w-full h-[400px] md:h-[450px] lg:h-[500px] rounded-xl overflow-hidden bg-gray-400 shadow-xl">
                            <!-- Background Image -->
                            <img src="https://images.unsplash.com/photo-1556910103-1c02745aae4d?w=1400&h=500&fit=crop&crop=center" 
                                 alt="Featured Collection"
                                 class="w-full h-full object-cover">
                            
                            <!-- Professional Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-r from-black/75 via-black/50 to-black/20"></div>
                            
                            <!-- Professional Content Layout -->
                            <div class="absolute inset-0 flex items-center">
                                <div class="px-8 md:px-12 lg:px-16 max-w-3xl">
                                    <h1 class="text-white text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                                        DÉCOUVREZ LES<br>
                                        <span class="text-red-500">PRODUITS</span> FEATURED
                                    </h1>
                                    <p class="text-white/90 text-xl md:text-2xl lg:text-3xl mb-8 font-medium max-w-2xl">
                                        Une sélection premium au service de vos créations culinaires
                                    </p>
                                    <div class="inline-flex items-center px-8 py-4 bg-red-600 hover:bg-red-700 rounded-lg text-white font-bold text-lg transition-all duration-300 hover:scale-105">
                                        <span>Découvrir la collection</span>
                                        <svg class="ml-3 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            
            <!-- Navigation Arrows -->
            <div class="tp-slider-arrow tp-swiper-arrow hidden lg:block">
                <button type="button" class="tp-slider-button-prev">
                    <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 13L1 7L7 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
                <button type="button" class="tp-slider-button-next">
                    <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 13L7 7L1 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
            
            <!-- Pagination Dots - Positioned at bottom center -->
            <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-20">
                <div class="tp-slider-dot tp-swiper-dot flex space-x-3"></div>
            </div>
        </div>
    </div>
</div>
<!-- slider area end -->
