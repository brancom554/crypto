<!-- ./Slider - default -->
<x-utils.container class="{{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
        <div class="section-heading text-center">
            <h2 class="bold">Default</h2>
            <p class="italic">Use your mouse or swipe to slide</p>
        </div>

        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="swiper-container" data-sw-pagination="false" data-sw-nav-arrows="false" data-sw-show-items="2">
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
