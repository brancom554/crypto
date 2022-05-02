@php ($elements = [
    [ "icon" => "image", "title" => "Easily theme-able" ],
    [ "icon" => "sliders", "title" => "Professional tools" ],
    [ "icon" => "target", "title" => "Ready-to-use content" ]
])
<!-- ./Design features -->
<x-utils.container id="features" class="{{ $class ?? '' }}">
    <div class="section-heading mb-6 text-center">
        <h5 class="text-primary bold small text-uppercase">Design better</h5>
        <h2 class="bold">We design to fit all your needs</h2>
    </div>

    <div class="row gap-y text-center text-md-left">
        @foreach ($elements as $element)
        <div class="col-md-4">
            <div class="card shadow-hover lift-hover">
                <div class="card-body">
                    <i data-feather="{{ $element['icon'] }}" width="36" height="36" class="stroke-primary"></i>
                    <h5 class="bold mt-3">{{ $element['title'] }}</h5>
                    <p class="{{ $textClass ?? '' }}">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab dolores ea
                        fugiat nesciunt quisquam. Assumenda dolore error nulla pariatur voluptatem?</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</x-utils.container>
