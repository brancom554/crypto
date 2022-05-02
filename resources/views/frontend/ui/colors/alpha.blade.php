<x-utils.container class="{{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="section-heading text-center">
        <h2 class="bold">Alpha colors</h2>
    </div>

    @foreach ($colors['bootstrap'] as $color)
    <code class="bold small text-center d-block my-0 text-{{ $color['name'] }}{{ $color['name'] == "contrast" || $color['name'] == "light" ? " bg-dark" : "" }}">.color-{{ $color['name'] }}</code>
    <div class="d-flex flex-wrap justify-content-around mb-5{{ $color['name'] == "contrast" || $color['name'] == "light" ? " bg-dark" : "" }}">
        @for ($j = 1 ; $j < 11; $j++)
        <p class="my-0 small text-{{ $color['name'] }} op-{{ $j }} p-3">.alpha-{{ $j }}</p>
        @endfor
    </div>
    @endforeach
</x-utils.container>
