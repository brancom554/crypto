<!-- ./Team -->
<x-utils.container class="{{ $class ?? '' }}" container-class="swiper-center-nav {{ $containerClass ?? '' }}">
    @if (isset($heading))
        <div class="section-heading text-center">
            <h2 class="bold">Know our team</h2>
            <p class="lead text-secondary">These amazing people have made possible to stay where we are</p>
        </div>
    @endif

    <div class="position-relative">
        <div class="swiper-container"
             data-sw-centered-slides="false"
             data-sw-show-items="1"
             data-sw-space-between="30"
             data-sw-breakpoints='{"768": {"slidesPerView": 2, "spaceBetween": 30, "slidesPerGroup": 1}}'>
            <div class="swiper-wrapper">
                @foreach ($team as $member)
                <div class="swiper-slide">
                    <div class="card shadow">
                        <div class="container-fluid py-0">
                            <div class="row">
                                <div class="col-md-5 py-9 py-sm-7 overlay overlay-dark alpha-2 image-background cover center-top"
                                    style="background-image: url({{ asset("img/avatar/team/" . ($loop->index + 1) . ".jpg") }})">
                                </div>
                                <div class="col-md-7">
                                    <div class="p-4">
                                        <h6 class="bold font-l">{{ $member['name'] }}</h6>
                                        <p class="small mt-0 text-primary text-uppercase mb-5">{{ $member['position'] }}</p>

                                        <blockquote class="team-quote pt-1">
                                            <i class="quote fas fa-quote-left"></i>
                                            <p class="italic ps-4">{{ $member['quote'] }}</p>
                                        </blockquote>

                                        <hr class="w-25 mt-5">
                                        <nav class="nav">
                                            @foreach ($member['social'] as $net)
                                            <a href="javascript:;" class="nav-item nav-link pb-0">
                                                <i class="fab fa-{{ $net }} text-secondary"></i>
                                            </a>
                                            @endforeach
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Add Nav Arrows -->
        <div class="swiper-button swiper-button-next rounded-circle shadow">
            <i data-feather="arrow-right"></i>
        </div>
        <div class="swiper-button swiper-button-prev rounded-circle shadow">
            <i data-feather="arrow-left"></i>
        </div>
    </div>
</x-utils.container>
