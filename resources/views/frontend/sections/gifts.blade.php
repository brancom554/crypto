<!-- Gifts -->
<x-utils.container class="with-promo">
    <div class="row gap-y align-items-center">
        <div class="col-md-6">
            <div class="section-heading">
                <h2 class="heading-line bold"><span class="light">{{ $gifts_section['0'] }}</span> <br>{{ $gifts_section['1'] }}</h2>
                <p class="lead">{{ $gifts_section['2'] }}</p>
            </div>

            <p class="mb-5">{{ $gifts_section['3'] }}</p>

            <a href="/login" class="btn btn-rounded btn-outline-darker">{{ $gifts_section['4'] }}</a>
        </div>

        <div class="col-md-6">
            <figure class="figure-box mockup @rtl ms-md-0 @else me-md-0 @endrtl">
                <div class="screens cutout-md bottom-right" data-aos="fade-up">
                    <img src="{{ asset("img/home/".$frontend_images->img3) }}" alt="">
                </div>

                <div class="promo-box card shadow bottom-left">
                    <div class="circle-icon icon-lg bg-success p-2 rounded-circle center-flex shadow">
                        <i data-feather="gift" class="stroke-contrast"></i>
                    </div>

                    <div class="card-body">
                        <p class="small text-primary mb-3">{{ $gifts_section['5'] }}</p>
                        <p class="text-dark h4">${{ $gifts_section['6'] }}</p>
                        <p class="small">{{ $gifts_section['7'] }}</p>
                    </div>
                </div>

                <div class="shapes-container">
                    <div class="shape pattern pattern-dots"></div>
                </div>
            </figure>
        </div>
    </div>
</x-utils.container>
