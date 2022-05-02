<!-- ./Customers -->
<x-utils.container class="bg-contrast edge bottom-right">
    <div class="section-heading text-center">
        <i data-feather="zap" width="36" height="36" class="mb-2"></i>
        <h2 class="bold">Third party integration</h2>
        <p class="text-secondary lead">We use the latest trends because you deserve better</p>
    </div>

    <div class="list-unstyled d-flex flex-wrap justify-content-around">
        @php ($images = [
            [ "image" => 1, "margin" => "6", "aos" => "fade-right" ],
            [ "image" => 2, "margin" => "4", "aos" => "fade-down-right" ],
            [ "image" => 3, "margin" => "5", "aos" => "fade-up-right" ],
            [ "image" => 4, "margin" => "6", "aos" => "fade-up" ],
            [ "image" => 5, "margin" => "4", "aos" => "fade-down-left" ],
            [ "image" => 1, "margin" => "5", "aos" => "fade-up-left" ],
            [ "image" => 2, "margin" => "4 mt-lg-6", "aos" => "fade-left" ]
        ])
        @foreach ($images as $i)
        <div data-aos-easing="ease-in-out-cubic" data-aos="{{ $i['aos'] }}" data-aos-delay="{{ ($i['image'] - 1) * 100 }}"
            class="mt-{{ $i['margin'] }}">
            <div class="shadow-sm shadow-hover lift-hover icon-xxl image-background contain bg-gray-light rounded-circle"
                 style="background-image: url({{ asset("img/logos/{$i['image']}.png") }})">
            </div>
        </div>
        @endforeach
    </div>

    <div class="text-center mt-6">
        <i data-feather="code" width="36" height="36" class="stroke-primary"></i>
        <p class="text-primary">Are you a developer?</p>
        <a href="developers" class="btn btn-rounded btn-primary">Review the specs</a>
    </div>
</x-utils.container>
