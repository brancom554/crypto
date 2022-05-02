<!-- ./Slider - pagination -->
<x-utils.container class="{{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
        <div class="section-heading text-center">
            <h2 class="bold">Pagination</h2>
            <p class="italic">You can include pagination bullets to slide</p>
        </div>

        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="swiper-container pb-5" data-sw-nav-arrows="false">
                    <div class="swiper-wrapper">
                        @for ($i = 1; $i < 6; $i++)
                            <div class="swiper-slide">
                                <img src="{{ asset("img/blocks/sliders/{$i}.jpg") }}" alt="" class="img-responsive shadow-lg rounded">
                            </div>
                        @endfor
                    </div>

                    <!-- Add Pagination -->
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
</x-utils.container>
