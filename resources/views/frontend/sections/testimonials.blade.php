@php ($testimonials = [
    [ "logo" => 1, "customer" => [ "name" => "Jane Doe", "picture" => 3 ], "testimonial" => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Atque, quas sunt enim tempore minima tenetur voluptatem provident. Incidunt accusantium." ],
    [ "logo" => 2, "customer" => [ "name" => "John Doe", "picture" => 2 ], "testimonial" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo harum eaque voluptatibus est obcaecati exercitationem maxime illo nihil voluptatem." ],
    [ "logo" => 1, "customer" => [ "name" => "Mauro", "picture" => 5 ], "testimonial" => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Atque, quas sunt enim tempore minima tenetur voluptatem provident. Incidunt accusantium." ],
    [ "logo" => 2, "customer" => [ "name" => "5studios team", "picture" => 6 ], "testimonial" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo harum eaque voluptatibus est obcaecati exercitationem maxime illo nihil voluptatem." ]
])
<x-utils.container section="false" class="slider-testimonials {{ $class ?? '' }}" container-class="swiper-center-nav {{ $containerClass ?? '' }}">
    <div class="section-heading text-center">
        <h2 class="bold">{{ $testimonials_section['0'] }}</h2>
        <p class="lead text-muted">{{ $testimonials_section['1'] }}</p>
    </div>

    <div class="card strong-top-bordered-card">
        <div class="row g-0">
            <div class="col-md-6">
                <!-- Images slider, will fade -->
                <div class="swiper-container h-100" data-sw-effect="fade" data-sw-space-between="0" data-sw-pagination="false" data-sw-nav-arrows=".nav-testimonial">
                    <div class="swiper-wrapper">
                        @foreach ($testimonials as $testimonial)
                            <div class="swiper-slide">
                                <figure class="m-0 image-background cover"
                                        style="background-image: url({{ asset("img/testimonials/{$testimonial['customer']['picture']}.jpg") }})">
                                    <img src="{{ asset("img/testimonials/{$testimonial['customer']['picture']}.jpg") }}" alt="..." class="invisible">
                                </figure>
                            </div>
                        @endforeach
                    </div>

                    <div class="divider"></div>
                </div>

                <!-- Prev button -->
                <div class="swiper-button swiper-button-prev nav-testimonial-prev rounded-circle shadow">
                    <i data-feather="arrow-left"></i>
                </div>
            </div>

            <div class="col-md-6">
                <!-- Testimonials slider, will slide -->
                <div class="swiper-container h-100">
                    <div class="swiper-wrapper" data-sw-pagination="false" data-sw-nav-arrows=".nav-testimonial">
                        @foreach ($testimonials as $testimonial)
                            <div class="swiper-slide">
                                <div class="card-body h-100 d-flex flex-column justify-content-center">
                                    <blockquote class="blockquote text-center mb-0">
                                        <figure class="mockup mb-5">
                                            <img src="{{ asset("img/logos/companies/{$testimonial['logo']}.svg") }}" alt="..." class="img-responsive">
                                        </figure>

                                        <i class="fas fa-quote-left fa-2x op-4 absolute-md left top"></i>
                                        <p class="mb-5 mb-md-6">{{ $testimonial['testimonial'] }}</p>
                                        <footer class="blockquote-footer">
                                            <span class="h6 text-uppercase">{{ $testimonial['customer']['name'] }}</span>
                                        </footer>
                                    </blockquote>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Next button -->
                <div class="swiper-button swiper-button-next nav-testimonial-next rounded-circle shadow">
                    <i data-feather="arrow-right"></i>
                </div>
            </div>
        </div>
    </div>
</x-utils.container>
