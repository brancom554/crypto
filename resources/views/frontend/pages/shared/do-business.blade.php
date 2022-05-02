@php ($cards = [
    [ "img" => "time", "title" => "Save time", "animation" => "fade-up" ],
    [ "img" => "done", "title" => "Get things done", "animation" => "fade-up" ],
    [ "img" => "grow", "title" => "Grow your business", "animation" => "fade-up" ],
    [ "img" => "goals", "title" => "Accomplish your goals", "animation" => "fade-up" ]
])
<!-- ./Features - hover animated -->
<section class="section bg-light bg-light-gradient edge @rtl bottom-left @else bottom-right @endrtl">
    <div class="container bring-to-front">
        <div class="section-heading text-center">
            <h5 class="text-primary bold small text-uppercase">Let's do business</h5>
            <h2 class="bold">What {{ appName() }} template offers</h2>
        </div>

        <div class="row gap-y">
            @foreach ($cards as $card)
            <div class="col-lg-6">
                <div class="rounded bg-contrast shadow-box image-background off-left-background lift-hover p-4 ps-6 ps-md-9"
                    style="background-image: url({{ asset("img/lcards/{$card['img']}.svg") }})">
                    <h3>{{ $card['title'] }}</h3>
                    <p class="text-secondary mb-0">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error eveniet
                        nihil perspiciatis quia quidem quod ratione sapiente sint?
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
