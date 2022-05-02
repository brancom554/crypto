<!-- ./CTA - Try it Free -->
<x-utils.container
    class="gradient overlay alpha-8 gradient-purple-blue image-background cover text-contrast {{ $class ?? '' }}"
    container-class="{{ $containerClass ?? '' }}"
    style="background-image: url(https://picsum.photos/350/200/?random&gravity=south)"
>
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2 class="text-contrast">Stop looking for a <span class="bold">template</span></h2>
                <p>With <span class="bold">DashCore</span> you will have everything you ever needed to showcase your solution.</p>
            </div>

            <div class="col-md-4 @rtl me-md-auto @else ms-md-auto @endrtl">
                <p class="handwritten highlight font-md mb-4">Why wait?</p>
                <x-utils.link class="btn btn-contrast btn-rounded ms-3" text="Try it for Free NOW!" />
            </div>
        </div>
</x-utils.container>
