<!-- ./Slider - Autoplay -->
<x-utils.container class="{{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
        <div class="section-heading text-center">
            <h2 class="bold">Autoplay</h2>
            <p class="italic">Adjust delay and speed for each transition</p>
        </div>

        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="swiper-container" data-sw-pagination="false" data-sw-nav-arrows="false" data-sw-autoplay="2000" data-sw-speed="800">
                    <div class="swiper-wrapper">
                        @for ($i = 1; $i < 6; $i++)
                            <div class="swiper-slide">
                                <img src="{{ asset("img/blocks/sliders/{$i}.jpg") }}" alt="" class="img-responsive shadow-lg rounded">
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
</x-utils.container>
