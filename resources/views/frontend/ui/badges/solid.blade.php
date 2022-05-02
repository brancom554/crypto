<x-utils.container class="{{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
        <div class="section-heading text-center">
            <h2 class="bold">Default badges</h2>
            <p class="lead italic">Documentation and examples for badges, our small count and labeling component.</p>
        </div>

        <div class="d-flex flex-wrap justify-content-around">
            @foreach ($badges['bootstrap'] as $badge)
            <span class="badge bg-{{ $badge }} {{ $badge == "contrast" or $badge == "light" ? " text-primary" : "" }}">
                {{ $badge }}
            </span>
            @endforeach
        </div>
</x-utils.container>
