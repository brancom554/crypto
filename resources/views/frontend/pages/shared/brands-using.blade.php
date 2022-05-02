<!-- ./Brands -->
<x-utils.container class="{{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    @if (isset($title))
    <h4 class="bold text-center mb-5">{{ $title }}</h4>
    @endif

    <div class="row gap-y">
        @for ($i = 1; $i < 5; $i++)
        <div class="col-md-3 col-xs-4 col-6 px-md-5">
            <img src="{{ asset("img/logos/{$i}.png") }}" alt="" class="img-responsive mx-auto op-7"
                style="max-height: 60px;" />
        </div>
        @endfor
    </div>
</x-utils.container>
