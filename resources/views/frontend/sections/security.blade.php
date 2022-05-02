<!-- Gifts -->
<section class="section with-promo anime-background">
    <div class="shapes-container">
        <div class="static-shape shape-main right"></div>
    </div>

    <div class="container">
        <div class="row gap-y align-items-center">
            <div class="col-md-6 order-md-last">
                <div class="section-heading">
                    <h2 class="heading-line bold"><span class="light">{{ $security_section['0'] }}</span> <br>{{ $security_section['1'] }}</h2>
                    <p class="lead">{{ $security_section['2'] }}</p>
                </div>

                <p class="mb-5">{{ $security_section['3'] }}</p>

                <a href="/login" class="btn btn-rounded btn-outline-darker">{{ $security_section['4'] }}</a>
            </div>

            <div class="col-md-6">
                <figure class="figure-box mockup @rtl me-md-0 @else ms-md-0 @endrtl">
                    <div class="screens cutout-md bottom-left" data-aos="fade-up">
                        <img src="{{ asset("img/home/".$frontend_images->img5) }}" alt="">
                    </div>

                    <div class="promo-box card shadow top-right">
                        <div class="circle-icon icon-lg bg-success p-2 rounded-circle center-flex shadow">
                            <i data-feather="shield" class="stroke-contrast"></i>
                        </div>

                        <div class="card-body">
                            <p class="small text-primary mb-3">{{ $security_section['5'] }}</p>
                            <p class="text-dark bold">{{ $security_section['6'] }}</p>
                            <p class="small">{{ $security_section['7'] }}</p>
                        </div>
                    </div>

                    <div class="shapes-container">
                        <div class="shape pattern pattern-dots"></div>
                    </div>
                </figure>
            </div>
        </div>
    </div>
</section>
