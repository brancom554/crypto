<!-- ./Slider - navigation -->
<x-utils.container class="{{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
        <div class="section-heading text-center">
            <h2 class="bold">Navigation</h2>
            <p class="italic">You can include navigation arrows to slide</p>
        </div>

        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="swiper-container" data-sw-nav-arrows=".swiper2-button" data-sw-pagination="false">
                    <div class="swiper-wrapper">
                        @for ($i = 1; $i < 6; $i++)
                            <div class="swiper-slide px-5">
                                <img src="{{ asset("img/blocks/sliders/{$i}.jpg") }}" alt="" class="img-responsive shadow-lg rounded">
                            </div>
                        @endfor
                    </div>

                    <!-- Add Arrows -->
                    <div class="swiper-button swiper2-button-next swiper-button-next rounded-circle shadow">
                        <i class="fas fa-long-arrow-alt-right"></i>
                    </div>
                    <div class="swiper-button swiper2-button-prev swiper-button-prev rounded-circle shadow">
                        <i class="fas fa-long-arrow-alt-left"></i>
                    </div>
                </div>
            </div>
        </div>
</x-utils.container>
