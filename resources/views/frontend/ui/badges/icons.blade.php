<x-utils.container class="{{ $class ?? '' }}" container-class="{{ $containerClass ?? '' }}">
        <div class="section-heading text-center">
            <h2 class="bold">Badges with Icons</h2>
            <p class="lead italic">You can include an icon to a badge to give context.</p>
        </div>

        <div class="d-flex flex-wrap justify-content-around py-5">
            @foreach ($badges['bootstrap'] as $badge)
                <span class="rounded-pill shadow-box badge bg-{{ $badge }} bold py-2 px-4 mt-2">
                    <i class="far fa-lightbulb{{ $badge == "contrast" || $badge == "light" ? " text-primary" : "" }} me-2"></i>
                    <span class="{{ $badge == "contrast" || $badge == "light" ? "text-primary" : "" }}">Awesome</span> badge
                </span>
            @endforeach
        </div>
</x-utils.container>
