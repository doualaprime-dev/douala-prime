<div wire:ignore x-data="{}" x-init="
    () => {
        new Swiper('.swiper', {
            // Optional parameters
            direction: 'horizontal',
            loop: true,
            speed: 400,

            // If we need pagination
            pagination: {
                el: '.swiper-pagination',
            },

            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },

            // And if we need scrollbar
            scrollbar: {
                el: '.swiper-scrollbar',
            },

             autoplay: {
                delay: 2000,
            },
        });
    }
">
    <!-- Slider main container -->
    <div class="swiper">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            <div class="swiper-slide">
                <img src="{{ asset('images/banner-1.png') }}" alt="Banner" className="h-full w-full" />
            </div>
            <div class="swiper-slide">
                <img src="{{ asset('images/banner-2.png') }}" alt="Banner" className="h-full w-full" />
            </div>
            <div class="swiper-slide">
                <img src="{{ asset('images/banner-3.png') }}" alt="Banner" className="h-full w-full" />
            </div>
            <div class="swiper-slide">
                <img src="{{ asset('images/banner-4.png') }}" alt="Banner" className="h-full w-full" />
            </div>
        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>

        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>

        <!-- If we need scrollbar -->
        <div class="swiper-scrollbar"></div>
    </div>
</div>
