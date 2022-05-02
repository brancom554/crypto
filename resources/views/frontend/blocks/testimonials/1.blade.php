<!-- ./Testimonials -->
<x-utils.container class="{{ $class ?? '' }}" container-class="swiper-center-nav {{ $containerClass ?? '' }}">
    <div class="section-heading text-center">
        <span class="text-secondary shadow rounded-pill border py-2 px-4 bold text-dark small">Over 3,000 customers rely on DashCore</span>
        <h2 class="bold mt-3">Customer reviews</h2>
    </div>

    <div class="testimonials-slider">
        <div class="swiper-container">
            <div class="swiper-wrapper text-center w-50">
                @for ($i = 1; $i < 6; $i++)
                <div class="swiper-slide">
                    <div class="d-flex flex-column align-items-center">
                        <img src="{{ asset("img/avatar/" . $i . ".jpg") }}" alt=""
                            class="rounded-circle shadow mb-4">

                        <p class="w-75 lead mt-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            Accusamus asperiores consequatur cum distinctio, dolorem earum error esse ex fugiat
                            inventore maiores minima, non placeat praesentium quam quas ut, vero voluptatem.</p>
                        <hr class="w-50">
                        <footer>
                            <cite class="bold text-primary text-uppercase">Jane Doe,</cite>
                            <p class="small text-secondary mt-0">Awesome Company</p>
                        </footer>
                    </div>
                </div>
                @endfor
            </div>
        </div>

        <div class="swiper-button swiper-button-prev rounded-circle shadow">
            <i data-feather="arrow-left"></i>
        </div>
        <div class="swiper-button swiper-button-next rounded-circle shadow">
            <i data-feather="arrow-right"></i>
        </div>
    </div>
</x-utils.container>
