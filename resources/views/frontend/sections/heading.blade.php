<!-- Payment Services Heading -->
<header class="header payment-services-header section" id="home">
    <div class="shapes-container">
        <div class="static-shape shape-main cutout x2 bottom-right" data-aos="fade-down" data-aos-delay="300"></div>
    </div>

    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 text-center @rtl text-md-end @else text-md-start @endrtl">
                <span class="py-2" data-aos="@rtl fade-left @else fade-right @endrtl">{{ $heading_section['0'] }}</span>
                <h1 class="bold font-md display-lg-2 mt-3" data-aos="@rtl fade-left" @else fade-right @endrtl data-aos-delay="100">{{ $heading_section['1'] }} <span class="d-block">{{ $heading_section['2'] }}</span></h1>

                <p class="lead" data-aos="@rtl fade-left" @else fade-right @endrtl data-aos-delay="200">{{ $heading_section['3'] }}</p>

                <div class="my-5" data-aos="@rtl fade-left" @else fade-right @endrtl data-aos-delay="400">
                    <a href="/login" class="btn btn-rounded btn-lg btn-primary px-4 mx-auto @rtl ms-md-0 @else me-md-0 @endrtl">{{ $heading_section['4'] }} <i class="fas fa-long-arrow-alt-right ms-2"></i></a>
                </div>
            </div>

            <div class="col-md-6 position-relative">
                <div class="shapes-container">
                    <div class="static-shape pattern-dots" data-aos="zoom-out-left" data-aos-delay="100"></div>
                </div>

                <figure class="figure-box mockup cutout x2 bottom-right">
                    <div class="screens">
                        <img src="{{ asset("img/home/".$frontend_images->img1) }}" alt="..." data-aos="fade-down">
                        <img src="{{ asset("img/home/".$frontend_images->img2) }}" class="position-absolute" data-aos="fade-up" data-aos-delay="200" alt="...">
                    </div>

                    <div class="promo-box card shadow-lg border-0" data-aos="fade-up" data-aos-delay="400">
                        <div class="card-body p-5 text-center">
                            <figure class="icon-xxl mx-auto">
                                <img src="{{ asset("img/home/".$frontend_images->img4) }}" alt="...">
                            </figure>

                            <p class="mt-4 text-muted mb-0">{{ $heading_section['5'] }}</p>
                            <hr class="my-3 mx-auto w-25">
                            <h6 class="h6 mb-0">{{ $heading_section['6'] }}</h6>
                        </div>
                    </div>
                </figure>
            </div>
        </div>
    </div>
</header>
