<!-- ./Slider - Secondary navigation element -->
<x-utils.container class="{{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
        <div class="section-heading text-center">
            <h2 class="bold">Secondary navigation element</h2>
            <p class="italic">You can include a thumbs to slide through the gallery</p>
        </div>

        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="swiper-container" data-sw-pagination="false" data-sw-nav-arrows="false" data-sw-navigation="#sw-nav-1" data-sw-active-selector="img">
                    <div class="swiper-wrapper">
                        @for ($i = 1; $i < 6; $i++)
                            <div class="swiper-slide">
                                <img src="{{ asset("img/blocks/sliders/{$i}.jpg") }}" alt="" class="img-responsive shadow-lg rounded">
                            </div>
                        @endfor
                    </div>
                </div>

                <nav id="sw-nav-1" class="nav nav-circle swiper-nav-thumbs mt-4 align-items-center">
                    @for ($i = 1; $i < 6; $i++)
                        <a class="nav-item nav-link {{ $i == 1 ? "active" : "" }}" href="#" data-step="{{ $i }}">
                            <img src="{{ asset("img/blocks/sliders/{$i}.jpg") }}" alt="" class="thumb rounded-circle shadow me-0">
                        </a>
                    @endfor
                </nav>
            </div>
        </div>
</x-utils.container>
