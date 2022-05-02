<x-utils.container class="{{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
    <div class="section-heading text-center">
        <h2 class="bold">Badge in Buttons</h2>
        <p class="lead italic">Badges can be used as part of links or buttons to provide a counter.</p>
    </div>

    <div class="d-flex flex-wrap justify-content-around py-5">
        @foreach ($badges['bootstrap'] as $badge)
            <button type="button" class="btn btn-primary mt-2">
                Awesome notification <span class="badge bg-{{ $badge != "primary" ? $badge : "contrast text-primary" }} rounded-pill px-2 {{ $badge == "contrast" || $badge == "light" ? " text-primary" : "" }}">4</span>
            </button>
        @endforeach
    </div>
</x-utils.container>
