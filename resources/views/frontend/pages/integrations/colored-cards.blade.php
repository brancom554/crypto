@php ($cards = [
    [ "img" => "2", "title" => "jQuery", "class" => "mt-6 @rtl me-lg-auto @else ms-lg-auto @endrtl", "bg" => "bg-primary-gradient", "animation" => "fade-up" ],
    [ "img" => "1", "title" => "Codebase", "class" => "@rtl ms-lg-auto @else me-lg-auto @endrtl", "bg" => "bg-info-gradient", "animation" => "fade-up" ],
    [ "img" => "3", "title" => "OpenCart", "class" => "@rtl me-lg-auto @else ms-lg-auto @endrtl", "bg" => "bg-danger-gradient", "animation" => "fade-up" ],
    [ "img" => "4", "title" => "Morpheus", "class" => "mt-n6 @rtl ms-lg-auto @else me-lg-auto @endrtl", "bg" => "bg-success-gradient", "animation" => "fade-up" ]
])
<!-- ./Integration tools -->
<section class="section">
    <div class="shape-wrapper">
        <img src="{{ asset("img/shps/shape-2.svg") }}" class="@rtl shape-left @else shape-right @endrtl" alt="...">
    </div>

    <div class="container bring-to-front">
        <div class="row gap-y align-items-center">
            <div class="col-12 col-md-5 col-lg-5 @rtl ms-md-auto text-lg-end @else me-md-auto text-lg-start @endrtl text-center">
                <i data-feather="box" width="36" height="36" class="stroke-primary"></i>
                <p class="small text-primary bold">Integration tools</p>
                <h2 class="bold">Easy integrations for your convenience</h2>
                <p class="text-secondary">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis dolores
                    dolorum,
                    error est excepturi exercitationem hic iusto minus nam officia optio quasi tempore voluptatibus. Aut
                    dolore in nostrum quae voluptatem!</p>
            </div>

            <div class="col-12 col-md-7 col-lg-6">
                <div class="row gap-y">
                    @foreach ($cards as $card)
                    <div class="col-6 col-sm-5 col-md-6 col-lg-5 {{ $card['class'] }}">
                        <div class="{{ $card['bg'] }} rounded text-contrast p-2 p-sm-4 shadow text-center"
                            data-aos="{{ $card['animation'] }}">
                            <img src="{{ asset("img/logos/{$card['img']}.svg") }}" class="img-responsive op-8 px-0 px-sm-4"
                                alt="...">

                            <p class="bold mt-5">{{ $card['title'] }}</p>

                            <p class="op-5 small">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>

                            <a href="javascript:;" class="btn btn-rounded btn-contrast mt-4">
                                <i class="d-inline-block d-sm-none fas fa-long-arrow-alt-right"></i>
                                <span class="d-none d-sm-inline-block">Integrate</span>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
