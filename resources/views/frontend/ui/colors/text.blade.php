<x-utils.container class="{{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="section-heading text-center">
        <h2 class="bold">Text color</h2>
    </div>

    <div class="row gap-y">
        @foreach ($colors['text'] as $color)
        <div class="col-6 col-md-3">
            <p class="text-{{ $color['name'] }} {{ isset($color['bg']) ? "bg-" . $color['bg'] : "" }} p-3">.text-{{ $color['name'] }}</p>
        </div>
        @endforeach
    </div>
</x-utils.container>
