<!-- ./Testimonials -->
<x-utils.container class="{{ $class ?? '' }}" container-class="swiper-center-nav {{ $containerClass ?? '' }}">
    <div class="section-heading text-center">
        <span class="text-secondary shadow rounded-pill border py-2 px-4 bold text-dark small">Still not sure how {{ appName() }} can help you?</span>
        <h2 class="bold mt-3">Our clients have a lot to say</h2>
    </div>

    <div class="swiper-container" data-sw-navigation="#sw-nav-testimonials-1" data-sw-active-selector="img">
        <div class="swiper-wrapper">
            @for ($i = 1; $i < 6; $i++)
            <div class="swiper-slide">
                <blockquote class="text-center">
                    <i class="fas fa-quote-left fa-2x op-4"></i>
                    <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias aut consectetur dignissimos
                        dolor doloribus earum excepturi incidunt itaque maiores molestias natus pariatur, quasi quis
                        soluta unde vel veritatis? Eligendi, voluptatibus</p>
                    <hr class="w-10 mt-5">

                    <footer class="author font-sm">
                        <figure class="icon-xxl company logo mockup">
                            <img src="{{ asset("img/logos/{$i}.png") }}" alt="" class="img-responsive mb-4">
                        </figure>

                        <cite class="bold text-uppercase text-primary">Jane Doe</cite> | <span class="text-secondary italic">Marketing Director</span>
                    </footer>
                </blockquote>
            </div>
            @endfor
        </div>
    </div>

    <nav id="sw-nav-testimonials-1" class="swiper-nav-thumbs nav nav-circle mt-4 align-items-center justify-content-center">
        @for ($i = 1; $i < 6; $i++)
        <a class="nav-item nav-link" href="#" data-step="{{ $i }}">
            <img src="{{ asset("img/avatar/{$i}.jpg") }}" alt="" class="thumb rounded-circle shadow {{ $i == 1 ? "active" : "" }} icon-md me-0">
        </a>
        @endfor
    </nav>
</x-utils.container>
