<x-utils.container class="{{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
        <div class="section-heading text-center">
            <h2 class="bold">Custom Badges</h2>
            <p class="lead italic">By adding some utilities classes you can customize the spacing and look.</p>
        </div>

        <div class="d-flex flex-wrap justify-content-around py-5">
            @foreach ($badges['bootstrap'] as $badge)
                <span class="badge bg-{{ $badge }} rounded-pill shadow py-2 px-4 {{ $badge == "contrast" || $badge == "light" ? " text-primary" : "" }}">{{ $badge }}</span>
            @endforeach
        </div>
</x-utils.container>
